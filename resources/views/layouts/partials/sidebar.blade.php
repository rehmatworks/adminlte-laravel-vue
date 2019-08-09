<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <small class="text-muted">System Administrator</small>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Dashboard</li>
            <li>
                <router-link :to="{'name': 'home'}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </router-link>
            </li>
            <li class="header">Account Settings</li>
            <li>
                <a href="#">
                    <i class="fa fa-cog"></i><span>Account Settings</span>
                </a>
            </li>
        </ul>
    </section>

</aside>
