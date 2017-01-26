import './bootstrap';

import auth from './helpers/auth'
import axios from 'axios'
import router from './routes'
import VueRouter from 'vue-router'
import Multiselect from 'vue-multiselect'
import VueProgressBar from 'vue-progressbar'
import VueRut from 'vue-rut'

Vue.use(VueRouter);
Vue.use(VueRut);
Vue.use(VueProgressBar, {
	color: '#03A9F4',
	thickness: '3px',
});

Vue.component('layout', require('./components/layout/Layout.vue'));
Vue.component('login', require('./components/auth/Login.vue'));
Vue.component('userlist', require('./components/users/List.vue'));
Vue.component('userCreate', require('./components/users/Create.vue'));
Vue.component('user-form', require('./components/users/Form.vue'));
Vue.component('rol-form', require('./components/roles/Form.vue'));
//Vue.component('notifications', require('./components/layout/Notifications.vue'));
Vue.component('heroMenu', require('./components/layout/Menu.vue'));

Vue.component('multiselect', Multiselect);

window.Event = new class {
	constructor() {
		this.vue = new Vue();
	}
	fire(event, data = null) {
		this.vue.$emit(event, data);
	}
	listen(event, callback) {
		this.vue.$on(event, callback);
	}
}

const app = new Vue({
    router
}).$mount('#app');