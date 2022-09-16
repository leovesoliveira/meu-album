<?php

namespace App\Http\Controllers;

use App\Helpers\AllCardsToAlbum;
use App\Models\Album;
use App\Models\User;
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
            'cards' => $album->cards->toQuery()->orderBy('id', 'asc')->get()->groupBy('sub_type'),
        ]);
    }

    public function edit(Album $album)
    {
        if (Auth::user()->cannot('view', $album)) {
            abort(403);
        }

        return Inertia::render('EditAlbum', [
            'album' => $album->toArray(),
            'users' => $album->users->toArray(),
        ]);
    }

    public function addUser(Album $album, Request $request)
    {
        if (Auth::user()->cannot('update', $album)) {
            abort(403);
        }

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', '=', $validated['email'])->first();

        if (!$album->users->contains($user)) {
           $album->users()->attach($user);
        }
    }

    public function removeUser(Album $album, User $user)
    {
        if (Auth::user()->cannot('update', $album)) {
            abort(403);
        }

        if ($album->users->count() > 1) {
            $album->users()->detach($user);
        }

        if (Auth::user()->id === $user->id) {
            return Redirect::route('dashboard');
        }
    }

    public function editCards(Album $album)
    {
        return Inertia::render('EditCardsAlbum', ['album' => $album->toArray()]);
    }

    public function editCardsConfirmation(Album $album, Request $request)
    {
        if (Auth::user()->cannot('view', $album)) {
            abort(403);
        }

        $validated = $request->validate([
            'cards' => 'required|string',
        ]);
        $stringfiedCards = strtoupper($validated['cards']);

        $cards = [];

        $explode = explode('|', $stringfiedCards);

        foreach ($explode as $item) {
            if ($item === '00') {
                array_push($cards, $item);
                continue;
            }

            $cardName = explode(':', $item);

            if(isset($cardName[1])) {
                $cardNumbers = explode(',', $cardName[1]);

                foreach ($cardNumbers as $number) {
                    if ($cardName[0] === 'C') {
                        array_push($cards, "{$cardName[0]}{$number}");
                        continue;
                    }

                    array_push($cards, "{$cardName[0]} {$number}");
                }
            }
        }

        $cards = $album->cards()->whereIn('code', $cards)->orderBy('id', 'asc')->get()->groupBy('sub_type');

        return Inertia::render('EditCardsConfirmationAlbum', ['album' => $album, 'cards' => $cards]);
    }

    public function addCardsQuantity(Album $album, Request $request)
    {
        if (Auth::user()->cannot('update', $album)) {
            abort(403);
        }

        $validated = $request->validate([
            'cards' => 'required|array',
            'cards.*' => 'required|exists:cards,id',
        ]);

        $cards = $album->cards()->whereIn('id', $validated['cards'])->get();

        DB::transaction(function () use($cards) {
            $cards->each(function ($card) {
                $card->quantity = $card->quantity + 1;
                $card->save();
            });
        });

        return Redirect::route('album.show', $album);
    }

    public function subtractCardsQuantity(Album $album, Request $request)
    {
        if (Auth::user()->cannot('update', $album)) {
            abort(403);
        }

        $validated = $request->validate([
            'cards' => 'required|array',
            'cards.*' => 'required|exists:cards,id',
        ]);

        $cards = $album->cards()->whereIn('id', $validated['cards'])->get();

        DB::transaction(function () use($cards) {
            $cards->each(function ($card) {
                if($card->quantity <= 0) {
                    return;
                }

                $card->quantity = $card->quantity - 1;
                $card->save();
            });
        });

        return Redirect::route('album.show', $album);
    }

    public function missingCards(Album $album)
    {
        return Inertia::render('MissingCardsAlbum', [
            'album' => $album->toArray(),
            'cards' => $album->cards->toQuery()->where('quantity', '=', '0')->orderBy('id', 'asc')->get()->groupBy('sub_type'),
        ]);
    }
}
