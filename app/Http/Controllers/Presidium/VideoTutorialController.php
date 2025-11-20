<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\VideoTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoTutorialController extends Controller
{
    /**
     * Menampilkan daftar video tutorial
     */
    public function index(Request $request)
    {
        $query = VideoTutorial::with('creator')
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan modul
        if ($request->filled('modul')) {
            $query->where('modul', $request->modul);
        }

        // Filter berdasarkan status aktif
        if ($request->filled('is_aktif')) {
            $query->where('is_aktif', $request->is_aktif);
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

        $videoTutorials = $query->paginate(15)->withQueryString();

        // Get unique modules for filter
        $modules = VideoTutorial::whereNotNull('modul')
            ->distinct()
            ->pluck('modul')
            ->sort()
            ->values();

        return view('presidium.video-tutorial.index', compact('videoTutorials', 'modules'));
    }

    /**
     * Menampilkan form tambah video tutorial
     */
    public function create()
    {
        return view('presidium.video-tutorial.create');
    }

    /**
     * Menyimpan video tutorial baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'modul' => 'nullable|string|max:255',
            'keterangan_modul' => 'nullable|string',
            'video' => 'required_without:video_url|nullable|file|mimes:mp4,avi,mov,wmv,flv,webm|max:204800', // Max 200MB
            'video_url' => 'nullable|url|required_without:video',
            'durasi' => 'nullable|integer|min:0',
            'urutan' => 'nullable|integer|min:0',
            'is_aktif' => 'boolean',
        ]);

        $videoPath = null;
        $videoUrl = null;

        // Handle video upload atau URL
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoPath = $video->store('video-tutorials', 'public');
        } elseif ($request->filled('video_url')) {
            $videoUrl = $validated['video_url'];
        }

        $videoTutorial = VideoTutorial::create([
            'judul' => $validated['judul'],
            'keterangan' => $validated['keterangan'] ?? null,
            'modul' => $validated['modul'] ?? null,
            'keterangan_modul' => $validated['keterangan_modul'] ?? null,
            'video_path' => $videoPath ?? null,
            'video_url' => $videoUrl ?? null,
            'durasi' => $validated['durasi'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
            'is_aktif' => $request->has('is_aktif'),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('presidium.video-tutorial.index')
            ->with('success', 'Video tutorial berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail video tutorial
     */
    public function show(VideoTutorial $videoTutorial)
    {
        $videoTutorial->load('creator');
        return view('presidium.video-tutorial.show', compact('videoTutorial'));
    }

    /**
     * Menampilkan form edit video tutorial
     */
    public function edit(VideoTutorial $videoTutorial)
    {
        return view('presidium.video-tutorial.edit', compact('videoTutorial'));
    }

    /**
     * Update video tutorial
     */
    public function update(Request $request, VideoTutorial $videoTutorial)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'modul' => 'nullable|string|max:255',
            'keterangan_modul' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,webm|max:204800', // Max 200MB
            'video_url' => 'nullable|url',
            'durasi' => 'nullable|integer|min:0',
            'urutan' => 'nullable|integer|min:0',
            'is_aktif' => 'boolean',
        ]);

        // Handle video upload atau URL jika ada perubahan
        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($videoTutorial->video_path && Storage::disk('public')->exists($videoTutorial->video_path)) {
                Storage::disk('public')->delete($videoTutorial->video_path);
            }

            $video = $request->file('video');
            $videoPath = $video->store('video-tutorials', 'public');
            $validated['video_path'] = $videoPath;
            $validated['video_url'] = null; // Reset video_url jika upload file baru
        } elseif ($request->filled('video_url')) {
            // Jika menggunakan video_url, hapus video_path
            if ($videoTutorial->video_path && Storage::disk('public')->exists($videoTutorial->video_path)) {
                Storage::disk('public')->delete($videoTutorial->video_path);
            }
            $validated['video_path'] = null;
            $validated['video_url'] = $request->video_url;
        } else {
            // Jika tidak ada perubahan, pertahankan nilai lama
            unset($validated['video_path']);
            unset($validated['video_url']);
        }

        $validated['is_aktif'] = $request->has('is_aktif');

        $videoTutorial->update($validated);

        return redirect()->route('presidium.video-tutorial.index')
            ->with('success', 'Video tutorial berhasil diperbarui.');
    }

    /**
     * Hapus video tutorial
     */
    public function destroy(VideoTutorial $videoTutorial)
    {
        // Hapus file video jika ada
        if ($videoTutorial->video_path && Storage::disk('public')->exists($videoTutorial->video_path)) {
            Storage::disk('public')->delete($videoTutorial->video_path);
        }

        $videoTutorial->delete();

        return redirect()->route('presidium.video-tutorial.index')
            ->with('success', 'Video tutorial berhasil dihapus.');
    }
}

