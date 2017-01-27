export default {
    buildQueryParams(params) {
        var page = params.page || 1;
        var query = '?page=' + page;

        for (var paramKey in params) {
            if (paramKey !== 'page' && (params[paramKey] !== undefined && params[paramKey] !== '')) {
                query += '&' + paramKey + '=' + params[paramKey];
            }
        }
        return query;
    },
    filterResources(userId, params) {
        return axios.get('/api/users/' + userId + '/trackings/' + this.buildQueryParams(params));
    },
    getResource(userId) {
        return axios.get('/api/users/' + userId + '/trackings');
    },
    createResource(userId, data) {
        return axios.post('/api/users/' + userId + '/trackings', data);
    }
}