@extends('cms.layouts.default')

@include('cms.news.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">文章列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>标题</th>
                  <th>日期</th>
                  <th>作者</th>
                  <th>附件</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($news as $record)
                <tr>
                  <td>{{ $record->id }}</td>
                  <td>{{ $record->title }}</td>
                  <td>{{ $record->date }}</td>
                  <td>{{ $record->author }}</td>
                  <td>{{ $record->document }}</td>
                  <td>
                    <a href="/news/{{ $record->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/news/{{ $record->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/news/{{ $record->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
