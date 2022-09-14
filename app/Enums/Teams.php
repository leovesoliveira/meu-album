<?php

namespace App\Enums;

enum Teams: string
{
    case Qatar = 'qatar';
    case Ecuador = 'ecuador';
    case Senegal = 'senegal';
    case Netherlands = 'netherlands';
    case England = 'england';
    case IrIran = 'ir-iran';
    case Usa = 'usa';
    case Wales = 'wales';
    case Argentina = 'argentina';
    case SaudiArabia = 'saudi-arabia';
    case Mexico = 'mexico';
    case Poland = 'poland';
    case France = 'france';
    case Australia = 'australia';
    case Denmark = 'denmark';
    case Tunisia = 'tunisia';
    case Spain = 'spain';
    case CostaRica = 'costa-rica';
    case Germany = 'germany';
    case Japan = 'japan';
    case Belgium = 'belgium';
    case Canada = 'canada';
    case Morocco = 'morocco';
    case Croatia = 'croatia';
    case Brazil = 'brazil';
    case Serbia = 'serbia';
    case Switzerland = 'switzerland';
    case Cameroon = 'cameroon';
    case Portugal = 'portugal';
    case Ghana = 'ghana';
    case Uruguay = 'uruguay';
    case KoreaRepublic = 'korea-republic';

    public function text()
    {
        return match($this) {
            self::Qatar => 'Qatar',
            self::Ecuador => 'Ecuador',
            self::Senegal => 'Senegal',
            self::Netherlands => 'Netherlands',
            self::England => 'England',
            self::IrIran => 'Ir Iran',
            self::Usa => 'USA',
            self::Wales => 'Wales',
            self::Argentina => 'Argentina',
            self::SaudiArabia => 'Saudi Arabia',
            self::Mexico => 'Mexico',
            self::Poland => 'Poland',
            self::France => 'France',
            self::Australia => 'Australia',
            self::Denmark => 'Denmark',
            self::Tunisia => 'Tunisia',
            self::Spain => 'Spain',
            self::CostaRica => 'Costa Rica',
            self::Germany => 'Germany',
            self::Japan => 'Japan',
            self::Belgium => 'Belgium',
            self::Canada => 'Canada',
            self::Morocco => 'Morocco',
            self::Croatia => 'Croatia',
            self::Brazil => 'Brazil',
            self::Serbia => 'Serbia',
            self::Switzerland => 'Switzerland',
            self::Cameroon => 'Cameroon',
            self::Portugal => 'Portugal',
            self::Ghana => 'Ghana',
            self::Uruguay => 'Uruguay',
            self::KoreaRepublic => 'Korea Republic',
        };
    }

    public function initials()
    {
        return match($this) {
            self::Qatar => 'QAT',
            self::Ecuador => 'ECU',
            self::Senegal => 'SEN',
            self::Netherlands => 'NED',
            self::England => 'ENG',
            self::IrIran => 'IRN',
            self::Usa => 'USA',
            self::Wales => 'WAL',
            self::Argentina => 'ARG',
            self::SaudiArabia => 'KSA',
            self::Mexico => 'MEX',
            self::Poland => 'POL',
            self::France => 'FRA',
            self::Australia => 'AUS',
            self::Denmark => 'DEN',
            self::Tunisia => 'TUN',
            self::Spain => 'ESP',
            self::CostaRica => 'CRC',
            self::Germany => 'GER',
            self::Japan => 'JPN',
            self::Belgium => 'BEL',
            self::Canada => 'CAN',
            self::Morocco => 'MAR',
            self::Croatia => 'CRO',
            self::Brazil => 'BRA',
            self::Serbia => 'SRB',
            self::Switzerland => 'SUI',
            self::Cameroon => 'CMR',
            self::Portugal => 'POR',
            self::Ghana => 'GHA',
            self::Uruguay => 'URU',
            self::KoreaRepublic => 'KOR',
        };
    }
}
