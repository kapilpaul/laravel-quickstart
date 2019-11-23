<!-- sidebar panel -->
<div class="sidebar-panel offscreen-left">
    <div class="brand">
        <!-- toggle small sidebar menu -->
        <a href="javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
            <i class="icon-grid"></i>
        </a>
        <!-- /toggle small sidebar menu -->
        <!-- toggle offscreen menu -->
        <div class="toggle-offscreen">
            <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <a class="brand-logo">
            <span>Reactor</span>
        </a>
        <a href="#" class="small-menu-visible brand-logo">R</a>
        <!-- /logo -->
    </div>

    <!-- main navigation -->
    <nav role="navigation">
        <ul class="nav">
            @if(Sentinel::inRole('admin') || Sentinel::inRole('hr'))
            <!-- user -->
            <li>
                <a href="{{ route('users.index') }}">
                    <i class="icon-user"></i>
                    <span>Users</span>
                </a>
            </li>
            <!-- /user -->
            @endif

            <!-- cards -->
            <li>
                <a href="javascript:;">
                    <span class="badge pull-right">4</span>
                    <i class="icon-drop"></i>
                    <span>Cards</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="cards-basic.html">
                            <span>Basic</span>
                        </a>
                    </li>
                    <li>
                        <a href="cards-portlets.html">
                            <span>Portlets</span>
                        </a>
                    </li>
                    <li>
                        <a href="cards-draggable.html">
                            <span>Draggable</span>
                        </a>
                    </li>
                    <li>
                        <a href="cards-widgets.html">
                            <span>Widgets</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- /cards -->
        </ul>
    </nav>
    <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
