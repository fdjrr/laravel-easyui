<div style="padding:0px;width:auto;border:0px">
    <a class="easyui-menubutton" href="#" menu="#mm1"> <i class="fa fa-home fa-lg"></i> Home</a>
    <a class="easyui-menubutton" href="#" menu="#mm2"> <i class="fa fa-gears fa-lg"></i> Setting</a>
    <a class="easyui-menubutton" href="#" menu="#mm3"><i class="fa fa-question-circle fa-lg"></i> Help</a>
</div>

<div id="mm1" style="width:150px;">
    <div data-options="iconCls:'fa fa-user'"><a data-title="User Infromasi" data-toggle="loadContent"
            href="{{ route('user.profile') }}">User Info</a></div>
    <div>Change Password</div>
    <div class="menu-sep"></div>
    <div data-options="iconCls:'fa fa-sign-out'"><a href="{{ route('logout') }}">Logout</a></div>
</div>
<div id="mm2" style="width:150px;">
    <div>Style</div>
    <div class="menu-sep"></div>
    <div data-options="iconCls:'fa fa-expand'"><a data-toggle="fullscreen" href="#">Full Screen</a></div>
    <div data-options="iconCls:'fa fa-compress'"><a data-toggle="exitfullscreen" href="#">Exit Full Screen</a>
    </div>
</div>
<div id="mm3" style="width:150px;">
    <div>Help</div>
    <div class="menu-sep"></div>
    <div>Aplication Docs</div>
    <div><a data-title="Development Documents" data-toggle="loadContent" href="{{ route('docs') }}">Development Docs</a>
    </div>
    <div class="menu-sep"></div>
    <div><a href="javascript:void(0)" onclick="$('#about').window('open')">About</a></div>
</div>
