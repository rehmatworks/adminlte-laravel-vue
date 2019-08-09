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
        path: '/account-settings',
        name: 'account-settings',
        component: require('../components/account/AccountSettings').default,
        meta: {
            title: 'Account Settings'
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
