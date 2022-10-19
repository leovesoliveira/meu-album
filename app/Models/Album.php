<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
    ];

    protected $appends = [
        'total_cards',
        'total_quantity_cards',
        'total_at_least_one_cards',
        'total_quantity_repeated_cards',
        'percent_complete',
        'total_missing_cards'
    ];

    protected function totalCards(): Attribute
    {
        return new Attribute(
            get: fn () => $this->cards->count(),
        );
    }

    protected function totalQuantityCards(): Attribute
    {
        return new Attribute(
            get: fn () => $this->cards->sum('quantity'),
        );
    }

    protected function totalAtLeastOneCards(): Attribute
    {
        $atLeastOneCards = $this->cards->filter(fn ($card) => $card->quantity >= 1);

        return new Attribute(
            get: fn () => $atLeastOneCards->count(),
        );
    }

    protected function totalQuantityRepeatedCards(): Attribute
    {
        $repeatedCards = $this->cards->filter(fn ($card) => $card->quantity >= 2);
        $quantityRepeatedCards = $repeatedCards->sum('quantity') - $repeatedCards->count();

        return new Attribute(
            get: fn () => $quantityRepeatedCards,
        );
    }

    protected function percentComplete(): Attribute
    {
        $atLeastOneCards = $this->cards->filter(fn ($card) => $card->quantity >= 1);
        $percentComplete = 0;

        if ($this->cards->count() > 0) {
            $percentComplete = $atLeastOneCards->count() / $this->cards->count() * 100;
        }

        return new Attribute(
            get: fn () => (int) $percentComplete,
        );
    }

    protected function totalMissingCards(): Attribute
    {
        $atLeastOneCards = $this->cards->filter(fn ($card) => $card->quantity >= 1);
        $missingCards = $this->cards->count() - $atLeastOneCards->count();

        return new Attribute(
            get: fn () => (int) $missingCards,
        );
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
