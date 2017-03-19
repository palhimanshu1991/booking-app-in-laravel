<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * @var string
     */
    protected $table = 'studio_reservations';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param $query
     * @param bool $confirmed
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        $value = $confirmed ? 1 : 0;

        return $query->where('confirmed', $value);
    }

    /**
     * @param $query
     * @param $from
     * @param null $to
     * @return mixed
     */
    public function scopeBetween($query, $from, $to = null)
    {
        return $query->where('from', '>=', $from)->where('to', '<=', $to);
    }

    public function from()
    {
        return Carbon::parse($this->from);
    }
}
