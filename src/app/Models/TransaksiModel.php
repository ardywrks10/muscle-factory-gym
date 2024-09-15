<?php

namespace App\Models;

use App\Models\KelasModel;
use App\Models\MemberModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiModel extends Model
{
    use HasFactory;
    public $primarykey = 'id';
    protected $table = 'tb_transaksi';
    protected $fillable = ['member_id', 'kelas_id', 'jumlah_bulan', 'uang_diterima', 'total_bayar', 'tgl_transaksi'];

    public function members()
    {
        return $this->belongsTo(MemberModel::class, 'member_id');
    }
    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'kelas_id');
    }
}
