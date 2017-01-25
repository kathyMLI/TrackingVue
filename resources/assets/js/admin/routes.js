import VueRouter from 'vue-router'

import Layout from './components/layout/Layout.vue'
import Login from './components/auth/Login.vue'
import UsersList from './components/users/List.vue'
import UsersCreate from './components/users/Create.vue'
import UsersEdit from './components/users/Edit.vue'
import RolesList from './components/roles/List.vue'
import RolesCreate from './components/roles/Create.vue'
import RolesEdit from './components/roles/Edit.vue'
import AnnouncementList from './components/notifications/List.vue'
import AnnouncementCreate from './components/notifications/Create.vue'
import Home from './components/app/Home.vue'
import Dashboard from './components/app/Dashboard.vue'

import auth from './helpers/auth'

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
        component: Login
    },
    {
        path: '/',
        component: Layout,
        beforeEnter: authentication,
        redirect: '/home',
        children: [
            {
                path: '/home',
                name: 'home',
                component: Home 
            },
            {
                path: '/dashboard',
                name: 'dashboard',
                component: Dashboard 
            },
            {
                path: '/users',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        name: 'users',
                        component: UsersList,
                    },
                    {
                        path: 'create',
                        name: 'usersCreate',
                        component: UsersCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'usersEdit',
                        component: UsersEdit,
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
                        component: RolesList,
                    },
                    {
                        path: 'create',
                        name: 'rolesCreate',
                        component: RolesCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'rolesEdit',
                        component: RolesEdit,
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
                        component: AnnouncementList
                    },
                    {
                        path: 'create',
                        name: 'announcementCreate',
                        component: AnnouncementCreate
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