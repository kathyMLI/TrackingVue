import VueRouter from 'vue-router'

function authentication(to, from,next) {
    if(localStorage.getItem('token') === null) {
        next('/login');
    } else {
        next();
    }
}

function isNotLogged(to, from,next) {
    if(localStorage.getItem('token') === null) {
        next();
    } else {
        next('/home');
    }
}

const routes = [
    {
        path: '/',
        component: require('./components/layout/UnRegister.vue'),
        beforeEnter: isNotLogged,
        redirect: { name: 'index'},
        children: [
            {
                path: 'index',
                name: 'index',
                component: require('./components/index/Index.vue')
            },
            {
                path: 'about',
                name: 'about',
                component: require('./components/index/About.vue')
            },
            {
                path: 'aboutUs',
                name: 'aboutUs',
                component: require('./components/index/AboutUs.vue')
            },
            {
                path: 'login',
                name: 'login',
                component: require('./components/auth/Login.vue')
            },
            {
                path: 'register',
                name: 'register',
                component: require('./components/auth/Register.vue')
            },
            {
                path: 'validate/:id',
                name: 'validate',
                component: require('./components/auth/Validate.vue')
            },
            {
                path: 'sendmail',
                name: 'sendmail',
                component: require('./components/auth/SendMail.vue')
            }
        ]
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
                path: '/account',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: 'settings',
                        name: 'accountSettings',
                        component: require('./components/user/Settings.vue')
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