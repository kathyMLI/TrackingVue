export default {
	getResources() {
		return axios.get('/api/permissions');
	}
}