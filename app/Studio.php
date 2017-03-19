<?php

namespace App;

use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    //


    public function slots($date = null)
    {
        $date = $date ?: date('Y-m-d', time());

        $reservationsOnThatDate = $this->reservationsOn($date);

        $slots = [];

        $openingHour   = explode(':', $this->settings->on_weekdays_opens_at)[0];
        $openingMinute = explode(':', $this->settings->on_weekdays_opens_at)[1];
        $openingTime   = Carbon::parse($date)->setTime($openingHour, $openingMinute);

        $closingHour   = explode(':', $this->settings->on_weekdays_closes_at)[0];
        $closingMinute = explode(':', $this->settings->on_weekdays_closes_at)[1];
        $closingTime   = Carbon::parse($date)->setTime($closingHour, $closingMinute);


        for ($i = 0; $i < $openingTime->diffInHours($closingTime); $i++) {

            $slot         = new Slot($this, $date);
            $slot->from   = Carbon::parse($date)->setTime($openingHour, $openingMinute)->addHours($i)->toDateTimeString();
            $slot->to     = Carbon::parse($date)->setTime($openingHour, $openingMinute)->addHours($i + 1)->toDateTimeString();
            $slot->booked = $slot->isBooked();

            $slots[] = $slot;

        }

        return $slots;
    }

    public function reservationsOn($date, $to = null)
    {
        $to = Carbon::parse($date)->addDay(1)->format('Y-m-d');

        return $this->reservations()->whereBetween('from', [$date, $to])->get();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get reservations for this studio which need approval
     *
     * @return mixed
     */
    public function bookings()
    {
        return $this->reservations()->confirmed(false)->get();
    }

    public function days()
    {
        $nextSevenDays = [];

        for ($i = 0; $i < 7; $i++) {

            $nextSevenDays[] = Carbon::now()->addDays($i);

        }

        return $nextSevenDays;
    }

    public function settings()
    {
        return $this->hasOne(StudioSetting::class);
    }


}
