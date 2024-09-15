<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function view_trans() 
    {
        $transaksi = TransaksiModel::with('members:id,nama', 'kelas:id,nama_kelas')->get();
        $data = $transaksi->map(function ($transaksi) {
            return [
                'id' => $transaksi->id,
                'nama_member' => $transaksi->members ? $transaksi->members->nama : null,
                'nama_kelas' => $transaksi->kelas ? $transaksi->kelas->nama_kelas : null,
                'tanggal_transaksi' => $transaksi->tgl_transaksi,
                'jumlah_bulan' => $transaksi->jumlah_bulan,
                'total_pembayaran' => $transaksi->total_bayar,
                'uang_diterima' => $transaksi->uang_diterima,
                'created_at' => $transaksi->created_at,
                'updated_at' => $transaksi->updated_at,
            ];
        });
        return response()->json(['data' => $data]);  
    }

    public function create_trans(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_bulan' => 'required|integer',
            'uang_diterima' => 'required|decimal|min:0',
        ]);

        $kelas = KelasModel::find($request->kelas_id);
        $totalBiaya = $request->jumlah_bulan * $kelas->harga_perbulan;

        if ($request->uang_diterima < $totalBiaya) {
            return response()->json(['error' => 'Uang yang diterima tidak cukup.'], 400);
        }

        DB::beginTransaction();
        try {
            $transaksi = $request->all();
            $transaksi['total_bayar'] = $totalBiaya;
            $transaksi['tgl_transaksi'] = now();
            $data = TransaksiModel::create($transaksi);
            DB::commit();
            return response()->json([
                'success' => 'Transaksi berhasil disimpan.', 
                'data' => $transaksi], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Transaksi gagal dilakukan.'], 500);
        }
    }

    public function update_trans(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required',
            'kelas_id' => 'required',
            'jumlah_bulan' => 'required|integer',
            'uang_diterima' => 'required|decimal|min:0',
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

        DB::beginTransaction();

        try {
            $transaksi->member_id = $request->member_id;
            $transaksi->kelas_id = $request->kelas_id;
            $transaksi->jumlah_bulan = $request->jumlah_bulan;
            $transaksi->uang_diterima = $request->uang_diterima;
            $transaksi->tgl_transaksi = now();
            $transaksi->total_bayar = $totalBiaya;

            $transaksi->save(); 

            DB::commit();

            return response()->json([
                'success' => 'Transaction berhasil diperbarui.',
                'data' => $transaksi
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction gagal diperbarui.'], 500);
        }
    }

    public function destroy_trans($id)
    {
        $transaksi = TransaksiModel::find($id);

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        DB::beginTransaction();

        try {
            $transaksi->delete();
            DB::commit();
            return response()->json(['success' => 'Transaksi berhasil dihapus'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaksi gagal dihapus'], 500);
        }
    }
}
