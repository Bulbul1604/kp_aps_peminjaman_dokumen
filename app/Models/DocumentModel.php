<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
   protected $table            = 'documents';
   protected $primaryKey       = 'doc_id';
   protected $useAutoIncrement = true;
   protected $returnType       = 'object';
   protected $allowedFields    = [
      'transaction_number', 'title_file', 'request_file'
   ];
}
