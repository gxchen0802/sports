@extends('cms.layouts.default')

@include('cms.locations.sidebar')

@section('content')


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h2 class="sub-header">查询预约记录</h2>

        {{ Form::open(array('action' => array('LocationsController@search'), 'class' => 'form-horizontal')) }}
            <fieldset>
            
              <div class="form-group">
                <label for="worker_id" class="col-sm-2 control-label">工号</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="worker_id" placeholder="工号" value="{{Session::get('user_name')}}" <?php echo Session::get('user_role') == 'admin' ? '' : 'disabled="disabled"'?>>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">开始日期</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control defTime" name="start_date" placeholder="开始日期">
                </div>
              </div>

              <div class="form-group">
                <label for="场地" class="col-sm-2 control-label">场地</label>
                <div class="col-sm-6">
                  <select id="location_id" name="location_id" class="form-control">
                      <option value=""></option>
                    @foreach($locations as $id => $name)
                      <option value="{{$id}}">{{$name}}</option>
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
                  <th>场地</th>
                  <th>日期</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>参加人数</th>
                  <th>场地用途</th>
                  <th>租用部门</th>
                  <th>租用人</th>
                  <th>备注</th>
                  <th>状态</th>
                </tr>
              </thead>
              <tbody>
              @if (count($records) > 0)
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->name }}</td>
                  <td>{{ $record->start_date }}</td>
                  <td>{{ $record->start_time }}</td>
                  <td>{{ $record->end_time }}</td>
                  <td>{{ $record->attendees }}</td>
                  <td>{{ $record->event }}</td>
                  <td>{{ $record->department }}</td>
                  <td>{{ $record->renter }}</td>
                  <td>{{ $record->comment }}</td>
                  <td>{{ $record->status }}</td>
                </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>


@stop