<?php

namespace App\Http\Controllers;

use App\Helpers\AllCardsToAlbum;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'albums' => Auth::user()->albums()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('CreateAlbum');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|size:12|alpha_num',
            'description' => 'required|max:255|string',
        ]);
        $validated['code'] = strtoupper($validated['code']);

        DB::transaction(function () use($validated) {
            $album = Album::create($validated);

            $album->users()->attach(Auth::user());
            $album->cards()->createMany(AllCardsToAlbum::createArray());
        });

        return Redirect::route('dashboard');
    }

    public function show(Album $album)
    {
        if (Auth::user()->cannot('view', $album)) {
            abort(403);
        }

        return Inertia::render('ShowAlbum', [
            'album' => $album->toArray(),
            'cards' => $album->cards->toQuery()->orderBy('id', 'asc')->get(),
        ]);
    }
}
