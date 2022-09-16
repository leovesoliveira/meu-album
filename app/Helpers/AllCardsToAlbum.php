<?php

namespace App\Helpers;

use App\Enums\CardTypes;
use App\Enums\FwcVariants;
use App\Enums\Teams;

class AllCardsToAlbum
{
    private const INITIAL_CARD = 1;
    private const FWC_MUSEUM_INITAL_CARD = 19;
    private const FWC_CARDS_TOTAL = 29;
    private const TEAMS_CARDS_TOTAL = 20;
    private const COKE_CARDS_TOTAL = 8;

    private static $cards = [];

    private function __construct()
    {
        //
    }

    public static function createArray()
    {
        static::createZeroCard();
        static::createFirstFwcCards();
        static::createAllTeamCards();
        static::createMuseumFwcCards();
        static::createAllCokeCards();

        return static::$cards;
    }

    private static function createCard(string $code, CardTypes $type, Teams|FwcVariants|null $subType = null)
    {
        return [
            'code' => $code,
            'type' => $type->value,
            'sub_type' => $subType?->value,
        ];
    }

    private static function createZeroCard()
    {
        array_push(static::$cards, static::createCard(
            code: '00',
            type: CardTypes::Zero,
            subType: FwcVariants::Zero
        ));
    }

    private static function createFwcCard(string $code, FwcVariants $subType)
    {
        return static::createCard(
            code: FwcVariants::INITIALS . " {$code}",
            type: CardTypes::Fwc,
            subType: $subType,
        );
    }

    private static function createFirstFwcCards()
    {
        for ($number=self::INITIAL_CARD; $number < self::FWC_MUSEUM_INITAL_CARD; $number++) {
            $subType = match($number) {
                1 => FwcVariants::Institutional,
                2, 3 => FwcVariants::Cup,
                4, 5 => FwcVariants::Mascot,
                6, 7 => FwcVariants::Logo,
                8, 9, 10, 11, 12, 13, 14, 15, 16, 17 => FwcVariants::Stadium,
                18 => FwcVariants::Ball,
            };

            array_push(static::$cards, static::createFwcCard(
                code: $number,
                subType: $subType,
            ));
        }
    }

    private static function createMuseumFwcCards()
    {
        for ($number=self::FWC_MUSEUM_INITAL_CARD; $number <= self::FWC_CARDS_TOTAL; $number++) {
            array_push(static::$cards, static::createFwcCard(
                code: $number,
                subType: FwcVariants::Museum,
            ));
        }
    }

    private static function createTeamCard(string $code, Teams $team)
    {
        return static::createCard(
            code: "{$team->initials()} {$code}",
            type: CardTypes::Team,
            subType: $team,
        );
    }

    private static function createTeamCardsFrom(Teams $team)
    {
        for ($number=self::INITIAL_CARD; $number <= self::TEAMS_CARDS_TOTAL; $number++) {
            array_push(static::$cards, static::createTeamCard(
                code: $number,
                team: $team,
            ));
        }
    }

    private static function createAllTeamCards()
    {
        foreach (Teams::cases() as $team) {
            static::createTeamCardsFrom($team);
        }
    }

    private static function createAllCokeCards()
    {
        for ($number=self::INITIAL_CARD; $number <= self::COKE_CARDS_TOTAL; $number++) {
            array_push(static::$cards, static::createCard(
                code: "C{$number}",
                type: CardTypes::Coke,
                subType: FwcVariants::Coke
            ));
        }
    }
}
