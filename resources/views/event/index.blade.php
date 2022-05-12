@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <a href="{{ route('event.create') }}" class="btn btn-primary float-right mb-5">Add Event</a>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Dates</th>
                    <th>Occurrence</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($events as $item)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($item->end_date)->format('Y-m-d') }}</td>
                        <td>
                            {{ $item->week.' '.$item->day.' of the '.$item->duration }}
                        </td>
                        <td>
                            <form action="{{ route('event.destroy',$item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('event.show',$item->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('event.edit',$item->id) }}" class="btn btn-success">Edit</a>
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection
