@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="#">问卷调查</a>
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix">
            <div class="detail">
                <h1 class="title  mb10">上海体育学院教师培训满意度调查问卷</h1>
                <p class="subtitel mb10">
                    <span>开始时间：{{isset($questionaire->start_time) ? $questionaire->start_time : ''}}</span>
                    <span>结束时间：{{isset($questionaire->end_time) ? $questionaire->end_time : ''}}</span>
                </p>
            @if ($questionaire_expired)
                <!-- 超过设置的问卷时间，显示如下 -->
                <div class="d-text">
                    <h3>对不起，该问卷已经过期了！</h3>
                </div>
            @elseif (Input::get('result') == 'success')
                <!-- 投票完成显示如下，显示如下 -->
                <div class="d-text">
                    <h3>问卷提交完成！</h3>
                </div>
            @elseif (Input::get('result') == 'error')
                 <!-- 已经投票过的IP不能再投票，显示如下 -->
                <div class="d-text">
                    <h3>问卷提交出错！</h3>
                </div>
            @elseif ($already_voted)
                 <!-- 已经投票过的IP不能再投票，显示如下 -->
                <div class="d-text">
                    <h3>您已经完成了问卷，不能重复完成！</h3>
                </div>
            @else
                <!-- 可以正常提交问卷，示如下 -->
                <div class="d-text">
                    {{$questionaire->description}}
                </div>

                {{ Form::open(array('action' => array('QuestionairesController@vote', $questionaire->id), 'accept-charset' => 'utf-8', 'id' => 'voteSubmitForm')) }}

                    <div class="d-list">
                        @foreach ($questions as $question_id => $answers)
                            <dl>
                                <dt>{{$answers[0]['question']}}</dt>
                                <dd>
                                    @foreach ($answers as $a)
                                    <label>
                                        <input type="{{$radio_checkbox}}" class="radio validate[minCheckbox[1]]" name="{{$question_id}}" value="{{$a['answer_id']}}">{{$a['answer']}}</label>
                                    @endforeach
                                </dd>
                            </dl>
                        @endforeach
                    </div>
                    <div class="d-btn">
                        <!-- 立即报名按钮，调用AJAX报名 -->
                        <button type="submit" id="voteSubmit" class="btn btn-red mt30 btn-ok" title="提交问卷">提交问卷</button>
                        <!-- 已报名按钮，禁用了点击事件 -->
                        <!-- <button type="submit" id="voteSubmit" class="btn btn-red mt30 btn-ok disabled" title="已提交问卷" disabled="">已提交问卷</button> -->
                    </div>
                {{ Form::close() }}
                 <!-- 可以正常提交问卷，示如上 -->
            @endif
            </div>
        </div>
@stop

@section('extra_css')
<link type="text/css" rel="stylesheet" href="/css/login.min.css">
@stop

@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/login.min.js"></script>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        tiyuanFed.voteInit();
    });
</script>
@stop