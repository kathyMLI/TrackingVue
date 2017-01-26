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
//Vue.component('notifications', require('./components/layout/Notifications.vue'));
Vue.component('heroMenu', require('./components/layout/Menu.vue'));
Vue.component('trackingForm', require('./components/trackings/Form.vue'))

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