<?php

namespace App\Models;

use App\Models\KelasModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FasilitasModel extends Model
{
    use HasFactory;
    public $primarykey = 'id';
    protected $table   = 'tb_fasilitas';
    protected $fillable= ['kelas_id', 'nm_fasilitas', 'kapasitas', 'foto'];

    public function kelas()
    {
        return $this->belongsTo(KelasModel::class);
    }
}
