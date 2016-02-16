        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings' ? 'class="active"' : '') }}><a href="/trainings">培训列表</a></li>
            @if(Session::get('user_role') == 'admin') 
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings/create' ? 'class="active"' : '') }}><a href="/trainings/create">创建培训</a></li>
            @endif
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings_attendees' ? 'class="active"' : '') }}><a href="/trainings_attendees">培训记录</a></li>
          </ul>
        </div>