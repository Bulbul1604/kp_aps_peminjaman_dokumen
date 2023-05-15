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

    public function search()
    {
        $id = $this->request->getVar('no_permintaan');
        $data['permohonan'] = $this->transaction->where('no_permintaan', $id)->first();
        if (!$data['permohonan']) {
            $data['not'] = 'Data tidak ditemukan';
            return view('index', $data);
        }

        $data['transaction'] = $this->transaction->dokumen($id);
        if (!$data['transaction']) {
            $data['permohonan'] = $this->transaction->where('no_permintaan', $id)->first();
        } else {
            $data['permohonan'] = $this->transaction->dokumen($id);
        }
        return view('cek_peminjaman', $data);
    }

    public function print($id)
    {
        $transaction = new TransactionModel();
        $data['permohonan'] = $transaction->where('no_permintaan', $id)->first();
        if ($data['permohonan']->tgl_kembali == "0000-00-00") {
            $tgl_kembali = $data['permohonan']->tgl_pinjam;
        } else {
            $tgl_kembali = $data['permohonan']->tgl_kembali;
        }
        $word = new TemplateProcessor('template\berita_acara.docx');
        $word->setValues([
            'nama' =>  ucwords($data['permohonan']->nama),
            'npk' =>  $data['permohonan']->npk,
            'unit_kerja' =>  ucwords($data['permohonan']->unit_kerja),
            'jenis' =>  ucwords($data['permohonan']->jenis),
            'no_permintaan' =>  $data['permohonan']->no_permintaan,
            'tgl_ permintaan' =>  date("d F Y", strtotime($data['permohonan']->tgl_permintaan)),
            'keperluan' =>  ucwords($data['permohonan']->keperluan),
            'tgl_pinjam' => date("d F Y", strtotime($data['permohonan']->tgl_pinjam)),
            'tgl_kembali' => date("d F Y", strtotime($tgl_kembali)),
        ]);
        $pathToSave = "template/beitaAcara.docx";
        $word->saveAs($pathToSave);
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="berita_acara.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        readfile($pathToSave);
    }

    public function index()
    {
        $data['transactions'] = $this->transaction->findAll();
        return view('admin/transaction/index', $data);
    }

    public function show($id)
    {
        $data['tables'] = ['npk', 'nama', 'unit_kerja', 'jenis', 'tgl_permintaan', 'keperluan', 'tgl_pinjam', 'tgl_kembali', 'status'];
        $data['transaction'] = $this->transaction->where('no_permintaan', $id)->first();
        return view('admin/transaction/show', $data);
    }

    public function save()
    {
        $dataDokumen = $this->request->getFile('dokumen');
        $validation = $this->validate([
            'no_permintaan' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Nomor Permintaan.']],
            'npk' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan NPK.']],
            'nama' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Nama Lengkap.']],
            'unit_kerja' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Unit Kerja.']],
            'jenis' => ['rules'  => 'required', 'errors' => ['required' => 'Pilih Jenis.']],
            'tgl_permintaan' => ['rules'  => 'required|date', 'errors' => ['required' => 'Masukkan Tanggal Permintaan.']],
            'keperluan' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Keperluan.']],
            'tgl_pinjam' => ['rules'  => 'required|date', 'errors' => ['required' => 'Masukkan Tanggal Pinjam.']],
            'dokumen' => ['rules' => 'mime_in[dokumen,application/pdf]|max_size[dokumen,1048]', 'errors' => ['mime_in' => 'Upload File Dokumen PDF.']],
        ]);
        if (!$validation) {
            return view('index', ['validation' => $this->validator]);
        }
        $fileName = $this->request->getVar('no_permintaan') . '_' . $dataDokumen->getRandomName();
        $dataDokumen->move('dokumen/permintaan/', $fileName);
        $this->transaction->insert([
            'no_permintaan'   => $this->request->getVar('no_permintaan'),
            'npk'   => $this->request->getVar('npk'),
            'nama'   => $this->request->getVar('nama'),
            'unit_kerja'   => $this->request->getVar('unit_kerja'),
            'jenis'   => $this->request->getVar('jenis'),
            'tgl_permintaan'   => $this->request->getVar('tgl_permintaan'),
            'keperluan'   => $this->request->getVar('keperluan'),
            'tgl_pinjam'   => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali'   => $this->request->getVar('tgl_kembali'),
            'dokumen'   => $fileName,
            'status'   => 'proses',
        ]);
        session()->setFlashdata('message', 'Permohonan Peminjaman Dokumen Berhasil.');
        return redirect()->to('/');
    }

    public function edit($id)
    {
        $data['transaction'] = $this->transaction->where('no_permintaan', $id)->first();
        return view('admin/transaction/confirm', $data);
    }

    public function update($id)
    {
        $dataDokumen = $this->request->getFile('dokumen');
        $validation = $this->validate([
            'dokumen' => ['rules' => 'mime_in[dokumen,application/pdf]|max_size[dokumen,10048]', 'errors' => ['mime_in' => 'Upload File Dokumen PDF.']],
        ]);
        if (!$validation) {
            $data['transaction'] = $this->transaction->where('no_permintaan', $id)->first();
            $data['validation'] =  $this->validator;
            return view('admin/transaction/confirm', $data);
        }
        $fileName = $id . '_' . $dataDokumen->getName();
        $dataDokumen->move('dokumen/sukses/', $fileName);
        $this->transaction->update($id, [
            'status' => 'selesai',
        ]);
        $this->document->insert([
            'transaction_no_permintaan' => $id,
            'file'   => $fileName,
        ]);
        session()->setFlashdata('message', 'Konfirmasi Dokumen Berhasil.');
        return redirect()->to('peminjaman');
    }
}
