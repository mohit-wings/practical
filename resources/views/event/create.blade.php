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


        <form action="{{ route('event.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            <div class="form-group">
                <label for="">Start Date</label>
                <input type="text" class="form-control datepicker" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="">End Date</label>
                <input type="text" class="form-control datepicker" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="">Recurrence</label>
                <select name="recurrence_time" required>
                    <option selected="selected" value="1">First</option>
                    <option value="2">Second</option>
                    <option value="3">Third</option>
                    <option value="4">Fourth</option>
                </select>

                <select name="recurrence_day" required>
                    <option selected="selected" value="0">Sun</option>
                    <option value="1">Mon</option>
                    <option value="2">Tue</option>
                    <option value="3">Wed</option>
                    <option value="4">Thu</option>
                    <option value="5">Fri</option>
                    <option value="6">Sat</option>
                </select>

                <select name="recurrence_duration" required>
                    <option selected="selected" value="1">Month</option>
                    <option value="3">3 Months</option>
                    <option value="4">4 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">Year</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Event">
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
