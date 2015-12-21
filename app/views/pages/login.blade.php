@extends('pages.layouts.default')

@section('extra_css')
<link type="text/css" rel="stylesheet" href="/css/login.min.css">
@stop

@section('content')
    <!-- centre  -->
    <div class="login-main">
        <div class="login-cen tab">
            <h3 class="title ">
                <a href="javascript:void(0);" class="tag on">登录</a>
                <a href="javascript:void(0);" class="tag">注册</a>
            </h3>
            <ul class="tab-box hide show">
                {{ Form::open(array('action' => array('UsersController@signin'), 'class' => 'form-horizontal', 'id' => 'loginForm')) }}
                <!-- <form id="loginForm" action="#" method="post" accept-charset="utf-8"> -->
                    <li>
                        <span>用户名：</span>
                        <input type="text" name="uname" id="uname" value="" maxlength="20" placeholder="请输入用户名" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                    </li>
                    <li>
                        <span>密码：</span>
                        <input type="password" name="password" id="password" value="" maxlength="20" placeholder="请输入密码" data-validation-engine="validate[required]">
                    </li>
                    <li>
                        <span>验证码：</span>
                        <input type="text" name="captcha" id="captcha" value="" maxlength="6" placeholder="请输入验证码" class="short" data-validation-engine="validate[required]">
                        <img class="captcha-pic" src="../images/captcha.png" alt="验证码">
                    </li>
                    <li>
                        <span></span>
                        <label>
                            <input type="checkbox" name="autoLogin" id="autoLogin" value="true" checked="" class="checkbox"> 下次自动登录
                        </label>
                        <a href="#">忘记密码？</a>
                    </li>
                    <li>
                        <button type="submint" class="btn btn-bule3 btn-ok" title="立即登录">立即登录</button>
                    </li>
                {{ Form::close() }}
                <!-- </form> -->
            </ul>
            <ul class="tab-box hide">
                {{ Form::open(array('action' => array('UsersController@register'), 'class' => 'form-horizontal', 'id' => 'regsiterForm')) }}
                <!-- <form id="regsiterForm" action="#" method="post" accept-charset="utf-8"> -->
                    <li>
                        <span><em>*</em>用户名：</span>
                        <input type="text" name="uname" id="uname" value="" maxlength="20" placeholder="请输入用户名" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                    </li>
                    <li>
                        <span><em>*</em>密码：</span>
                        <input type="password" name="password" id="password" value="" maxlength="20" placeholder="请输入密码" data-validation-engine="validate[required]">
                    </li>
                    <li>
                        <span><em>*</em>确认密码：</span>
                        <input type="password" name="password2" id="password2" value="" maxlength="20" placeholder="请再次输入密码" data-validation-engine="validate[required,equals[password]]">
                    </li>
                    <li>
                        <span><em>*</em>邮箱：</span>
                        <input type="text" name="email" id="email" value="" maxlength="50" placeholder="请输入您的邮箱" data-validation-engine="validate[required,custom[email]]">
                    </li>
                    <li>
                        <span>姓名</span>
                        <input type="text" name="uname" id="uname" value="" maxlength="4" placeholder="请输入姓名" data-validation-engine="validate[custom[name]]">
                    </li>
                    <li>
                        <span>手机：</span>
                        <input type="text" name="phone" id="phone" value="" maxlength="11" placeholder="请输入您的手机号码" data-validation-engine="validate[custom[mobile]]">
                    </li>
                    <li>
                        <span>工作单位：</span>
                        <input type="text" name="address" id="address" value="" maxlength="50" placeholder="请输入您工作单位" data-validation-engine="validate[custom[onlyLetterNumber]]">
                    </li>
                    <li>
                        <span><em>*</em>验证码：</span>
                        <input type="text" name="captcha" id="captcha" value="" maxlength="6" placeholder="请输入验证码" class="short" data-validation-engine="validate[required]">
                        <img class="captcha-pic" src="../images/captcha.png" alt="验证码">
                    </li>
                    <li>
                        <button type="submint" class="btn btn-bule3 btn-ok" title="立即注册">立即注册</button>
                    </li>
                {{ Form::close() }}
                <!-- </form> -->
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
        //不显示弹出框
        tiyuanFed.loginlInit();
        // ---------------------------------
        // 显示提示正确信息的弹出框
        // tiyuanFed.loginlInit("ok","登录成功");
        // -------------------------------------
        // 显示提示错误信息的弹出框
        // tiyuanFed.loginlInit("error","登录失败");
    });
</script>
@stop
