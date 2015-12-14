        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/categories' ? 'class="active"' : '') }}><a href="/cms/categories">栏目列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/1st_categories/create' ? 'class="active"' : '') }}><a href="/cms/1st_categories/create">创建一级栏目</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/2nd_categories/create' ? 'class="active"' : '') }}><a href="/cms/2nd_categories/create">创建二级级栏目</a></li>
          </ul>
        </div>