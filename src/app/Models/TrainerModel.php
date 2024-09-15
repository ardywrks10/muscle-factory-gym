<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerModel extends Model
{
    use HasFactory;
    public $primarykey = 'id';
    protected $table = 'tb_trainers';
    protected $fillable = ['nama', 'no_telp', 'alamat', 'email', 'foto'];

    public function kelas()
    {
        return $this->hasMany(KelasModel::class);
    }
}
