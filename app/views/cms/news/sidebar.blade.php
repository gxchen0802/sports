        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/news' ? 'class="active"' : '') }}><a href="/cms/news">新闻列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/news/create' ? 'class="active"' : '') }}><a href="/cms/news/create">创建新闻</a></li>
          </ul>
        </div>