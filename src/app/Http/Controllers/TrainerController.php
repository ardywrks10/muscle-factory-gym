<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerModel;

class TrainerController extends Controller
{
    public function view_trainer()
    {
        $data = TrainerModel::all();
        return response()->json(['data' => $data]);  
    }

    public function create_trainer(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:1',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
            'email'=> 'required|email',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        try {
            $fileName = time() . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('photos', $fileName, 'public');
            $validated['foto'] = $path;
            $data = TrainerModel::create($validated);
    
            return response()->json([
                'message' => 'Data berhasil disimpan!',
                'data' => $data
            ], 201); 
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data gagal disimpan!',
                'message' => $e->getMessage()
            ], 500); 
        }
    }

    public function update_trainer(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:1',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
            'email'=> 'required|email',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);
    
        try{
            if($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('photos', $fileName);
                $validated['foto'] = $path;
            }
            $data = TrainerModel::find($id)->update($validated);
            return response()->json([
                'message' => 'Data berhasil dirubah',
                'data' => $data
            ], 201); 
            
        } catch (\Exception $e){
            return response()->json([
                'error' => 'Data gagal dirubah',
                'message' => $e->getMessage() 
            ], 500);
        }
    }

    public function destroy_trainer($id)
    {
        try {
            $data = TrainerModel::findOrFail($id);
            $data->delete();
            return response()->json("Data berhasil trainer dihapus!");
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
