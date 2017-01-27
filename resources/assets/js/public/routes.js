import VueRouter from 'vue-router'

function authentication(to, from,next) {
    if(localStorage.getItem('token') === null) {
        next('/login');
    } else {
        next();
    }
}

function isLogged(to, from,next) {
    if(localStorage.getItem('token') === null) {
        next();
    } else {
        next('/home');
    }
}

const routes = [
    {
        path: '/login',
        name: 'login',
        component: require('./components/auth/Login.vue'),
        beforeEnter: isLogged

    },
    {
        path: '/register',
        name: 'register',
        component: require('./components/auth/Register.vue'),
        beforeEnter: isLogged
    },
    {
        path: '/',
        component: require('./components/layout/Index.vue'),
        beforeEnter: isLogged
    },
    {
        path: '/home',
        component: require('./components/layout/Layout.vue'),
        beforeEnter: authentication,
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