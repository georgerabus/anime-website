<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class AdminController
{
    function show(){
        $animes = Anime::all();
        return view('pages.admin-page', compact('animes'));
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
    $episode->save();
    return redirect()->back()->with('success', 'Added episode successfully');
}

}
