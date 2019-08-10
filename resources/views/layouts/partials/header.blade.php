<header class="main-header">
    <router-link :to="'/'" class="logo">
        {{ config('app.name') }}
    </router-link>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <notifications-component></notifications-component>
                <li v-if="user" class="dropdown user user-menu">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <img :src="user.gravatar" class="user-image" alt="User Image">
                        <span class="hidden-xs" v-text="user.name"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img :src="user.gravatar" class="img-circle" alt="User Image">
                            <p>
                                <span v-text="user.name"></span>
                                <small>Joined: <span v-text="user.membersince"></span></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <router-link :to="{name: 'account-settings'}" class="btn btn-default btn-flat">Profile</router-link>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:void(0)" @click="signOut()" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
