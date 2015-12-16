@extends('cms.layouts.default')

@include('cms.subcategories.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">二级栏目列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>一级栏目</th>
                  <th>二级栏目</th>
                  <th>栏目文章是否唯一</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subcategories as $subcategory)
                <tr>
                  <td>{{ $subcategory->id }}</td>
                  <td>{{ $subcategory->category }}</td>
                  <td>{{ $subcategory->name }}</td>
                  <td>{{ $subcategory->single_article ? '唯一' : '不唯一' }}</td>
                  <td>
                    <a href="/cms/subcategories/{{ $subcategory->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/subcategories/{{ $subcategory->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
