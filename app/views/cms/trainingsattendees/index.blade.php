@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header">列表</h1> -->

          <h2 class="sub-header">搜索培训记录</h2>
          <!-- <h3>搜索培训记录</h2> -->

          {{ Form::open(array('action' => array('TrainingsAttendeesController@search'), 'class' => 'form-horizontal')) }}
            <fieldset>

              <div class="form-group">
                <label for="worker_id" class="col-sm-2 control-label">工号</label>
                <div class="col-sm-6">
                  <input type="text" id="worker_id" name="worker_id" class="form-control" placeholder="工号" value="{{Session::get('user_name')}}" >
                </div>
              </div>

              <div class="form-group">
                <label for="培训" class="col-sm-2 control-label">培训</label>
                <div class="col-sm-6">
                  <select id="training" name="training_id" class="form-control">
                      <option value=""></option>
                    @foreach($trainings as $id => $title)
                      <option value="{{$id}}">{{$title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">提交</button>
                </div>
              </div>
              
            </fieldset>
          {{ Form::close() }}

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
                    @if(Session::get('user_role') == 'admin') 
                    <a href="/trainings_attendees/{{ $record->id }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true">签到</span>
                    </a>
                    <a href="/trainings_attendees/{{ $record->id }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true">旷课</span>
                    </a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
@stop
