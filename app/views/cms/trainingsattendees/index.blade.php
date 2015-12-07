@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header">列表</h1> -->

          <h2 class="sub-header">培训记录</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>培训名称</th>
                  <th>培训介绍</th>
                  <th>培训日期</th>
                  <th>工号</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->id }}</td>
                  <td>{{ $record->title }}</td>
                  <td>{{ $record->content }}</td>
                  <td>{{ $record->date }}</td>
                  <td>{{ $record->worker_id }}</td>
                  <td>{{ $record->status }}</td>
                  <td>
                    <a href="/trainings_attendees/{{ $record->id }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                    <a href="/trainings_attendees/{{ $record->id }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
@stop
