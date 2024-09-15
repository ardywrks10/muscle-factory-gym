<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\MemberModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransaksiViewController extends Controller
{
    public function index() 
    {
        $data = TransaksiModel::with('members:id,nama', 'kelas:id,nama_kelas')->get();
        return view('backpage.index_transaksi', compact('data'));
    }

    public function create()
    {
        $title  = 'Input Transaksi Page';
        $member = MemberModel::all();
        $kelas  = KelasModel::all();
        return view('backpage.input_transaksi', compact('title', 'member', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_bulan' => 'required|integer',
            'uang_diterima' => 'required|numeric|min:0',
        ]);
    
        $kelas = KelasModel::find($request->kelas_id);
        $totalBiaya = $request->jumlah_bulan * $kelas->harga_perbulan;
    
        if ($request->uang_diterima < $totalBiaya) {
            return response()->json(['error' => 'Uang yang diterima tidak cukup.'], 400);
        }
    
        try {
            $transaksi = $request->all();
            $transaksi['total_bayar'] = $totalBiaya;
            $transaksi['tgl_transaksi'] = now();
            TransaksiModel::create($transaksi);
            return redirect('transaksi');
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Transaksi gagal dilakukan.'], 500);
        }
    }
    

    public function edit($id)
    {
        $title = 'Edit/Update Transaksi Page';
        $data  = TransaksiModel::findOrFail($id);
        $member = MemberModel::all();
        $kelas  = KelasModel::all();
        return view('backpage.input_transaksi', compact('title', 'member', 'kelas', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_bulan' => 'required|integer',
            'uang_diterima' => 'required|numeric|min:0',
        ]);

        $transaksi = TransaksiModel::find($id);

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi yang anda cari tidak ditemukan'], 404);
        }

        $kelas = KelasModel::find($request->kelas_id);
        $totalBiaya = $request->jumlah_bulan * $kelas->harga_perbulan;

        if ($request->uang_diterima < $totalBiaya) {
            return response()->json(['error' => 'Uang yang diterima tidak mencukupi.'], 400);
        }

        try {
            $transaksi->member_id = $request->member_id;
            $transaksi->kelas_id = $request->kelas_id;
            $transaksi->jumlah_bulan = $request->jumlah_bulan;
            $transaksi->uang_diterima = $request->uang_diterima;
            $transaksi->tgl_transaksi = now();
            $transaksi->total_bayar = $totalBiaya;

            $transaksi->save();

            return redirect('transaksi');

        } catch (Exception $e) {
            return response()->json(['error' => 'Transaksi gagal diperbarui.'], 500);
        }
    }
    
    public function destroy($id)
    {
        $transaksi = TransaksiModel::find($id);

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        DB::beginTransaction();

        try {
            $transaksi->delete();
            DB::commit();
            return redirect('transaksi');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaksi gagal dihapus'], 500);
        }
    }
}
