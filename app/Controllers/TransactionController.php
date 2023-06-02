<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\TransactionModel;
use CodeIgniter\Database\BaseUtils;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\TemplateProcessor;

class TransactionController extends BaseController
{
   protected $transaction, $document;
   protected $helpers = ['form'];
   public function __construct()
   {
      $this->transaction = new TransactionModel();
      $this->document = new DocumentModel();
   }
   public function index()
   {
      $role = session('role');
      if ($role == 'admin') {
         $data['transactions'] = $this->transaction->getLending();
      } else {
         $id = session('id');
         $data['transactions'] = $this->transaction->getLendingWithUserId($id);
      }
      return view('auth/transaction/index', $data);
   }
   public function add()
   {
      $id = session('id');
      $transactions = $this->transaction->where('user_id', $id)->findAll();
      foreach ($transactions as $tra) {
         if ($tra->status != 'selesai') {
            session()->setFlashdata('errorss', 'Tidak dapat mengajukan peminjaman/ permintaan. Peminjaman/ permintaan sebelumnya belum selesai.');
            return redirect()->back();
         }
      }
      return view('auth/transaction/add');
   }
   public function save()
   {
      $dataDokumen = $this->request->getFile('document');
      $validation = $this->validate([
         'request_number ' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Nomor Permintaan.']],
         'type' => ['rules'  => 'required', 'errors' => ['required' => 'Pilih Jenis.']],
         'request_date' => ['rules'  => 'date', 'errors' => ['date' => 'Masukkan Tanggal Permintaan Yang Benar.']],
         'need' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Keperluan.']],
         'borrow_date' => ['rules'  => 'date', 'errors' => ['date' => 'Masukkan Tanggal Pinjam Yang Benar.']],
         'return_date' => ['rules'  => 'date', 'errors' => ['date' => 'Masukkan Tanggal Kembali Yang Benar.']],
         'document' => ['rules' => 'mime_in[document,application/pdf]|max_size[document,1048]', 'errors' => ['mime_in' => 'Upload File Dokumen PDF.']],
      ]);
      if (!$validation) {
         session()->setFlashdata('errors', $this->validator->listErrors());
         return redirect()->back()->withInput();
      }
      $fileName = $this->request->getVar('request_number') . '_' . $dataDokumen->getRandomName();
      $dataDokumen->move('dokumen/permintaan/', $fileName);
      $this->transaction->insert([
         'request_number'   => htmlspecialchars($this->request->getVar('request_number')),
         'user_id'   => $this->request->getVar('user_id'),
         'type'   => $this->request->getVar('type'),
         'request_date'   => $this->request->getVar('request_date'),
         'need'   => htmlspecialchars(strtolower($this->request->getVar('need'))),
         'borrow_date'   => $this->request->getVar('borrow_date'),
         'return_date'   => $this->request->getVar('return_date'),
         'document'   => $fileName,
         'status'   => 'proses',
      ]);
      $this->document->insert([
         'transaction_number'   => $this->request->getVar('request_number'),
      ]);
      session()->setFlashdata('success', 'Permohonan ' . $this->request->getVar('type') . ' dokumen berhasil diajukan.');
      return redirect()->to(site_url('transaksi'));
   }
   public function show($id)
   {
      $data['tables'] = ['npk', 'nama', 'unit kerja', 'jenis', 'keperluan', 'status'];
      $data['datas'] = ['username', 'name', 'work_unit', 'type', 'need', 'status'];
      $data['transaction'] = $this->transaction->getLendingShow($id);
      return view('auth/transaction/show', $data);
   }
   public function edit($id)
   {
      $data['transaction'] = $this->transaction->getLendingShow($id);
      return view('auth/transaction/confirm', $data);
   }
   public function update($id)
   {
      $type = $this->request->getVar('type');
      if ($type == 'permintaan') {
         $dataDokumen = $this->request->getFile('document');
         $docId = $this->request->getVar('doc_id');
         $validation = $this->validate([
            'title_file ' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Judul Dokumen.']],
            'document' => ['rules' => 'mime_in[document,application/pdf]|max_size[document,10048]', 'errors' => ['mime_in' => 'Upload File Dokumen PDF.']],
         ]);
         if (!$validation) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
         }
         $fileName = $id . '_' . $dataDokumen->getName();
         $dataDokumen->move('dokumen/sukses/', $fileName);
         $this->transaction->update($id, [
            'status' => 'selesai',
         ]);
         $this->document->update($docId, [
            'title_file' => htmlspecialchars(strtolower($this->request->getVar('title_file'))),
            'request_file'   => $fileName,
         ]);
      } else  if ($type == 'peminjaman') {
         $docId = $this->request->getVar('doc_id');
         $validation = $this->validate([
            'title_file ' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Judul Dokumen.']],
         ]);
         if (!$validation) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
         }
         $this->transaction->update($id, [
            'status' => 'selesai',
         ]);
         $this->document->update($docId, [
            'title_file' => htmlspecialchars(strtolower($this->request->getVar('title_file'))),
         ]);
      }

      session()->setFlashdata('success', 'Konfirmasi Dokumen Berhasil.');
      return redirect()->to(site_url('transaksi'));
   }
   public function print($id)
   {
      $data['permohonan'] =  $this->transaction->getLendingShow($id);
      $type = $data['permohonan']->type;
      if ($type == 'peminjaman') {
         $tgl_name = 'Tgl.Peminjaman - Tgl.Kembali';
         $tgl_value = date("d F Y", strtotime($data['permohonan']->borrow_date)) . ' - ' . date("d F Y", strtotime($data['permohonan']->return_date));
      } else if ($type == 'permintaan') {
         $tgl_name = 'Tgl.Permintaan';
         $tgl_value = date("d F Y", strtotime($data['permohonan']->request_date));
      }
      $word = new TemplateProcessor('template\berita_acara.docx');
      $word->setValues([
         'nama' =>  ucwords($data['permohonan']->name),
         'npk' =>  $data['permohonan']->username,
         'unit_kerja' =>  ucwords($data['permohonan']->work_unit),
         'jenis' =>  ucwords($data['permohonan']->type),
         'no_permintaan' =>  $data['permohonan']->request_number,
         'keperluan' =>  ucwords($data['permohonan']->need),
         'tgl_name' => $tgl_name,
         'tgl_value' => $tgl_value,
      ]);
      $pathToSave = "template/beitaAcara.docx";
      $word->saveAs($pathToSave);
      header("Content-Description: File Transfer");
      header('Content-Disposition: attachment; filename="berita_acara.docx"');
      header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
      readfile($pathToSave);
   }
}
