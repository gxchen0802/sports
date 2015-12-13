@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="#">中心简介</a> > 中心概况
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix">
            <div class="detail">
                <h1 class="title  mb10">{{ $record->title }}</h1>
                <p class="subtitel mb10">
                    <span>作者：{{ $record->author }}</span>
                    <span>时间：{{ $record->date }}</span>
                </p>
                <div class="d-text">
                {{ $record->content }}
                </div>
                <div class="d-btn">
                    <a href="#"  class="btn btn-red mt30">立即报名</a>
                </div>
            </div>
        </div>
@stop