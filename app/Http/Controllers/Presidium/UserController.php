<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index(Request $request)
    {
        // Eager load semua relasi yang diperlukan, termasuk relasi nested
        $query = User::with([
            'roleModel',
            'periodeKader' => function($q) {
                $q->orderBy('tanggal_mulai', 'desc');
            },
            'periodeKabid' => function($q) {
                $q->orderBy('tanggal_mulai', 'desc');
            },
            'periodePresidium' => function($q) {
                $q->orderBy('tanggal_mulai', 'desc');
            }
        ]);
        
        // Filter berdasarkan role
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }
        
        // Filter berdasarkan periode
        if ($request->filled('periode_id')) {
            $periodeId = $request->periode_id;
            $query->where(function($q) use ($periodeId) {
                $q->whereHas('periodeKader', function($subQ) use ($periodeId) {
                    $subQ->where('periode_kepengurusan.id', $periodeId);
                })
                ->orWhereHas('periodeKabid', function($subQ) use ($periodeId) {
                    $subQ->where('periode_kepengurusan.id', $periodeId);
                })
                ->orWhereHas('periodePresidium', function($subQ) use ($periodeId) {
                    $subQ->where('periode_kepengurusan.id', $periodeId);
                });
            });
        }
        
        // Filter berdasarkan search (nama, email, npm)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('name')->paginate(15)->withQueryString();
        
        // Pastikan relasi periode dimuat untuk setiap user (untuk mengatasi masalah pagination)
        $users->getCollection()->each(function($user) {
            if (!$user->relationLoaded('periodeKader')) {
                $user->load('periodeKader');
            }
            if (!$user->relationLoaded('periodeKabid')) {
                $user->load('periodeKabid');
            }
            if (!$user->relationLoaded('periodePresidium')) {
                $user->load('periodePresidium');
            }
            if (!$user->relationLoaded('roleModel')) {
                $user->load('roleModel');
            }
        });
        
        // Get semua roles untuk dropdown filter
        $roles = Role::orderBy('name')->get();
        
        // Get semua periode untuk dropdown filter
        $periodeList = \App\Models\PeriodeKepengurusan::orderBy('tanggal_mulai', 'desc')->get();
        
        return view('presidium.user.index', compact('users', 'roles', 'periodeList'));
    }

    /**
     * Menampilkan form tambah user
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        
        // Get semua periode untuk kader, kabid, dan presidium
        $periodeList = \App\Models\PeriodeKepengurusan::orderBy('tanggal_mulai', 'desc')->get();
        $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
        
        return view('presidium.user.create', compact('roles', 'periodeList', 'periodeAktif'));
    }

    /**
     * Menyimpan user baru
     */
    public function store(Request $request)
    {
        // Validasi dasar (tanpa validasi password dulu)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string',
            'password_confirmation' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'jabatan' => 'nullable|string|max:255',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nomor_wa' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'npm' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'hobi' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'status_aktif' => 'boolean',
            'periode_ids' => 'nullable|array',
            'periode_ids.*' => 'exists:periode_kepengurusan,id',
        ]);

        // Handle foto profile upload
        if ($request->hasFile('foto_profile')) {
            $validated['foto_profile'] = $request->file('foto_profile')->store('profiles', 'public');
        }

        // Set password default ke NPM jika password tidak diisi
        if (empty($validated['password']) || trim($validated['password']) === '') {
            if (empty($validated['npm']) || trim($validated['npm']) === '') {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['npm' => 'NPM harus diisi jika password tidak diisi.']);
            }
            $validated['password'] = $validated['npm'];
            $validated['password_confirmation'] = $validated['npm'];
        } else {
            // Jika password diisi, validasi minimal 6 karakter
            if (strlen(trim($validated['password'])) < 6) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['password' => 'Password harus minimal 6 karakter.']);
            }
            
            // Validasi password confirmation
            if (empty($validated['password_confirmation']) || $validated['password'] !== $validated['password_confirmation']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['password_confirmation' => 'Konfirmasi password tidak sesuai.']);
            }
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);
        $validated['status_aktif'] = $request->has('status_aktif');

        $user = User::create($validated);

        // Handle periode assignment berdasarkan role
        $role = \App\Models\Role::find($validated['role_id']);
        if ($role) {
            $periodeIds = $request->input('periode_ids', []);
            $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
            
            if ($role->name === 'presidium') {
                // Untuk presidium, sync periode yang dipilih
                if (!empty($periodeIds)) {
                    $user->periodePresidium()->sync($periodeIds);
                }
            } elseif ($role->name === 'kader') {
                // Untuk kader, gunakan periode yang dipilih atau default ke periode aktif
                if (!empty($periodeIds)) {
                    $user->periodeKader()->sync($periodeIds);
                } elseif ($periodeAktif) {
                    $user->periodeKader()->attach($periodeAktif->id);
                }
            } elseif ($role->name === 'kabid') {
                // Untuk kabid, gunakan periode yang dipilih atau default ke periode aktif
                if (!empty($periodeIds)) {
                    $user->periodeKabid()->sync($periodeIds);
                } elseif ($periodeAktif) {
                    $user->periodeKabid()->attach($periodeAktif->id);
                }
            }
        }

        return redirect()->route('presidium.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail user
     */
    public function show(User $user)
    {
        $user->load(['roleModel', 'periodeKader']);
        
        return view('presidium.user.show', compact('user'));
    }

    /**
     * Menampilkan form edit user
     */
    public function edit(User $user)
    {
        $user->load(['roleModel', 'periodeKader', 'periodeKabid', 'periodePresidium']);
        $roles = Role::orderBy('name')->get();
        
        // Get semua periode untuk kader, kabid, dan presidium
        $periodeList = \App\Models\PeriodeKepengurusan::orderBy('tanggal_mulai', 'desc')->get();
        $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
        
        // Get periode yang sudah dipilih (untuk kader, kabid, atau presidium)
        $selectedPeriodeIds = [];
        if ($user->roleModel) {
            if ($user->roleModel->name === 'kader') {
                $selectedPeriodeIds = $user->periodeKader->pluck('id')->toArray();
            } elseif ($user->roleModel->name === 'kabid') {
                $selectedPeriodeIds = $user->periodeKabid->pluck('id')->toArray();
            } elseif ($user->roleModel->name === 'presidium') {
                $selectedPeriodeIds = $user->periodePresidium->pluck('id')->toArray();
            }
        }
        
        return view('presidium.user.edit', compact('user', 'roles', 'periodeList', 'periodeAktif', 'selectedPeriodeIds'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'jabatan' => 'nullable|string|max:255',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nomor_wa' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'npm' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'hobi' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        // Handle password update
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle foto profile upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            $validated['foto_profile'] = $request->file('foto_profile')->store('profiles', 'public');
        }

        $validated['status_aktif'] = $request->has('status_aktif');

        $user->update($validated);

        // Handle periode untuk kader, kabid, dan presidium
        if ($user->roleModel && in_array($user->roleModel->name, ['kader', 'kabid', 'presidium'])) {
            $periodeIds = $request->input('periode_ids', []);
            
            // Jika tidak ada periode yang dipilih, default ke periode aktif (hanya untuk kader dan kabid)
            if (empty($periodeIds) && in_array($user->roleModel->name, ['kader', 'kabid'])) {
                $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
                if ($periodeAktif) {
                    $periodeIds = [$periodeAktif->id];
                }
            }
            
            // Sync periode berdasarkan role
            if ($user->roleModel->name === 'kader') {
                $user->periodeKader()->sync($periodeIds);
            } elseif ($user->roleModel->name === 'kabid') {
                $user->periodeKabid()->sync($periodeIds);
            } elseif ($user->roleModel->name === 'presidium') {
                $user->periodePresidium()->sync($periodeIds);
            }
        }

        return redirect()->route('presidium.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        // Jangan izinkan hapus user yang sedang login
        if ($user->id === auth()->id()) {
            return redirect()->route('presidium.user.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Hapus foto profile jika ada
        if ($user->foto_profile) {
            Storage::disk('public')->delete($user->foto_profile);
        }

        $user->delete();

        return redirect()->route('presidium.user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Export data user ke CSV
     */
    public function export()
    {
        $users = User::with('roleModel')->orderBy('name')->get();
        
        $filename = 'users_export_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Nama',
                'Email',
                'Role',
                'NPM',
                'Jurusan',
                'Jenis Kelamin',
                'Nomor WA',
                'Hobi',
                'Alamat',
                'Status Aktif'
            ]);
            
            // Data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->email,
                    $user->roleModel?->name ?? '',
                    $user->npm ?? '',
                    $user->jurusan ?? '',
                    $user->jenis_kelamin ?? '',
                    $user->nomor_wa ?? '',
                    $user->hobi ?? '',
                    $user->alamat ?? '',
                    $user->status_aktif ? 'Aktif' : 'Tidak Aktif'
                ]);
            }
            
            fclose($file);
        };
        
        return Response::stream($callback, 200, $headers);
    }

    /**
     * Download template import
     */
    public function downloadTemplate()
    {
        $filename = 'template_import_user.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $roles = Role::orderBy('name')->get();
        $firstRole = $roles->first() ? $roles->first()->name : 'kader';
        
        $callback = function() use ($firstRole) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Nama',
                'Email',
                'Role',
                'NPM',
                'Jurusan',
                'Jenis Kelamin',
                'Nomor WA',
                'Hobi',
                'Alamat',
                'Status Aktif'
            ]);
            
            // Dummy data yang langsung bisa diimport (3 baris contoh)
            // Menggunakan timestamp untuk memastikan email unik
            $timestamp = time();
            fputcsv($file, [
                'Ahmad Fauzi',
                'ahmad.fauzi.' . $timestamp . '@example.com',
                $firstRole,
                '1234567890',
                'Teknik Informatika',
                'L',
                '081234567890',
                'Membaca, Olahraga',
                'Jl. Contoh No. 123',
                'Ya'
            ]);
            
            fputcsv($file, [
                'Siti Nurhaliza',
                'siti.nurhaliza.' . $timestamp . '@example.com',
                $firstRole,
                '1234567891',
                'Sistem Informasi',
                '081234567891',
                'Menulis, Musik',
                'Jl. Contoh No. 456',
                'Ya'
            ]);
            
            fputcsv($file, [
                'Budi Santoso',
                'budi.santoso.' . $timestamp . '@example.com',
                $firstRole,
                '1234567892',
                'Teknik Komputer',
                '081234567892',
                'Gaming, Coding',
                'Jl. Contoh No. 789',
                'Ya'
            ]);
            
            fclose($file);
        };
        
        return Response::stream($callback, 200, $headers);
    }

    /**
     * Menampilkan form import
     */
    public function showImport()
    {
        return view('presidium.user.import');
    }

    /**
     * Preview import user dari CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);
        
        $file = $request->file('file');
        
        // Pastikan folder temp_imports ada
        $tempDir = storage_path('app/temp_imports');
        if (!is_dir($tempDir)) {
            if (!mkdir($tempDir, 0755, true)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['file' => 'Gagal membuat folder temporary. Silakan hubungi administrator.']);
            }
        }
        
        // Simpan file ke storage temp dulu menggunakan Storage facade
        try {
            $filePath = $file->store('temp_imports');
            session(['import_file_path' => $filePath]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['file' => 'Gagal menyimpan file: ' . $e->getMessage()]);
        }
        
        // Baca file dari storage untuk preview
        $fullPath = Storage::path($filePath);
        
        if (!file_exists($fullPath)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['file' => 'File tidak ditemukan setelah disimpan. Silakan coba lagi.']);
        }
        
        $handle = fopen($fullPath, 'r');
        
        if (!$handle) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['file' => 'Gagal membuka file untuk dibaca. Silakan coba lagi.']);
        }
        
        // Skip BOM if exists
        $firstLine = fgets($handle);
        if (substr($firstLine, 0, 3) === "\xEF\xBB\xBF") {
            rewind($handle);
            fseek($handle, 3);
        } else {
            rewind($handle);
        }
        
        // Skip header
        $header = fgetcsv($handle);
        
        $previewData = [];
        $rowNumber = 1;
        
        while (($row = fgetcsv($handle)) !== false && count($previewData) < 100) { // Limit preview to 100 rows
            // Skip baris kosong
            if (empty($row) || (count($row) == 1 && empty(trim($row[0])))) {
                continue;
            }
            
            // Skip baris instruksi (jika masih ada)
            $firstCell = trim($row[0] ?? '');
            if (str_starts_with($firstCell, 'Contoh:') || 
                str_starts_with($firstCell, '*') || 
                str_starts_with($firstCell, 'Catatan:') ||
                str_starts_with($firstCell, '-')) {
                continue;
            }
            
            // Minimal harus ada 3 kolom (Nama, Email, Role)
            if (count($row) < 3) {
                continue;
            }
            
            $rowNumber++;
            $name = trim($row[0] ?? '');
            $email = trim($row[1] ?? '');
            $roleName = trim($row[2] ?? '');
            $npm = trim($row[3] ?? '');
            $jurusan = trim($row[4] ?? '');
            $jenisKelamin = isset($row[5]) ? strtoupper(trim($row[5])) : null;
            $nomorWa = trim($row[6] ?? '');
            $hobi = trim($row[7] ?? '');
            $alamat = trim($row[8] ?? '');
            $statusAktif = isset($row[9]) ? strtolower(trim($row[9])) : 'ya';
            
            // Validasi dan cek
            $errors = [];
            $warnings = [];
            
            if (empty($name) || empty($email) || empty($roleName)) {
                $errors[] = 'Nama, Email, dan Role wajib diisi';
            }
            
            if (!empty($email)) {
                if (User::where('email', $email)->exists()) {
                    $errors[] = 'Email sudah terdaftar';
                }
            }
            
            if (!empty($roleName)) {
                $role = Role::where('name', $roleName)->first();
                if (!$role) {
                    $errors[] = "Role '$roleName' tidak ditemukan";
                }
            }
            
            if (empty($npm)) {
                $warnings[] = 'NPM kosong, password akan dibuat random';
            }
            
            $previewData[] = [
                'row_number' => $rowNumber,
                'name' => $name,
                'email' => $email,
                'role' => $roleName,
                'npm' => $npm,
                'jurusan' => $jurusan,
                'jenis_kelamin' => $jenisKelamin,
                'nomor_wa' => $nomorWa,
                'hobi' => $hobi,
                'alamat' => $alamat,
                'status_aktif' => $statusAktif,
                'errors' => $errors,
                'warnings' => $warnings,
                'is_valid' => empty($errors),
            ];
        }
        
        fclose($handle);
        
        $roles = Role::orderBy('name')->get();
        
        return view('presidium.user.import-preview', compact('previewData', 'roles'));
    }

    /**
     * Proses import user dari CSV (setelah preview)
     */
    public function processImport(Request $request)
    {
        $filePath = session('import_file_path');
        
        if (!$filePath) {
            return redirect()->route('presidium.user.import')
                ->with('error', 'File import tidak ditemukan. Silakan upload ulang.');
        }
        
        $fullPath = Storage::path($filePath);
        
        if (!file_exists($fullPath)) {
            return redirect()->route('presidium.user.import')
                ->with('error', 'File import tidak ditemukan. Silakan upload ulang.');
        }
        
        $handle = fopen($fullPath, 'r');
        
        if (!$handle) {
            return redirect()->route('presidium.user.import')
                ->with('error', 'Gagal membuka file import. Silakan upload ulang.');
        }
        
        // Skip BOM if exists
        $firstLine = fgets($handle);
        if (substr($firstLine, 0, 3) === "\xEF\xBB\xBF") {
            rewind($handle);
            fseek($handle, 3);
        } else {
            rewind($handle);
        }
        
        // Skip header
        $header = fgetcsv($handle);
        
        $imported = 0;
        $failed = 0;
        $errors = [];
        
        while (($row = fgetcsv($handle)) !== false) {
            // Skip baris kosong
            if (empty($row) || (count($row) == 1 && empty(trim($row[0])))) {
                continue;
            }
            
            // Skip baris instruksi (jika masih ada)
            $firstCell = trim($row[0] ?? '');
            if (str_starts_with($firstCell, 'Contoh:') || 
                str_starts_with($firstCell, '*') || 
                str_starts_with($firstCell, 'Catatan:') ||
                str_starts_with($firstCell, '-')) {
                continue;
            }
            
            // Minimal harus ada 3 kolom (Nama, Email, Role)
            if (count($row) < 3) {
                $failed++;
                continue;
            }
            
            $name = trim($row[0] ?? '');
            $email = trim($row[1] ?? '');
            $roleName = trim($row[2] ?? '');
            $npm = trim($row[3] ?? '');
            $jurusan = trim($row[4] ?? '');
            $nomorWa = trim($row[5] ?? '');
            $hobi = trim($row[6] ?? '');
            $alamat = trim($row[7] ?? '');
            $statusAktif = isset($row[8]) ? strtolower(trim($row[8])) : 'ya';
            
            // Validasi
            if (empty($name) || empty($email) || empty($roleName)) {
                $errors[] = "Baris dengan email '$email': Nama, Email, dan Role wajib diisi";
                $failed++;
                continue;
            }
            
            // Cek email sudah ada
            if (User::where('email', $email)->exists()) {
                $errors[] = "Baris dengan email '$email': Email sudah terdaftar";
                $failed++;
                continue;
            }
            
            // Cari role
            $role = Role::where('name', $roleName)->first();
            if (!$role) {
                $errors[] = "Baris dengan email '$email': Role '$roleName' tidak ditemukan";
                $failed++;
                continue;
            }
            
            // Buat user
            try {
                // Validasi jenis kelamin
                $jenisKelaminValue = null;
                if ($jenisKelamin && in_array($jenisKelamin, ['L', 'P', 'LAKI-LAKI', 'PEREMPUAN'])) {
                    $jenisKelaminValue = in_array($jenisKelamin, ['L', 'LAKI-LAKI']) ? 'L' : 'P';
                }
                
                $userData = [
                    'name' => $name,
                    'email' => $email,
                    'role_id' => $role->id,
                    'npm' => $npm ?: null,
                    'jurusan' => $jurusan ?: null,
                    'jenis_kelamin' => $jenisKelaminValue,
                    'nomor_wa' => $nomorWa ?: null,
                    'hobi' => $hobi ?: null,
                    'alamat' => $alamat ?: null,
                    'status_aktif' => in_array($statusAktif, ['ya', 'y', '1', 'aktif', 'true']) ? true : false,
                ];
                
                // Set password (default ke NPM jika ada, atau random)
                if ($npm) {
                    $userData['password'] = Hash::make($npm);
                } else {
                    $userData['password'] = Hash::make(Str::random(8));
                }
                
                $user = User::create($userData);
                
                // Jika user adalah kader atau kabid, otomatis assign ke periode aktif
                if (in_array($role->name, ['kader', 'kabid'])) {
                    $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
                    if ($periodeAktif) {
                        if ($role->name === 'kader') {
                            $user->periodeKader()->attach($periodeAktif->id);
                        } elseif ($role->name === 'kabid') {
                            $user->periodeKabid()->attach($periodeAktif->id);
                        }
                    }
                }
                
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Baris dengan email '$email': " . $e->getMessage();
                $failed++;
            }
        }
        
        fclose($handle);
        
        // Hapus file temp
        Storage::delete($filePath);
        session()->forget('import_file_path');
        
        $message = "Import selesai. Berhasil: $imported, Gagal: $failed";
        if (!empty($errors)) {
            $message .= "\n\nError:\n" . implode("\n", array_slice($errors, 0, 10));
            if (count($errors) > 10) {
                $message .= "\n... dan " . (count($errors) - 10) . " error lainnya";
            }
        }
        
        return redirect()->route('presidium.user.index')
            ->with($imported > 0 ? 'success' : 'error', $message);
    }
}

