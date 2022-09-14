<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function add(Card $card, Request $request)
    {
        if (Auth::user()->cannot('update', $card)) {
            abort(403);
        }

        $card->quantity = $card->quantity + 1;

        $card->update();
    }

    public function subtract(Card $card, Request $request)
    {
        if (Auth::user()->cannot('update', $card)) {
            abort(403);
        }

        if($card->quantity > 0) {
            $card->quantity = $card->quantity - 1;

            $card->update();
        }
    }
}
