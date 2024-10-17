<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AnimeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function animeList()
    {
        return view('pages.anime-list');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform search logic (e.g., querying the database for anime matches)
        // $results = Anime::where('title', 'LIKE', "%$query%")->get();

        return view('pages.search-results', [
            'query' => $query,
            // 'results' => $results,
        ]);
    }

    public function animePage(){
        $comments = Comment::with(['user', 'replies.user'])->whereNull('parent_id')->latest()->get();
        return view('pages.anime-page', ['comments' => $comments]);
    }
}
