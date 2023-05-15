<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class HomeController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function showAll()
    {
        $transaction = new TransactionModel();
        $data['transactions'] = $transaction->findAll();
        return view('cek_peminjaman', $data);
    }
}
