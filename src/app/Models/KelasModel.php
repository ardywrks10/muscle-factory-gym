<?php

namespace App\Models;

use App\Models\TrainerModel;
use App\Models\TransaksiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasModel extends Model
{
    use HasFactory;
    public $primarykey = 'id';
    protected $table   = 'tb_kelas';
    protected $fillable= ['trainer_id', 'nama_kelas', 'jadwal', 'harga_perbulan'];

    public function trainers()
    {
        return $this->belongsTo(TrainerModel::class, 'trainer_id');
    }
    
    public function fasilitas()
    {
        return $this->hasMany(FasilitasModel::class);
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'trainer_id');
    }
}
