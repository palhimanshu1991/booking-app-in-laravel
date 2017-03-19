<div class="row">
    <div class="btn-group col-md-12">
        @foreach($studio->days() as $day)
            <button type="button" class="btn btn-default select-day" data-date="{{ $day->format('Y-m-d') }}">
                <h5>{{ $day->format('D') }}</h5>
                <h5>{{ $day->format('d') }}</h5>
                <h5>{{ $day->format('M') }}</h5>
            </button>
        @endforeach
    </div>
</div>
<br/>
<div class="row bookings-available-for-the-day">
    <div class="col-xs-12">
        @foreach($studio->slots() as $slot)
            <div class=" col-xs-4">
                <button type="button" class="btn btn-primary" style="margin-bottom: 10px">11AM-12AM</button>
            </div>
        @endforeach
    </div>
</div>
