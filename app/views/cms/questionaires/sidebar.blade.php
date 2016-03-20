        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires' ? 'class="active"' : '') }}><a href="/cms/questionaires">问卷调查列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires/create' ? 'class="active"' : '') }}><a href="/cms/questionaires/create">创建问卷调查</a></li>
          </ul>
        </div>