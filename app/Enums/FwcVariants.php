<?php

namespace App\Enums;

enum FwcVariants: string
{
    const INITIALS = 'FWC';

    case Institutional = 'institutional';
    case Cup = 'cup';
    case Mascot = 'mascot';
    case Logo = 'logo';
    case Stadium = 'stadium';
    case Ball = 'ball';
    case Museum = 'museum';
}
