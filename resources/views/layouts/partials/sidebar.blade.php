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
            <li :class="{'active': $route.name == 'home'}">
                <router-link :to="{'name': 'home'}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </router-link>
            </li>
            <li class="header">Website & Account</li>
            <li v-if="userCan('website-settings')" :class="{'active': $route.name == 'website-settings'}">
                <router-link :to="{name: 'website-settings'}">
                    <i class="fa fa-cogs"></i><span>Website Settings</span>
                </router-link>
            </li>
            <li :class="{'active': $route.name == 'account-settings'}">
                <router-link :to="{name: 'account-settings'}">
                    <i class="fa fa-user"></i><span>Profile Settings</span>
                </router-link>
            </li>
            <li v-if="userCan('manage-users')" :class="{'active': $route.name == 'manage-users'}">
                <router-link :to="{name: 'manage-users'}">
                    <i class="fa fa-group"></i><span>Manage Users</span>
                </router-link>
            </li>
        </ul>
    </section>

</aside>
