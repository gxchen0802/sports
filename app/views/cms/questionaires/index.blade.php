@extends('cms.layouts.default')

@include('cms.questionaires.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">问卷调查列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>标题</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($questionaires as $q)
                <tr>
                  <td>{{ $q->title }}</td>
                  <td>{{ $q->start_time }}</td>
                  <td>{{ $q->end_time }}</td>
                  <td>{{ $q->status == 'active' ? '开启' : '关闭' }}</td>
                  <td>
                    <a href="/questionaires/{{ $q->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/questionaires/{{ $q->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/questionaires/{{ $q->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


          <div class="pagination mt30">
              <p>

                  <a href="/cms/messages">首页</a>
                  <a href="/cms/messages?page={{ $previous_page }}">上一页</a>

                  @for ($page = 1; $page <= $total_pages; $page++)
                      <a href="/cms/messages?page={{ $page }}" {{ $page == $current_page ? 'class="on"' : ''}}>{{$page}}</a>
                  @endfor

                  <a href="/cms/messages?page={{ $next_page }}">下一页</a>
                  <a href="/cms/messages?page={{ $total_pages }}">末页</a>
              </p>
              <span>{{$start_index}}-{{$end_index}}条，共{{$total_pages}}页</span>
          </div>

@stop
