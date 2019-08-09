<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div v-if="user" class="pull-left image">
                <img :src="user.gravatar" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p v-text="user.name"></p>
                <small class="text-muted" v-text="'Joined: ' + user.membersince"></small>
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
                <router-link :to="{name: 'account-settings'}">
                    <i class="fa fa-cog"></i><span>Account Settings</span>
                </router-link>
            </li>
        </ul>
    </section>

</aside>
