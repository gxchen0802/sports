        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations' ? 'class="active"' : '') }}><a href="/locations">列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/search' ? 'class="active"' : '') }}><a href="/locations_rent/search">查询</a></li>
        @if(Session::get('user_role') == 'admin') 
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations/create' ? 'class="active"' : '') }}><a href="/locations/create">创建</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/audit' ? 'class="active"' : '') }}><a href="/locations_rent/audit">审核</a></li>
        @endif
          </ul>
        </div>