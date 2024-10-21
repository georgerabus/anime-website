<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class AdminController
{
    function index(){
        return view('pages.admin-page');
    }

    function addNew(){
        $animes = Anime::all();
        return view('pages.admin-add-new', compact('animes'));
    }
    
    function list(){
        $animes = Anime::all();
        return view('pages.admin-view-list', compact('animes'));
    }
    public function listEpisodes($id) 
    {
        $anime = Anime::with(['episodes' => function($query) {
            $query->orderBy('episode_id', 'asc'); 
        }])->findOrFail($id);
    
        return view('pages.admin-view-list-episodes', compact('anime'));
    }
    

    function editUser(){
        $users = User::all();
        return view('pages.admin-edit-users', compact('users'));
    }

public function storeAnime(Request $request)
{
    $anime = new Anime();
    $anime->title = $request->title;
    $anime->description = $request->description;

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $path = $image->store('anime-photos', 'public'); 
        $anime->photo = $path;
    }
    $anime->save();
    return redirect()->back()->with('success', 'Added anime successfully');

}

public function storeEpisode(Request $request)
{
    $episode = new Episode();
    $episode->anime_id=$request->anime_id;
    $episode->episode_id = $request->episode_id;
    $episode->episode = $request->episode;
    if($request->episode_title){
    $episode->episode_title = $request->episode_title;
    }
    $episode->save();
    return redirect()->back()->with('success', 'Added episode successfully');
}

}
