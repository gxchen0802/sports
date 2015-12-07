@extends('layouts.default')
@section('content')

    SEARCH: </br>

    {{ Form::open(array('action' => array('SearchController@attendees', $worker_id))) }}

        {{Form::label('start_date', '开始日期', array('class' => 'start_date'))}}
        {{Form::text('start_date')}}

        {{Form::label('end_date', '结束日期', array('class' => 'end_date'))}}
        {{Form::text('end_date')}}

        {{Form::label('training_title', '讲座名称', array('class' => 'training_title'))}}
        {{Form::text('training_title')}}

        {{Form::label('training_speaker', '主讲人', array('class' => 'training_speaker'))}}
        {{Form::text('training_speaker')}}

        {{Form::label('training_score', '学分', array('class' => 'training_score'))}}
        {{Form::text('training_score')}}

        {{Form::submit('Click Me!')}}

    {{ Form::close() }}

@stop