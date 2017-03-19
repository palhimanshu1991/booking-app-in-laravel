<?php

/**
 * Created by PhpStorm.
 * User: HimanshuPal
 * Date: 04/11/16
 * Time: 9:24 PM
 */

namespace App\Models;


use App\Studio;

class Slot
{

    /**
     * @var
     */
    public $from;

    /**
     * @var
     */
    public $to;

    /**
     * @var Studio
     */
    private $studio;

    /**
     * @var
     */
    private $date;

    public function __construct(Studio $studio, $date)
    {
        $this->studio = $studio;
        $this->date   = $date;
    }

    public function isBooked()
    {
        $isBooked = $this->studio->reservations()->between($this->from, $this->to)->count();

        return $isBooked ? 'booked' : null;
    }

}