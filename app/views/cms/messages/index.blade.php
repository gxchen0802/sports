@extends('cms.layouts.default')

@include('cms.messages.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">留言列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>留言内容</th>
                  <th>留言人</th>
                  <th>留言时间</th>
                  <th>回复</th>
                  <th>回复人</th>
                  <th>回复时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($messages as $m)
                <tr>
                  <td>{{ $m->message }}</td>
                  <td>{{ $m->username }}</td>
                  <td>{{ $m->created_at }}</td>
                  <td>{{ $m->reply }}</td>
                  <td>{{ $m->reply_author }}</td>
                  <td>{{ $m->updated_at }}</td>
                  <td>
           <!--          <a href="/messages" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a> -->
                    <a href="/cms/messages/{{ $m->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/messages/{{ $m->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
