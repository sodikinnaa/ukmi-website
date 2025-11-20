<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\VideoTutorial;
use Illuminate\Http\Request;

class VideoTutorialController extends Controller
{
    /**
     * Menampilkan daftar video tutorial public (hanya yang aktif)
     */
    public function index(Request $request)
    {
        $query = VideoTutorial::where('is_aktif', true)
            ->with('creator')
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan modul
        if ($request->filled('modul')) {
            $query->where('modul', $request->modul);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhere('modul', 'like', "%{$search}%");
            });
        }

        $videoTutorials = $query->paginate(12)->withQueryString();

        // Get unique modules for filter
        $modules = VideoTutorial::where('is_aktif', true)
            ->whereNotNull('modul')
            ->distinct()
            ->pluck('modul')
            ->sort()
            ->values();

        return view('public.video-tutorial.index', compact('videoTutorials', 'modules'));
    }

    /**
     * Menampilkan detail video tutorial public
     */
    public function show(VideoTutorial $videoTutorial)
    {
        // Pastikan video tutorial aktif
        if (!$videoTutorial->is_aktif) {
            abort(404, 'Video tutorial tidak ditemukan.');
        }

        $videoTutorial->load('creator');

        // Get related videos (same module)
        $relatedVideos = VideoTutorial::where('is_aktif', true)
            ->where('id', '!=', $videoTutorial->id)
            ->where(function($q) use ($videoTutorial) {
                if ($videoTutorial->modul) {
                    $q->where('modul', $videoTutorial->modul);
                } else {
                    $q->whereNull('modul');
                }
            })
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('public.video-tutorial.show', compact('videoTutorial', 'relatedVideos'));
    }
}

