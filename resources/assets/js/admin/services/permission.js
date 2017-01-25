import axios from 'axios'

export default {
	getResources() {
		return axios.get('/api/permissions');
	}
}