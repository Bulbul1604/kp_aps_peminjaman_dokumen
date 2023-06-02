<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
   protected $user;
   public function __construct()
   {
      $this->user = new UserModel();
   }
   public function loginVerif()
   {
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
      $dataUser = $this->user->where([
         'username' => $username,
      ])->first();
      if (!$dataUser || !password_verify($password, $dataUser->password)) {
         session()->setFlashdata('errorss', 'Gagal!');
         session()->setFlashdata('error', 'Username & Password Salah');
         return redirect()->back()->withInput();
      }
      session()->set([
         'id' => $dataUser->id,
         'username' => $dataUser->username,
         'name' => $dataUser->name,
         'work_unit' => $dataUser->work_unit,
         'role' => $dataUser->role,
         'logged_in' => TRUE
      ]);
      return redirect()->to(base_url('dashboard'));
   }
   public function registerVerif()
   {
      $validation = $this->validate([
         'username' => ['rules'  => 'required|is_unique[users.username]', 'errors' => ['required' => 'Masukkan NPK.', 'is_unique' => 'NPK telah terdaftar.']],
         'name' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Nama Lengkap.']],
         'work_unit' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Unit Kerja.']],
         'password' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Kata Sandi.']],
         'password2' => ['rules'  => 'matches[password]', 'errors' => ['matches' => 'Konfirmasi kata sandi tidak sesuai dengan kata sandi.']],
      ]);
      if (!$validation) {
         session()->setFlashdata('errorss', 'Pendaftaran gagal!');
         session()->setFlashdata('errors', $this->validator->listErrors());
         return redirect()->back()->withInput();
      }
      $this->user->insert([
         'username' => htmlspecialchars(strtolower($this->request->getVar('username'))),
         'name' => htmlspecialchars(strtolower($this->request->getVar('name'))),
         'work_unit' => htmlspecialchars(strtolower($this->request->getVar('work_unit'))),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
         'role' => 'karyawan',
      ]);
      session()->setFlashdata('success', 'Pendaftaran berhasil. Silahkan masuk untuk melanjutkan!');
      return redirect()->to(site_url(''));
   }
   public function changePassword()
   {
      return view('auth/change-password');
   }
   public function changePasswordVerif($id)
   {
      // Get Data
      $passOld = $this->request->getVar('old_password');
      $dataUser = $this->user->where('id', $id)->first();
      $passVerif = password_verify($passOld, $dataUser->password);
      // Validasi Form
      $validation = $this->validate([
         'old_password' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Kata Sandi Sekarang.']],
         'new_password' => ['rules'  => 'required', 'errors' => ['required' => 'Masukkan Kata Sandi Baru.']],
         'conf_new_password' => ['rules'  => 'matches[new_password]', 'errors' => ['matches' => 'Konfirmasi Kata Sandi Baru Tidak Sesuai.']],
      ]);
      // Cek Validasi
      if (!$validation || !$passVerif) {
         session()->setFlashdata('errorss', 'Gagal!');
         if (!$validation) {
            session()->setFlashdata('errors', $this->validator->listErrors());
         } else {
            session()->setFlashdata('errors', '<li>Kata sandi sekarang salah!</li>');
         }
         return redirect()->back()->withInput();
      }
      // Berhasil
      $this->user->update($id, [
         'password' => password_hash($this->request->getVar('new_password'), PASSWORD_BCRYPT),
      ]);
      session()->setFlashdata('success', 'Kata sandi berhasil dirubah.');
      return redirect()->to(site_url('change-password'));
   }
   public function logout()
   {
      session()->destroy();
      return redirect()->to('/');
   }
}
