<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard berdasarkan role user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Load role relationship jika belum di-load
        if (!$user->relationLoaded('roleModel')) {
            $user->load('roleModel');
        }
        
        // Redirect ke dashboard sesuai role
        if ($user->isPresidium()) {
            return redirect()->route('presidium.dashboard');
        } elseif ($user->isKabid()) {
            return redirect()->route('kabid.dashboard');
        } elseif ($user->isKader()) {
            return redirect()->route('kader.dashboard');
        } elseif ($user->isPembina()) {
            return redirect()->route('pembina.dashboard');
        }
        
        return view('dashboard.index', [
            'user' => $user,
        ]);
    }
}
