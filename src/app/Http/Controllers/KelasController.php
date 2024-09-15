<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasModel;

class KelasController extends Controller
{
    public function view_kelas()
    {
        $kelas = KelasModel::with('trainers:id,nama')->get();
        $data = $kelas->map(function ($kelas) {
            return [
                'id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
                'jadwal' => $kelas->jadwal,
                'harga_perbulan' => $kelas->harga_perbulan,
                'nama_trainer' => $kelas->trainers ? $kelas->trainers->nama : null,
                'created_at' => $kelas->created_at,
                'updated_at' => $kelas->updated_at,
            ];
        });
        return response()->json(['data' => $data]);  
    }

    public function create_kelas(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string',
            'jadwal' => 'required|string',
            'trainer_id'=> 'required',
            'harga_perbulan'=> 'required|decimal',
        ]);

        try{
            $data = KelasModel::create($validated);
            return response()->json("Data berhasil disimpan!"); 

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function update_kelas(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string',
            'jadwal' => 'required|string',
            'harga_perbulan'=>'required|decimal',
            'trainer_id'=> 'required',
        ]);
    
        try{
            $data = KelasModel::find($id)->update($validated);
            return response()->json("Data berhasil dirubah!"); 
            
        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy_kelas($id)
    {
        try {
            $data = KelasModel::findOrFail($id);
            $data->delete();
            return response()->json("Data kelas berhasil dihapus!");
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
