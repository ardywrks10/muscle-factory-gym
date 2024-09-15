<?php

namespace App\Http\Controllers;
use App\Models\KelasModel;
use App\Models\MemberModel;
use App\Models\TrainerModel;
use App\Models\TransaksiModel;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $memberCount = MemberModel::count();
        $transCount = TransaksiModel::count();
        $kelasCount = KelasModel::count();
        $trainerCount = TrainerModel::count();
        return view('components.admin-layout', compact('memberCount', 'transCount', 'kelasCount', 'trainerCount'));
    }
}
