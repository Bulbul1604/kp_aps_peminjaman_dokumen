<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'no_permintaan';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'no_permintaan', 'npk', 'nama', 'unit_kerja', 'jenis', 'tgl_permintaan', 'keperluan', 'tgl_pinjam', 'tgl_kembali', 'dokumen', 'status'
    ];

    function dokumen($id)
    {
        return $this->db->table('transactions')
            ->join('documents', 'documents.transaction_no_permintaan =transactions.no_permintaan ')
            ->where('transactions.no_permintaan', $id)
            ->get()
            ->getFirstRow();
    }
}
