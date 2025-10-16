<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Siswa;
use App\Models\Mitra;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total siswa berdasarkan status PKL
        $belumPkl = Siswa::whereDoesntHave('registration')->count();
        $sedangPkl = Registration::where('status', 'diterima')->count();
        $selesaiPkl = Registration::where('status', 'selesai')->count();
        
        // Top 3 Mitra (berdasarkan jumlah siswa yang diterima)
        $topMitra = Mitra::select('mitras.*', DB::raw('COUNT(registrations.id) as total_siswa'))
            ->leftJoin('registrations', function($join) {
                $join->on('mitras.id', '=', 'registrations.mitra_diterima_id')
                     ->where('registrations.status', '=', 'diterima');
            })
            ->groupBy('mitras.id', 'mitras.name', 'mitras.alamat', 'mitras.kontak', 'mitras.email', 'mitras.created_at', 'mitras.updated_at')
            ->orderByDesc('total_siswa')
            ->limit(3)
            ->get();

        // Data untuk grafik pendaftaran (7 hari terakhir)
        $pendaftaranData = $this->getRegistrationChartData();
        
        return view('admin.index', compact(
            'belumPkl',
            'sedangPkl', 
            'selesaiPkl',
            'topMitra',
            'pendaftaranData'
        ));
    }

    private function getRegistrationChartData()
    {
        $dates = [];
        $labels = [];
        
        // Generate 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('Y-m-d');
            $labels[] = $date->format('j M');
        }

        // Hitung pendaftaran per status per hari
        $disetujui = [];
        $ditolak = [];
        $menunggu = [];

        foreach ($dates as $date) {
            $disetujui[] = Registration::whereDate('created_at', $date)
                ->where('status', 'diterima')
                ->count();
            
            $ditolak[] = Registration::whereDate('created_at', $date)
                ->where('status', 'ditolak')
                ->count();
            
            $menunggu[] = Registration::whereDate('created_at', $date)
                ->where('status', 'proses')
                ->count();
        }

        return [
            'labels' => $labels,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
            'menunggu' => $menunggu,
        ];
    }
}
