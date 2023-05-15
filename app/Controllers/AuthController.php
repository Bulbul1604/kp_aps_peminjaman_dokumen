<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function loginVerif()
    {
        $user = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $user->where([
            'username' => $username,
        ])->first();
        if (!$dataUser || !password_verify($password, $dataUser->password)) {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
        // if (password_verify($password, $dataUser->password)) {}
        session()->set([
            'username' => $dataUser->username,
            'logged_in' => TRUE
        ]);
        return redirect()->to(base_url('dashboard'));
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
