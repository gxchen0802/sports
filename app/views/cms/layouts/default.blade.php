<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CMS</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for CMS -->
    <link href="/css/cms.css" rel="stylesheet">
</head>
<body>
    @include('cms.layouts.header')

    <div class="container-fluid">
      <div class="row">
        
        @yield('content')
      </div>
    </div>

    <!-- @include('cms.layouts.footer') -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    
    <!-- Custom styles for CMS -->
    <script src="/js/cms.js"></script>
</body>
</html>