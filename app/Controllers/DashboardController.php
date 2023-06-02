<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class DashboardController extends BaseController
{
   public function index()
   {
      $transaction = new TransactionModel();
      if (session('role') == 'admin') {
         $data['total'] = $transaction->findAll();
         $data['baru'] = $transaction->where('status', 'proses')->findAll();
         $data['selesai'] = $transaction->where('status', 'selesai')->findAll();
      } else {
         $id = session('id');
         $data['total'] = $transaction->where('user_id', $id)->findAll();
         $data['baru'] = $transaction->where('status', 'proses')->where('user_id', $id)->findAll();
         $data['selesai'] = $transaction->where('status', 'selesai')->where('user_id', $id)->findAll();
      }
      return view('auth/dashboard', $data);
   }
}
