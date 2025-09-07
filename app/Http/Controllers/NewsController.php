<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

class NewsController extends Controller
{
    public function uploadEditorImage(\Illuminate\Http\Request $request)
    {
        // CKEditor (CKFinderUploadAdapter) mengirim file pada field "upload"
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120', // 5MB
        ]);

        $path = $request->file('upload')->store('images/news/content', 'public');
        $url  = asset('storage/'.$path);

        // Format respons CKFinder/CKEditor 5
        return response()->json([
            'uploaded'  => 1,
            'fileName'  => basename($path),
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

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('images/news', 'public');
        }

        $data['author'] = 'Admin';

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

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('images/news', 'public');
        } else {
            unset($data['thumbnail']);
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = Post::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}