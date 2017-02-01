export default {

	register(data) {
        return axios.post('/register/', data);
    },
    validate(id, data) {
        return axios.post('/validate/' + id, data);
    }
}
