    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">在线报名 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/trainings">列表</a></li>
                <li><a href="/trainings/create">创建</a></li>
                <li><a href="/trainings_attendees">记录</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">场地预约 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/locations">列表</a></li>
                <li><a href="/locations/create">创建</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/locations_rent/search">查询预约记录</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">栏目 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/categories">一级栏目</a></li>
                <li><a href="/cms/subcategories">二级栏目</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">文章 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/news">列表</a></li>
                <li><a href="/cms/news/create">创建文章</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">用户 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/password/edit">更改密码</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/cms/users">重置密码</a></li>
              @endif
                <li><a href="/logout">登出</a></li>
              </ul>
            </li>            
            
          </ul>

        </div>
      </div>
    </nav>