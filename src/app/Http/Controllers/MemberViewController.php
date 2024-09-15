<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title ='Member Page';
        $data = MemberModel::paginate(5);
        $total_mhs = MemberModel::count();
        return view('backpage.index_member', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Input Member Page';
        return view('backpage.input_member', compact('title'));
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
            $data = MemberModel::create($validated);
            return redirect('member');

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit/Update Member Page';
        $data  = MemberModel::findOrFail($id);
        return view('backpage.input_member', compact('data'));
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
            $data = MemberModel::find($id)->update($validated);
            return redirect('member');

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
            $data = MemberModel::findOrFail($id);
            $data->delete();
            return redirect('kkn');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

    }

}

