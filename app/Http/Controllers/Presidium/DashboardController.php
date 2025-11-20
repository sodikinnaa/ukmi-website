<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerja;
use App\Models\Dokumentasi;
use App\Models\Absensi;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard presidium
     */
    public function index()
    {
        $user = Auth::user();
        
        // Load periode presidium
        $user->load('periodePresidium');
        $periodeIds = $user->periodePresidium->pluck('id')->toArray();
        
        // Cek apakah tabel pertemuan ada
        $hasPertemuanTable = Schema::hasTable('pertemuan');
        
        // Inisialisasi variabel default
        $totalKader = 0;
        $totalKabid = 0;
        $totalProgramKerja = 0;
        $totalDokumentasi = 0;
        $totalAbsensi = 0;
        $totalPertemuan = 0;
        $programKerjaAktif = 0;
        $programKerjaSelesai = 0;
        $programKerjaIds = [];
        $recentProgramKerja = collect();
        
        // Statistik berdasarkan periode presidium
        if (!empty($periodeIds)) {
            // Total kader yang terdaftar di periode presidium
            // Hanya menghitung user dengan role 'kader'
            $totalKader = DB::table('kader_periode')
                ->whereIn('periode_id', $periodeIds)
                ->join('users', 'kader_periode.kader_id', '=', 'users.id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.name', 'kader')
                ->distinct()
                ->count('kader_periode.kader_id');
            
            // Total kabid yang terdaftar di periode presidium
            // Kabid juga menggunakan tabel kader_periode (berdasarkan relasi periodeKabid)
            $totalKabid = DB::table('kader_periode')
                ->whereIn('periode_id', $periodeIds)
                ->join('users', 'kader_periode.kader_id', '=', 'users.id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.name', 'kabid')
                ->distinct()
                ->count('kader_periode.kader_id');
            
            // Get program kerja IDs di periode ini
            $programKerjaIds = ProgramKerja::whereIn('periode_id', $periodeIds)->pluck('id')->toArray();
            
            // Total program kerja di periode ini
            $totalProgramKerja = ProgramKerja::whereIn('periode_id', $periodeIds)->count();
            
            // Total dokumentasi dari program kerja di periode ini
            if (!empty($programKerjaIds)) {
                $totalDokumentasi = Dokumentasi::whereIn('program_kerja_id', $programKerjaIds)->count();
            }
            
            // Total absensi dari program kerja di periode ini
            if (!empty($programKerjaIds)) {
                $totalAbsensi = Absensi::whereIn('program_kerja_id', $programKerjaIds)->count();
            }
            
            // Total pertemuan dari program kerja di periode ini
            if ($hasPertemuanTable && !empty($programKerjaIds)) {
                $totalPertemuan = Pertemuan::whereIn('program_kerja_id', $programKerjaIds)->count();
            }
            
            // Program kerja aktif di periode ini
            $programKerjaAktif = ProgramKerja::whereIn('periode_id', $periodeIds)
                ->where('status', 'aktif')
                ->count();
            
            // Program kerja selesai di periode ini
            $programKerjaSelesai = ProgramKerja::whereIn('periode_id', $periodeIds)
                ->where('status', 'selesai')
                ->count();
            
            // Program kerja terbaru di periode ini
            $recentProgramKerja = ProgramKerja::whereIn('periode_id', $periodeIds)
                ->with(['creator', 'periode'])
                ->withCount(['kader', 'pertemuan'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }
        
        // Get list periode untuk ditampilkan
        $periodeList = $user->periodePresidium;
        
        return view('presidium.dashboard.index', [
            'user' => $user,
            'periodeList' => $periodeList,
            'periodeIds' => $periodeIds,
            'totalKader' => $totalKader,
            'totalKabid' => $totalKabid,
            'totalProgramKerja' => $totalProgramKerja,
            'totalDokumentasi' => $totalDokumentasi,
            'totalAbsensi' => $totalAbsensi,
            'totalPertemuan' => $totalPertemuan,
            'programKerjaAktif' => $programKerjaAktif,
            'programKerjaSelesai' => $programKerjaSelesai,
            'recentProgramKerja' => $recentProgramKerja,
            'hasPertemuanTable' => $hasPertemuanTable,
        ]);
    }
}

