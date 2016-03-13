        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites' ? 'class="active"' : '') }}><a href="/cms/friendly_sites">友情链接列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites/create' ? 'class="active"' : '') }}><a href="/cms/friendly_sites/create">创建友情链接</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department' ? 'class="active"' : '') }}><a href="/cms/education_department">教育部链接列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department/create' ? 'class="active"' : '') }}><a href="/cms/education_department/create">创建教育部链接</a></li>
          </ul>
        </div>