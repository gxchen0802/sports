@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header">列表</h1> -->

          <h2 class="sub-header">培训列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>介绍</th>
                  <th>日期</th>
                  <th>主讲人</th>
                  <th>培训地点</th>
                  <th>限额</th>
                  <th>剩余名额</th>
                  <th>学分</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trainings as $training)
                <tr>
                  <td>{{ $training->id }}</td>
                  <td>{{ $training->title }}</td>
                  <td>{{ mb_substr($training->content, 0, 10) }}</td>
                  <td>{{ $training->date }}</td>
                  <td>{{ $training->speaker }}</td>
                  <td>{{ $training->location }}</td>
                  <td>{{ $training->seats }}</td>
                  <td>{{ $training->seats_left }}</td>
                  <td>{{ $training->score }}</td>
                  <td>
                    <a href="/trainings/{{ $training->id }}">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                  @if(Session::get('user_role') == 'admin') 
                    <a href="/trainings/{{ $training->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/trainings/{{ $training->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
