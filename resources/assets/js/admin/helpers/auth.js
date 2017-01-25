import axios from 'axios'

export default {

    user: {
        authenticated: false
    },

    login(creds) {
        return axios.post('/login/', creds);
    },
    setAuthHeader(header) {
        axios.defaults.headers.Authorization = 'Bearer ' + header;
    },
    logOut() {
        localStorage.removeItem('token');
        this.setAuthHeader(null);
        this.user.authenticated = false;
    }
}