@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <a href="{{ route('event.index') }}" class="btn btn-primary float-right mb-5">Back</a>
        <div style="clear: both;"></div>

        <h1>
            {{ $event->title }}
        </h1>

        <table class="table mt-5 col-md-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($date_array as $item)
                    <tr>
                        <td>{{ $item }}</td>
                        <td>{{ $event->day }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        Total Event Count {{ count($date_array) }}
    </div>

@endsection
