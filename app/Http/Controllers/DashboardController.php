<?php

namespace App\Http\Controllers;

use App\Models\Post; // Tambahkan import model Post
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Proteksi semua metode dalam controller ini dengan middleware 'auth'
        $this->middleware('auth');
    }

    public function dashboard()
{
    $totalPosts = Post::count();
    $publishedPosts = Post::where('is_published', true)->count();
    $draftPosts = Post::where('is_published', false)->count();
    $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();

    // Debugging
    // dd($totalPosts, $publishedPosts, $draftPosts, $latestPosts); // Ini akan menghentikan eksekusi dan menampilkan data

    return view('dashboard', compact('totalPosts', 'publishedPosts', 'draftPosts', 'latestPosts'));
}

}
