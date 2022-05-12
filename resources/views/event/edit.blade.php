@extends('layouts.app')

@section('content')

    <div class="container mt-5 col-md-4">


        <a href="{{ route('event.index') }}" class="btn btn-primary float-right mb-5">Back</a>
        <div style="clear: both;"></div>
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $item }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach


        <form action="{{ route('event.update',$event->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" value="{{ $event->title }}" name="title" required>
            </div>

            <div class="form-group">
                <label for="">Start Date</label>
                <input type="text" class="form-control datepicker" value="{{ $event->start_date }}" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="">End Date</label>
                <input type="text" class="form-control datepicker" name="end_date" value="{{ $event->end_date }}" required>
            </div>

            <div class="form-group">
                <label for="">Recurrence</label>
                <select name="recurrence_time" required>
                    <option value="1" {{ ($event->recurrence_time == 1) ? 'selected' : '' }}>First</option>
                    <option value="2" {{ ($event->recurrence_time == 2) ? 'selected' : '' }}>Second</option>
                    <option value="3" {{ ($event->recurrence_time == 3) ? 'selected' : '' }}>Third</option>
                    <option value="4" {{ ($event->recurrence_time == 4) ? 'selected' : '' }}>Fourth</option>
                </select>

                <select name="recurrence_day" required>
                    <option value="0" {{ ($event->recurrence_day == 0) ? 'selected' : '' }}>Sun</option>
                    <option value="1" {{ ($event->recurrence_day == 1) ? 'selected' : '' }}>Mon</option>
                    <option value="2" {{ ($event->recurrence_day == 2) ? 'selected' : '' }}>Tue</option>
                    <option value="3" {{ ($event->recurrence_day == 3) ? 'selected' : '' }}>Wed</option>
                    <option value="4" {{ ($event->recurrence_day == 4) ? 'selected' : '' }}>Thu</option>
                    <option value="5" {{ ($event->recurrence_day == 5) ? 'selected' : '' }}>Fri</option>
                    <option value="6" {{ ($event->recurrence_day == 6) ? 'selected' : '' }}>Sat</option>
                </select>

                <select name="recurrence_duration" required>
                    <option value="1" {{ ($event->recurrence_duration == 1) ? 'selected' : '' }}>Month</option>
                    <option value="3" {{ ($event->recurrence_duration == 3) ? 'selected' : '' }}>3 Months</option>
                    <option value="4" {{ ($event->recurrence_duration == 4) ? 'selected' : '' }}>4 Months</option>
                    <option value="6" {{ ($event->recurrence_duration == 6) ? 'selected' : '' }}>6 Months</option>
                    <option value="12" {{ ($event->recurrence_duration == 12) ? 'selected' : '' }}>Year</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Update Event">
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        } );
    </script>
@endsection
