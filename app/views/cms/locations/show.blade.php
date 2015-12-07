@extends('cms.layouts.default')

@include('cms.locations.sidebar')

@section('content')

    <!-- {{{ Session::get('message') or 'Default message!!!!!' }}}  </br>   -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h2 class="sub-header">查看场地 ({{ $location->name }}) </h2>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>日期</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>参加人数</th>
                  <th>场地用途</th>
                  <th>租用部门</th>
                  <th>租用人</th>
                  <th>备注</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->start_date }}</td>
                  <td>{{ $record->start_time }}</td>
                  <td>{{ $record->end_time }}</td>
                  <td>{{ $record->attendees }}</td>
                  <td>{{ $record->event }}</td>
                  <td>{{ $record->department }}</td>
                  <td>{{ $record->renter }}</td>
                  <td>{{ $record->comment }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop