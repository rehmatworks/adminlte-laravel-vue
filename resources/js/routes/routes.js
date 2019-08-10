export const routes = [
    {
        path: '/',
        name: 'home',
        component: require('../components/pages/BlankPage').default,
        meta: {
            title: 'Blank Page'
        }
    },
    {
        path: '/profile/:userId?',
        name: 'account-settings',
        component: require('../components/users/ProfileComponent').default,
        meta: {
            title: 'Account Settings'
        }
    },
    {
        path: '/manage-users',
        name: 'manage-users',
        component: require('../components/users/UsersComponent').default,
        meta: {
            title: 'Manage Users'
        }
    },
    {
        path: '/auth/login',
        name: 'login',
        component: require('../components/auth/LoginComponent').default,
        meta: {
            title: 'Account Login'
        }
    },
    {
        path: '/auth/register',
        name: 'register',
        component: require('../components/auth/RegisterComponent').default,
        meta: {
            title: 'Account Signup'
        }
    }
];
