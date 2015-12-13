<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>教师发展中心 - 上海体育学院</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="教师发展中心，上海体育学院">
    <meta name="author" content="上海体育学院">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />

    <link type="text/css" rel="stylesheet" href="/css/main.min.css">
</head>
<body>
    <div class="body">
        @include('pages.layouts.header')

        @yield('content')
    </div>

    @include('pages.layouts.footer')

    <!-- 微信客户端浮层 -->
    <div class="erwei hide"><img src="http://placehold.it/120x120&text=Pic001-120*120" /></div>
    <!-- 右侧浮层 -->
    <div class="r-fixed">
        <a class="goTop hide" href="javascript:void(0);" title="返回顶部"><i class="icon go-top"></i></a>
    </div>

    <script type="text/javascript" charset="utf-8" src="/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/main.min.js"></script>
    <script type="text/javascript">
    $(function() {
        tiyuanFed.indexInit();
    });
    </script>
</body>

</html>