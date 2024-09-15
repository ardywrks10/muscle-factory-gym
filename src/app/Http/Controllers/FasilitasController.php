<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasilitasModel;

class FasilitasController extends Controller
{
    public function view_fasilitas()
    {
        $fasilitas = FasilitasModel::with('kelas:id,nama_kelas')->get();
        $data = $fasilitas->map(function ($fasilitas) {
            return [
                'id' => $fasilitas->id,
                'nm_fasilitas' => $fasilitas->nm_fasilitas,
                'kapasitas' => $fasilitas->kapasitas,
                'foto' => $fasilitas->foto,
                'nama_kelas' => $fasilitas->kelas ? $fasilitas->kelas->nama_kelas : null,
                'created_at' => $fasilitas->created_at,
                'updated_at' => $fasilitas->updated_at,
            ];
        });
        return response()->json(['data' => $data]);  
    }

    public function create_fasilitas(Request $request)
    {
        $validated = $request->validate([
            'nm_fasilitas' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'kelas_id'=> 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        try{
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('photos', $fileName, 'public');
            $validated['foto'] = $path;
            $data = FasilitasModel::create($validated);
            return response()->json("Data berhasil disimpan!"); 

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function update_fasilitas(Request $request, $id)
    {
        $validated = $request->validate([
            'nm_fasilitas' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'kelas_id'=> 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);
    
        try{
            if($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('photos', $fileName);
                $validated['foto'] = $path;
            }
            $data = FasilitasModel::find($id)->update($validated);
            return response()->json("Data berhasil dirubah!"); 
            
        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy_fasilitas($id)
    {
        try {
            $data = FasilitasModel::findOrFail($id);
            $data->delete();
            return response()->json("Data fasilitas berhasil dihapus!");
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
