<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;

class MemberController extends Controller
{
    public function view_member()
    {
        $data = MemberModel::all();
        return view('member.index', compact( 'data'));
    }

    public function create_member(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_telp' => 'required|string',
            'email'=> 'required|email',
            'alamat'=> 'required|string',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        try{
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('photos', $fileName, 'public');
            $validated['foto'] = $path;
            $data = MemberModel::create($validated);
            return response()->json("Data berhasil disimpan!"); 

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function update_member(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_telp' => 'required|string',
            'email'=> 'required|email',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
            'trainer_id'=> 'required',
        ]);
    
        try{
            if($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('photos', $fileName);
                $validated['foto'] = $path;
            }
            $data = MemberModel::find($id)->update($validated);
            return response()->json("Data berhasil dirubah!"); 
            
        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $data = MemberModel::findOrFail($id);
            $data->delete();
            return response()->json("Data member berhasil dihapus!");
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
