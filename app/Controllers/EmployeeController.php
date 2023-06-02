<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class EmployeeController extends BaseController
{
   protected $user;
   protected $helpers = ['form'];
   public function __construct()
   {
      $this->user = new UserModel();
   }
   public function index()
   {
      $data['employees'] = $this->user->where('role', 'karyawan')->findAll();
      return view('auth/employee/index', $data);
   }
}
