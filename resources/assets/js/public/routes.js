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
                path: '/trackings',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'trackings',
                        component: require('./components/trackings/List.vue')
                    },
                    {
                        path: 'create',
                        name: 'trackingsCreate',
                        component: require('./components/trackings/Create.vue')
                    },
                    {
                        path: 'edit/:id',
                        name: 'trackingsEdit',
                        component: require('./components/trackings/Edit.vue')
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