@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="/category/{{ $category->id }}">{{ $category->name }}</a> > {{ $subcategory->name }}
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

                @if ($record->document)
                    <div class="d-btn">
                        {{ link_to_asset($record->document, '下载附件', $attributes = array('class' => "btn btn-blue mt30"), $secure = null) }}
                    </div>
                @endif
                
                <div class="d-btn">
                    <a href="#"  class="btn btn-red mt30">立即报名</a>
                </div>
            </div>
        </div>
@stop