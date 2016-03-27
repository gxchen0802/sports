@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->

        <!-- centre  -->
        <div class="centre mt20 clearfix bg-grey">
            <!-- cen-list -->
            <div class="message-container i-list-box">
                <h3 class="title mb20"><span>留言板</span></h3>
                <!-- 留言筛选 -->
<!--                 <ul class="msg-bar mb10">
                    <li class="checkbox">
                        <a class="on" href="#"><i class="icon icon-ch"></i>全部</a>
                        <a href="#"><i class="icon icon-ch"></i>已回复</a>
                        <a href="#"><i class="icon icon-ch"></i>未回复</a>
                    </li>
                    <li class="btns">
                        <a href="#msgRelease">[发布留言]</a>
                    </li>
                </ul> -->
                <!-- 留言列表 -->
                <ul class="msg-list">
                @foreach($messages as $message)
                    <dl class="msg-item">
                        <dt class="msg-details"><i class="icon icon-hint"></i><p>{{ $message->message }}</p></dt>
                        @if($message->reply)
                            <dd class="msg-reply">{{ $message->reply_author }}回复：{{ $message->reply }}</dd>
                        @endif
                        <dd class="msg-subtitel">
                            <span>发布人：{{ $message->username }}</span>
                            <span>发布时间：{{ $message->created_at }}</span>
                        </dd>
                    </dl>
                @endforeach
                </ul>

                <!-- 分页 -->
                <div class="pagination mt30">
                    <p>

                        <a href="/messages">首页</a>
                        <a href="/messages?page={{ $previous_page }}">上一页</a>

                        @for ($page = 1; $page <= $total_pages; $page++)
                            <a href="/messages?page={{ $page }}" {{ $page == $current_page ? 'class="on"' : ''}}>{{$page}}</a>
                        @endfor

                        <a href="/messages?page={{ $next_page }}">下一页</a>
                        <a href="/messages?page={{ $total_pages }}">末页</a>
                    </p>
                    <span>{{$start_index}}-{{$end_index}}条，共{{$total_pages}}页</span>
                </div>
            </div>
            <!-- 发布留言 -->
            <div class="message-container i-list-box mt20">
                <h3 class="title mb20"><span>发布留言</span></h3>
                <ul class="tab-box hide show">
                    <!-- <form id="msgReleaseForm" action="#" method="post" accept-charset="utf-8"> -->
                    {{ Form::open(array('action' => array('MessageController@store'), 'accept-charset' => 'utf-8', 'id' => 'msgForm')) }}
                        <li>
                            <span><em>*</em> 留言人：</span>
                            <input type="text" name="uname" id="uname" value="" maxlength="20" placeholder="请输入留言人名称" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                        </li>
                        <li>
                            <span><em>*</em> 留言内容：</span>
                            <textarea name="message" id="text-message" data-validation-engine="validate[required,maxSize[300]]" placeholder="请输入留言内容，最大不超过300字" maxlength="300" rows="3"></textarea>
                        </li>
<!--                         <li>
                            <span><em>*</em> 验证码：</span>
                            <input type="text" name="captcha" id="captcha" value="" maxlength="6" placeholder="请输入验证码" class="short" data-validation-engine="validate[required]">
                            <img class="captcha-pic" src="/images/captcha.png" alt="验证码">
                        </li> -->
                        <li>
                            <button type="submit" class="{{$disable_submit}} btn btn-bule3" title="立即发布">立即发布</button>
                        </li>
                    {{ Form::close() }}
                </ul>
            </div>
        </div>
@stop

@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/login.min.js"></script>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        tiyuanFed.formValidationFun($("#msgForm"));
    });
</script>
@stop