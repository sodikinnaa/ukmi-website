<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\KategoriBiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaderController extends Controller
{
    /**
     * Menampilkan daftar kader dari kategori biro yang dikelola kabid
     */
    public function index(Request $request)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Get kategori biro kabid untuk filter
        $kategoriBiroList = $kabid->kategoriBiroKabid;
        
        // Jika kabid belum memiliki kategori biro, tampilkan pesan
        if (empty($kabidKategoriBiroIds)) {
            $kader = \App\Models\User::whereRaw('1 = 0')
                ->with(['kategoriBiro', 'roleModel', 'periodeKader'])
                ->orderBy('name')
                ->paginate(15)
                ->withQueryString();
        } else {
            // Build query untuk kader
            $query = \App\Models\User::whereHas('kategoriBiro', function($q) use ($kabidKategoriBiroIds, $request) {
                // Filter berdasarkan kategori biro yang dipilih atau semua kategori biro kabid
                if ($request->has('kategori_biro_id') && $request->kategori_biro_id && in_array($request->kategori_biro_id, $kabidKategoriBiroIds)) {
                    $q->where('kategori_biro.id', $request->kategori_biro_id);
                } else {
                    $q->whereIn('kategori_biro.id', $kabidKategoriBiroIds);
                }
            })
            ->whereHas('roleModel', function($q) {
                $q->where('name', 'kader');
            });
            
            // Filter berdasarkan search
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('npm', 'like', "%{$search}%");
                });
            }
            
            // Execute query dengan pagination
            $kader = $query->with(['kategoriBiro', 'roleModel', 'periodeKader'])
                ->orderBy('name')
                ->paginate(15)
                ->withQueryString();
        }
        
        return view('kabid.kader.index', compact('kader', 'kategoriBiroList'));
    }
}

