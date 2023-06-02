<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
   protected $table            = 'transactions';
   protected $primaryKey       = 'request_number';
   protected $useAutoIncrement = false;
   protected $returnType       = 'object';
   protected $allowedFields    = [
      'request_number', 'user_id', 'type', 'request_date', 'need', 'borrow_date', 'return_date', 'document', 'status'
   ];

   function getLending()
   {
      return $this->select('*')
         ->join('users', 'users.id=transactions.user_id')
         ->join('documents', 'documents.transaction_number=transactions.request_number')
         ->get()->getResult();
   }
   function getLendingWithUserId($id)
   {
      return $this->select('*')
         ->join('users', 'users.id=transactions.user_id')
         ->join('documents', 'documents.transaction_number=transactions.request_number')
         ->where('users.id', $id)
         ->get()->getResult();
   }
   function getLendingShow($id)
   {
      return $this->select('*')
         ->join('users', 'users.id=transactions.user_id')
         ->join('documents', 'documents.transaction_number=transactions.request_number')
         ->where('transactions.request_number', $id)
         ->get()->getFirstRow();
   }
   function dokumen($id)
   {
      return $this->db->table('transactions')
         ->join('documents', 'documents.transaction_number = transactions.request_number')
         ->where('transactions.request_number', $id)
         ->get()
         ->getFirstRow();
   }
}
