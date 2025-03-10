<?php

namespace App\Http\Controllers;

use App\Models\TrainerModel;
use Illuminate\Http\Request;

class TrainerViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title ='Trainer Page';
        $data = TrainerModel::paginate(5); // Eager loading relasi jurusan
        $total_mhs = TrainerModel::count();
        return view('backpage.index_trainer', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Input Trainer Page';
        return view('backpage.input_trainer', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        try{
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('photos', $fileName, 'public');
            $validated['foto'] = $path;
            $data = TrainerModel::create($validated);
            return redirect('trainer');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // menampilkan jurusan
        $data = Dataset::with('jurusan')->findOrFail($id);
        // return response()->json(['data' => $data]);
        return new DataDetailResource($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit/Update Trainer Page';
        $data  = TrainerModel::findOrFail($id);
        return view('backpage.input_trainer', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:png,jpg|max:1024',
        ]);
    
        try{
            if($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('photos', $fileName);
                $validated['foto'] = $path;
            }
            $data = TrainerModel::find($id)->update($validated);
            return redirect('trainer');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = TrainerModel::findOrFail($id);
            $data->delete();
            return redirect('kkn');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Menampilkan data jurusan
     */
    public function view_d() {
        $data = Dataset::all();
        return response()->json(['data' => $data]);
    }

}

