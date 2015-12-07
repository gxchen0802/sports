        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations' ? 'class="active"' : '') }}><a href="/locations">场地列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations/create' ? 'class="active"' : '') }}><a href="/locations/create">创建场地</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/' ? 'class="active"' : '') }}><a href="/#">租用记录</a></li>
          </ul>
        </div>