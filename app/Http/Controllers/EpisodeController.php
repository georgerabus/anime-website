<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EpisodeController
{
    public function editEpisode($anime_id, $episode_id)
    {
        $episode = Episode::where('id', $episode_id)->where('anime_id', $anime_id)->firstOrFail();
        return view('pages.edit-episode', compact('episode'));
    }

    public function updateEpisode(Request $request, $anime_id, $episode_id)
    {
        $episode = Episode::where('id', $episode_id)->where('anime_id', $anime_id)->firstOrFail();
    
        // Update the fields
        $episode->episode = $request->input('episode');
        $episode->episode_id = $request->input('episode_id');
        
        $episode->save();
    
        return redirect()->route('adminListEpisodes', ['id' => $anime_id])->with('success', 'Episode updated successfully.');
    }
    

    public function deleteEpisode($anime_id, $episode_id)
    {
        $episode = Episode::where('id', $episode_id)->where('anime_id', $anime_id)->firstOrFail();
        $episode->delete();

        return redirect()->back()->with('success', 'Episode deleted successfully.');
    }


}
