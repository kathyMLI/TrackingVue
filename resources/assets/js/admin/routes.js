import VueRouter from 'vue-router'

function authentication(to, from,next) {
    if(localStorage.getItem('token') === null) {
        next('/login');
    } else {
        next();
    }
}

const routes = [
    {
        path: '/login',
        name: 'login',
        component: require('./components/auth/Login.vue')
    },
    {
        path: '/',
        component: require('./components/layout/Layout.vue'),
        beforeEnter: authentication,
        redirect: '/home',
        children: [
            {
                path: '/home',
                name: 'home',
                component: require('./components/app/Home.vue') 
            },
            {
                path: '/dashboard',
                name: 'dashboard',
                component: require('./components/app/Dashboard.vue') 
            },
            {
                path: '/users',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'users',
                        component: require('./components/users/List.vue'),
                    },
                    {
                        path: 'create',
                        name: 'usersCreate',
                        component: require('./components/users/Create.vue'),
                    },
                    {
                        path: 'edit/:id',
                        name: 'usersEdit',
                        component: require('./components/users/Edit.vue'),
                    }
                ]
            },
            {
                path: '/roles',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'roles',
                        component: require('./components/roles/List.vue'),
                    },
                    {
                        path: 'create',
                        name: 'rolesCreate',
                        component: require('./components/roles/Create.vue'),
                    },
                    {
                        path: 'edit/:id',
                        name: 'rolesEdit',
                        component: require('./components/roles/Edit.vue'),
                    }
                ]
            },
            {
                path: '/trackings',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'trackings',
                        component: require('./components/trackings/List.vue')
                    }
                ]
            },
            {
                path: '/announcement',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'announcement',
                        component: require('./components/announcements/List.vue')
                    },
                    {
                        path: 'create',
                        name: 'announcementCreate',
                        component: require('./components/announcements/Create.vue')
                    }
                ]
            }
        ]
    }
];

const router = new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});

router.beforeEach((to, from, next) => {
    router.app.$Progress.start()
    next()
})

router.afterEach(() => {
    router.app.$Progress.finish()
})

export default router;