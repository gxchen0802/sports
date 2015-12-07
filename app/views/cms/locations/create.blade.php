@extends('layouts.default')
@section('content')

    MESSAGE: {{ Session::get('message') }}

    {{ Form::open(array('action' => array('LocationsController@store'))) }}

        {{Form::hidden('location_id', $location_id)}}

        {{Form::label('start_date', '开始日期', array('class' => 'start_date'))}}
        {{Form::text('start_date')}}

        {{Form::label('start_time', '开始时间', array('class' => 'start_time'))}}
        {{Form::text('start_time')}}

        {{Form::label('end_time', '结束时间', array('class' => 'end_time'))}}
        {{Form::text('end_time')}}

        {{Form::label('attendees', '规模', array('class' => 'attendees'))}}
        {{Form::text('attendees')}}

        {{Form::label('department', '租用部门', array('class' => 'department'))}}
        {{Form::text('department')}}

        {{Form::label('renter', '租用人', array('class' => 'renter'))}}
        {{Form::text('renter')}}

        {{Form::label('event', '用途', array('class' => 'event'))}}
        {{Form::text('event')}}

        {{Form::label('comment', '备注', array('class' => 'comment'))}}
        {{Form::text('comment')}}

        {{Form::submit('Click Me!')}}

    {{ Form::close() }}

@stop