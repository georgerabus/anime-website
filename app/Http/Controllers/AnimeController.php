<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();
        return view('home', compact('animes'));
    }

    public function animePage($id, $episode_id = null) {
        $anime = Anime::with('episodes')->findOrFail($id);
    
        $currentEpisode = $episode_id ? $anime->episodes->find($episode_id) : $anime->episodes->first();
    
        $comments = Comment::with(['user', 'replies.user'])
                    ->withCount('replies')
                    ->where('episode_id', $currentEpisode->id)
                    ->whereNull('parent_id')
                    ->latest()
                    ->get();
    
        $totalCommentsCount = $comments->reduce(function ($count, $comment) {
            return $count + 1 + $comment->getTotalRepliesCount();
        }, 0);
    
        return view('pages.anime-page', compact('comments', 'totalCommentsCount', 'anime', 'currentEpisode'));
    }
    
    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        return view('pages.edit-anime', compact('anime'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $anime = Anime::findOrFail($id);
        $anime->title = $request->input('title');
        $anime->description = $request->input('description');
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imagePath = $image->store('anime-photos', 'public');
            $anime->photo = $imagePath; 
        } elseif ($request->input('delete_photo')) {
            $anime->photo = '/placeholder.svg'; 
        }
    
        $anime->save();
    
        return redirect()->route('adminList')->with('success', 'Anime updated successfully.');
    }
    

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();

        return redirect()->route('adminList')->with('success', 'Anime deleted successfully.');
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
}
