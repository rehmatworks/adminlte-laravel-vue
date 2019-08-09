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
    }
];
