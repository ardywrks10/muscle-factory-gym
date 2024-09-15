<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\TrainerModel;
use Illuminate\Http\Request;

class KelasViewController extends Controller
{
    public function index() 
    {
        $data = KelasModel::with('trainers:id,nama')->get();
        return view('backpage.index_kelas', compact('data'));
    }

    public function create()
    {
        $title  = 'Input Kelas Page';
        $trainer = TrainerModel::all();
        return view('backpage.input_kelas', compact('title', 'trainer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainer_id' => 'required',
            'nama_kelas' => 'required',
            'jadwal' => 'required',
            'harga_perbulan' => 'required|numeric|min:0',
        ]);

        try{
            $data = KelasModel::create($validated);
            return redirect('kelas');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $title = 'Edit/Update Kelas Page';
        $data  = KelasModel::findOrFail($id);
        $trainer  = TrainerModel::all();
        return view('backpage.input_kelas', compact('data', 'trainer'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'trainer_id' => 'required',
            'nama_kelas' => 'required',
            'jadwal' => 'required',
            'harga_perbulan' => 'required|numeric|min:0',
        ]);

        try{
            $data = KelasModel::find($id)->update($validated);
            return redirect('kelas');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $data = KelasModel::findOrFail($id);
            $data->delete();
            return redirect('kelas');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
