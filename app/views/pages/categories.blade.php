@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix bg-grey">
            <!-- sidebar -->
            <div class="sidebar">
                <h3 class="title">{{ $category->name }}</h3>
                @foreach($subcategories as $subcategory)
                    <a href="/categories/{{ $category->id }}/subcategories/{{ $subcategory->id }}">{{ $subcategory->name }}</a>
                @endforeach
            </div>
            <!-- cen-list -->
            <div class="main-list i-list-box ">
                <h3 class="title mb20"><span>公告通知</span></h3>
                <ul class="list">
                    @foreach($articles as $article)
                        <li><a href="/news/{{ $article->id }}" target="_blank"><i class="icon"></i>{{ $article->title }}</a><span class="datetime">{{ date('m-d', strtotime($article->date)) }}</span></li>
                    @endforeach
                </ul>
                <!-- 分页 -->
                <div class="pagination mt30">
                    <p>
                        <a href="#">首页</a>
                        <a href="#">上一页</a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a class="on">4</a>
                        <a href="#">5</a>
                        <a href="#">下一页</a>
                        <a href="#">末页</a>
                    </p>
                    <span>{{$start_index}}-{{$end_index}}条，共{{$total_pages}}页</span>
                </div>
            </div>
        </div>

@stop