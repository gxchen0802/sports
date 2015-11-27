<!doctype html>
<html>
<head>
<!-- my head section goes here -->
<!-- my css and js goes here -->
</head>
<body>
    <div class="container">
        <header> @include('layouts.header') </header>
        <div class="sidebar"> @include('layouts.sidebar') </div>
        <div class="contents"> @yield('content') </div>
        <footer> @include('layouts.footer') </footer>
    </div>
</body>
</html>