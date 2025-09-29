<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function uploadEditorImage(\Illuminate\Http\Request $request)
    {
        // CKEditor (CKFinderUploadAdapter) mengirim file pada field "upload"
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120', // 5MB
        ]);

        $file = $request->file('upload');
        
        $filename = time() . '_' . $file->getClientOriginalName();
        
        $destinationPath = 'images/news/content';

        $file->move(public_path($destinationPath), $filename);

        $url = asset($destinationPath . '/' . $filename);

        return response()->json([
            'uploaded'  => 1,
            'fileName'  => $filename,
            'url'       => $url,
        ]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->eloquent(
                    \App\Models\Post::query()->select([
                        'id',
                        'thumbnail',
                        'title',
                        'slug',
                        'excerpt',
                        'author',
                        'published_at',
                        'created_at',
                    ])
                    ->orderBy('published_at', 'desc')
                )
                // (opsional) format tanggal agar rapi
                ->editColumn('published_at', function ($post) {
                    return $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null;
                })
                ->editColumn('created_at', function ($post) {
                    return $post->created_at ? $post->created_at->format('Y-m-d H:i:s') : null;
                })
                // tombol aksi
                ->addColumn('action', function ($post) {
                    return view('admin.news.partials.actions', compact('post'))->render();
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('thumbnail');
        $data['slug'] = Str::slug($data['title']);
        $data['author'] = 'Admin';
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // --- AWAL PERUBAHAN ---
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = 'images/news';
            
            // Pindahkan file ke public/images/news
            $file->move(public_path($destinationPath), $filename);
            
            // Simpan path relatif ke database
            $data['thumbnail'] = $destinationPath . '/' . $filename;
        }

        Post::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }

    public function show($id)
    {
        $news = Post::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    public function edit($id)
    {
        $news = Post::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('thumbnail');
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('thumbnail')) {
            // 1. Hapus thumbnail lama jika ada
            if ($news->thumbnail && File::exists(public_path($news->thumbnail))) {
                File::delete(public_path($news->thumbnail));
            }
            
            // 2. Unggah thumbnail baru
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = 'images/news';
            
            $file->move(public_path($destinationPath), $filename);
            
            $data['thumbnail'] = $destinationPath . '/' . $filename;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = Post::findOrFail($id);
         if ($news->thumbnail && File::exists(public_path($news->thumbnail))) {
            File::delete(public_path($news->thumbnail));
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}