@extends('layouts.default')
@section('content')

    <!-- {{{ Session::get('message') or 'Default message' }}}  </br>   -->

    TRAINING INFO: </br>
    Title: {{{ $training->title }}} </br>
    Content: {{{ $training->content }}} </br>

	{{ Form::open(array('action' => array('TrainingsAttendeesController@store', $training->id))) }}

	    <!-- {{Form::hidden('training_id', $training->id)}} -->

		{{Form::label('worker_id', '工号', array('class' => 'worker_id'))}}
	    {{Form::text('worker_id')}}

	    {{Form::submit('Click Me!')}}

	{{ Form::close() }}

@stop