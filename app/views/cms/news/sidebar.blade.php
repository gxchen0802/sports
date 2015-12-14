        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/news' ? 'class="active"' : '') }}><a href="/cms/news">文章列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/news/create' ? 'class="active"' : '') }}><a href="/cms/news/create">创建文章</a></li>
          </ul>
        </div>