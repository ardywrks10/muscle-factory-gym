<?php

namespace App\Models;

use App\Models\TrainerModel;
use App\Models\TransaksiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberModel extends Model
{
    use HasFactory;
    public $primarykey = 'id';
    protected $table   = 'tb_members';
    protected $fillable= ['nama', 'email', 'no_telp', 'foto', 'alamat'];

    public function trainers()
    {
        return $this->belongsTo(TrainerModel::class, 'trainer_id');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'trainer_id');
    }
}

