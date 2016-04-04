@extends('cms.layouts.default')

@include('cms.messages.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main cms-list">

          <h2 class="sub-header">留言列表</h2>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed">
              <thead>
                <tr>
                  <th width="70">留言内容</th>
                  <th class="x-10">留言人</th>
                  <th class="x-10">留言时间</th>
                  <th class="x-10">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($messages as $m)
                <tr>
                  <td>{{ $m->message }}</td>
                  <td>{{ $m->username }}</td>
                  <td>{{ $m->created_at }}</td>
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

          <div class="assistant row">
              <div class="total">
                  <span class="text-primary arial">{{$start_index}}-{{$end_index}}</span>
                  <span> / 共</span>
                  <span class="text-primary arial">{{$total_count}}</span>
                  <span>条</span>
              </div>
              <ul class="pagination">
                  <li>
                      <a href="/cms/messages/unreply?page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="/cms/messages/unreply?page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="/cms/messages/unreply?page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>
          
<!--           <div class="pagination mt30">
              <p>

                  <a href="/cms/messages/unreply">首页</a>
                  <a href="/cms/messages/unreply?page={{ $previous_page }}">上一页</a>

                  @for ($page = 1; $page <= $total_pages; $page++)
                      <a href="/cms/messages/unreply?page={{ $page }}" {{ $page == $current_page ? 'class="on"' : ''}}>{{$page}}</a>
                  @endfor

                  <a href="/cms/messages/unreply?page={{ $next_page }}">下一页</a>
                  <a href="/cms/messages/unreply?page={{ $total_pages }}">末页</a>
              </p>
              <span>{{$start_index}}-{{$end_index}}条，共{{$total_pages}}页</span>
          </div> -->
@stop
