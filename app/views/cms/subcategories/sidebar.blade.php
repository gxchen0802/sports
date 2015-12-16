        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/subcategories' ? 'class="active"' : '') }}><a href="/cms/subcategories">二级栏目列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/subcategories/create' ? 'class="active"' : '') }}><a href="/cms/subcategories/create">创建二级栏目</a></li>
          </ul>
        </div>