<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $transaction = new TransactionModel();
        $data['total'] = $transaction->findAll();
        $data['baru'] = $transaction->where('status', 'proses')->findAll();
        $data['selesai'] = $transaction->where('status', 'selesai')->findAll();
        return view('admin/dashboard', $data);
    }
}
