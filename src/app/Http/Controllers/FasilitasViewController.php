<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use Illuminate\Http\Request;
use App\Models\FasilitasModel;

class FasilitasViewController extends Controller
{
    public function index() 
    {
        $data = FasilitasModel::with('kelas:id,nama_kelas')->get();
        return view('backpage.index_fasilitas', compact('data'));
    }

    public function create()
    {
        $title  = 'Input Fasilitas Page';
        $kelas  = KelasModel::all();
        return view('backpage.input_fasilitas', compact('title', 'kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required',
            'nm_fasilitas' => 'required',
            'kapasitas' => 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        try{
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('photos', $fileName, 'public');
            $validated['foto'] = $path;
            $data = FasilitasModel::create($validated);
            return redirect('fasilitas');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $title = 'Edit/Update Fasilitas Page';
        $data  = FasilitasModel::findOrFail($id);
        $kelas  = KelasModel::all();
        return view('backpage.input_fasilitas', compact('data', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kelas_id' => 'required',
            'nm_fasilitas' => 'required',
            'kapasitas' => 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);
        try{
            if($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('photos', $fileName);
                $validated['foto'] = $path;
            }
            $data = FasilitasModel::find($id)->update($validated);
            return redirect('fasilitas');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $data = FasilitasModel::findOrFail($id);
            $data->delete();
            return redirect('fasilitas');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
