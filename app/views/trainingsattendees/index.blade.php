@extends('layouts.default')
@section('content')

    SEARCH: </br>

    MESSAGE: {{ Session::get('message') }}
    
    {{ Form::open(array('action' => array('SearchController@attendees'))) }}

    <table border="1">
        <tr>
            <th>Title</th>
            <th>Worker ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->title }}</td>
                <td>{{ $record->worker_id }}</td>
                <td>{{ $record->status }}</td>
                <td>
                    @if ($record->status == 'auditing')
                        {{ HTML::link("/trainings_attendees/$record->id/approve", 'approve')}}
                        {{ HTML::link("/trainings_attendees/$record->id/disapprove", 'disapprove')}}
                        <!-- {{ Form::button('Click Me!', ['class' => 'btn', 'href' => 'http://www.sports.com/trainings/1']) }} -->
                        <!-- {{ Form::button('Do not Click Me!', ['class' => 'btn', 'href' => 'http://www.sports.com/trainings/1']) }} -->
                    @endif
                </td>
            </tr>        
        @endforeach

    </table>

    {{ Form::close() }}

@stop