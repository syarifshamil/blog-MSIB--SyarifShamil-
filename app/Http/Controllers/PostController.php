<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil postingan dengan filter jika ada
        $query = Post::query();

        // Cek apakah ada query pencarian
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Cek apakah ada kategori yang dipilih
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Paginate hasil
        $posts = $query->paginate(5);

        return view('posts.index', compact('posts', 'categories'));
    }


    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
            'category_id' => 'required|exists:categories,id', // Memastikan category_id valid
            'is_published' => 'nullable|boolean', // Validasi untuk fitur publish
        ]);

        try {
            $postData = $request->all();
            $postData['is_published'] = $request->has('is_published'); // Mengatur status publish

            // Handle image upload
            if ($request->hasFile('image')) {
                $postData['image'] = $request->file('image')->store('posts_images', 'public'); // Upload image
            }

            // Create post
            Post::create($postData);
            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('posts.create')->with('error', 'Failed to create post: ' . $e->getMessage());
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('posts.edit', compact('post', 'categories')); // Kirim kategori ke view
    }

    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
            'is_published' => 'nullable|boolean', // Validasi fitur publish
        ]);

        try {
            $postData = $request->all();

            // Handle image upload
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($post->image) {
                    Storage::delete('public/' . $post->image);
                }
                $postData['image'] = $request->file('image')->store('posts_images', 'public'); // Upload image baru
            }

            // Update post data lainnya
            $post->fill($postData);

            // Update status publish secara eksplisit
            $post->is_published = $request->has('is_published'); // Tidak perlu ? true : false

            // Simpan perubahan
            $post->save();

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('posts.edit', $post->id)->with('error', 'Failed to update post. ' . $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        // Hapus gambar terkait
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        // Hapus post
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
