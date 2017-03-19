@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h1>{{ $studio->name }}</h1>
        </div>


    </div>

    {{--booking form--}}
    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('studios.reservations.store', $studio->id) }}" method="POST">

                {{ csrf_field() }}

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input required type="date" name="date" class="form-control" placeholder="Date"
                           value="{{ date('Y-m-d', time()) }}">
                </div>

                <div class="input-group bootstrap-timepicker timepicker">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    <input required id="timepicker1" name="from" type="text" class="form-control input-small">
                </div>

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Hours</span>
                    <input required type="number" name="hours" aria-valuemin="1" min="1" max="8" class="form-control"
                           placeholder="Hours" aria-describedby="basic-addon1">
                </div>

                <input type="submit">

            </form>

        </div>

    </div>

    <br/>

    @include('studios.partials.select-day-tab')

    {{--confirmed bookings--}}
    <div class="row">

        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Bookings Confirmed</th>
                </tr>
                </thead>

                <tbody>
                @foreach($studio->reservations as $reservation)
                    <tr>
                        <td class="warning">
                            Booked From {{ $reservation->from }} - {{ $reservation->to }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    {{--slots--}}
    <div class="row">

        <div class="col-md-12">

            <table class="table table-bordered">
                <thead>

                </thead>

                <tbody>
                @foreach($studio->slots() as $slot)
                    <tr>
                        <td class="{{ $slot->isBooked() ? 'warning' : null }}">
                            {{ $slot->from }} - {{ $slot->isBooked() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>




@endsection