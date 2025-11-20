<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\KategoriBiro;
use App\Models\PeriodeKepengurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KategoriBiroController extends Controller
{
    /**
     * Menampilkan daftar kategori biro
     */
    public function index()
    {
        $kategoriBiro = KategoriBiro::withCount(['programKerja', 'kader'])
            ->orderBy('nama')
            ->paginate(15);
        
        return view('presidium.kategori-biro.index', compact('kategoriBiro'));
    }

    /**
     * Menampilkan form tambah kategori biro
     */
    public function create()
    {
        return view('presidium.kategori-biro.create');
    }

    /**
     * Menyimpan kategori biro baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kategori_biro,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_aktif' => 'boolean',
        ]);

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        KategoriBiro::create($validated);

        return redirect()->route('presidium.kategori-biro.index')
            ->with('success', 'Kategori biro berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori biro
     */
    public function show(KategoriBiro $kategoriBiro)
    {
        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        // Load kabid dengan pivot periode_id, filter hanya kabid dari periode presidium
        if (!empty($presidiumPeriodeIds)) {
            $kategoriBiro->load(['programKerja', 'kader']);
            // Load kabid yang memiliki periode yang sama dengan presidium
            $kategoriBiro->load(['kabid' => function($query) use ($presidiumPeriodeIds) {
                $query->wherePivotIn('periode_id', $presidiumPeriodeIds);
            }]);
        } else {
            $kategoriBiro->load(['programKerja', 'kader', 'kabid']);
        }
        
        // Get list kader yang belum ditambahkan ke biro ini
        $existingKaderIds = $kategoriBiro->kader->pluck('id')->toArray();
        $availableKaders = User::whereHas('roleModel', function($q) {
            $q->where('name', 'kader');
        })->where('status_aktif', true);
        
        // Filter kader berdasarkan periode presidium yang login
        if (!empty($presidiumPeriodeIds)) {
            $availableKaders->whereHas('periodeKader', function($q) use ($presidiumPeriodeIds) {
                $q->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
            });
        } else {
            // Jika presidium belum memiliki periode, tidak tampilkan kader
            $availableKaders->whereRaw('1 = 0');
        }
        
        // Exclude kader yang sudah ditambahkan ke biro ini
        if (!empty($existingKaderIds)) {
            $availableKaders->whereNotIn('id', $existingKaderIds);
        }
        
        $availableKaders = $availableKaders->with(['periodeKader', 'kategoriBiro'])->orderBy('name')->get();
        
        // Get list kabid yang belum ditambahkan ke biro ini untuk periode presidium
        // Cek kabid yang sudah ada di kategori biro ini untuk periode presidium
        $existingKabidPeriodeIds = [];
        if (!empty($presidiumPeriodeIds)) {
            $existingKabidPeriodeIds = DB::table('kategori_biro_kabid')
                ->where('kategori_biro_id', $kategoriBiro->id)
                ->whereIn('periode_id', $presidiumPeriodeIds)
                ->pluck('kabid_id')
                ->toArray();
        }
        
        $availableKabids = User::whereHas('roleModel', function($q) {
            $q->where('name', 'kabid');
        })->where('status_aktif', true);
        
        // Filter kabid berdasarkan periode presidium yang login
        if (!empty($presidiumPeriodeIds)) {
            $availableKabids->whereHas('periodeKabid', function($q) use ($presidiumPeriodeIds) {
                $q->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
            });
        } else {
            // Jika presidium belum memiliki periode, tidak tampilkan kabid
            $availableKabids->whereRaw('1 = 0');
        }
        
        // Exclude kabid yang sudah ditambahkan ke biro ini untuk periode presidium
        if (!empty($existingKabidPeriodeIds)) {
            $availableKabids->whereNotIn('id', $existingKabidPeriodeIds);
        }
        
        $availableKabids = $availableKabids->with(['periodeKabid'])->orderBy('name')->get();
        
        return view('presidium.kategori-biro.show', compact('kategoriBiro', 'availableKaders', 'availableKabids', 'presidiumPeriodeIds'));
    }

    /**
     * Menampilkan form edit kategori biro
     */
    public function edit(KategoriBiro $kategoriBiro)
    {
        return view('presidium.kategori-biro.edit', compact('kategoriBiro'));
    }

    /**
     * Update kategori biro
     */
    public function update(Request $request, KategoriBiro $kategoriBiro)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kategori_biro,kode,' . $kategoriBiro->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_aktif' => 'boolean',
        ]);

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        $kategoriBiro->update($validated);

        return redirect()->route('presidium.kategori-biro.index')
            ->with('success', 'Kategori biro berhasil diperbarui.');
    }

    /**
     * Hapus kategori biro
     */
    public function destroy(KategoriBiro $kategoriBiro)
    {
        // Cek apakah ada program kerja yang menggunakan kategori biro ini
        if ($kategoriBiro->programKerja->count() > 0) {
            return redirect()->back()
                ->with('error', 'Kategori biro tidak dapat dihapus karena masih digunakan oleh program kerja.');
        }

        $kategoriBiro->delete();

        return redirect()->route('presidium.kategori-biro.index')
            ->with('success', 'Kategori biro berhasil dihapus.');
    }

    /**
     * Menambahkan kader ke kategori biro
     */
    public function attachKader(Request $request, KategoriBiro $kategoriBiro)
    {
        $request->validate([
            'kader_id' => 'required|exists:users,id',
        ]);

        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();

        // Reload kader untuk memastikan data terbaru
        $kategoriBiro->load('kader');

        // Cek apakah kader sudah ada
        $existingKaderIds = $kategoriBiro->kader->pluck('id')->toArray();
        if (in_array($request->kader_id, $existingKaderIds)) {
            return redirect()->back()
                ->with('error', 'Kader sudah ditambahkan ke kategori biro ini.');
        }

        // Cek apakah user adalah kader
        $kader = User::findOrFail($request->kader_id);
        if (!$kader->roleModel || $kader->roleModel->name !== 'kader') {
            return redirect()->back()
                ->with('error', 'User yang dipilih bukan kader.');
        }

        // Cek apakah kader memiliki periode yang sama dengan presidium
        if (!empty($presidiumPeriodeIds)) {
            $kader->load('periodeKader');
            $kaderPeriodeIds = $kader->periodeKader->pluck('id')->toArray();
            $hasMatchingPeriode = !empty(array_intersect($presidiumPeriodeIds, $kaderPeriodeIds));
            
            if (!$hasMatchingPeriode) {
                return redirect()->back()
                    ->with('error', 'Kader tidak memiliki periode yang sama dengan presidium yang login.');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Presidium belum memiliki periode kepengurusan.');
        }

        $kategoriBiro->kader()->attach($request->kader_id);

        return redirect()->back()
            ->with('success', 'Kader berhasil ditambahkan.');
    }

    /**
     * Menghapus kader dari kategori biro
     */
    public function detachKader(KategoriBiro $kategoriBiro, User $kader)
    {
        $kategoriBiro->kader()->detach($kader->id);

        return redirect()->back()
            ->with('success', 'Kader berhasil dihapus dari kategori biro.');
    }

    /**
     * Menambahkan kabid ke kategori biro
     */
    public function attachKabid(Request $request, KategoriBiro $kategoriBiro)
    {
        $request->validate([
            'kabid_id' => 'required|exists:users,id',
            'periode_id' => 'required|exists:periode_kepengurusan,id',
        ]);

        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();

        // Validasi periode harus sesuai dengan periode presidium
        if (!empty($presidiumPeriodeIds) && !in_array($request->periode_id, $presidiumPeriodeIds)) {
            return redirect()->back()
                ->with('error', 'Periode yang dipilih tidak sesuai dengan periode presidium yang login.');
        }

        // Cek apakah kabid sudah ada untuk periode ini
        $existingKabid = DB::table('kategori_biro_kabid')
            ->where('kategori_biro_id', $kategoriBiro->id)
            ->where('kabid_id', $request->kabid_id)
            ->where('periode_id', $request->periode_id)
            ->first();

        if ($existingKabid) {
            return redirect()->back()
                ->with('error', 'Kabid sudah ditambahkan ke kategori biro ini untuk periode tersebut.');
        }

        // Cek apakah user adalah kabid
        $kabid = User::findOrFail($request->kabid_id);
        if (!$kabid->roleModel || $kabid->roleModel->name !== 'kabid') {
            return redirect()->back()
                ->with('error', 'User yang dipilih bukan kabid.');
        }

        // Cek apakah kabid memiliki periode yang dipilih
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        if (!in_array($request->periode_id, $kabidPeriodeIds)) {
            return redirect()->back()
                ->with('error', 'Kabid tidak memiliki periode yang dipilih.');
        }

        // Attach dengan periode_id
        $kategoriBiro->kabid()->attach($request->kabid_id, ['periode_id' => $request->periode_id]);

        return redirect()->back()
            ->with('success', 'Kabid berhasil ditambahkan.');
    }

    /**
     * Menghapus kabid dari kategori biro
     */
    public function detachKabid(Request $request, KategoriBiro $kategoriBiro, User $kabid)
    {
        $periodeId = $request->input('periode_id');
        
        if ($periodeId) {
            // Hapus berdasarkan periode_id juga
            DB::table('kategori_biro_kabid')
                ->where('kategori_biro_id', $kategoriBiro->id)
                ->where('kabid_id', $kabid->id)
                ->where('periode_id', $periodeId)
                ->delete();
        } else {
            // Fallback: hapus semua relasi kabid dengan kategori biro ini (untuk backward compatibility)
            $kategoriBiro->kabid()->detach($kabid->id);
        }

        return redirect()->back()
            ->with('success', 'Kabid berhasil dihapus dari kategori biro.');
    }
}

