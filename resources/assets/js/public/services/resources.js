import axios from 'axios'

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
    filterResources(resource, params) {
        return axios.get('/api/' + resource + '/' + this.buildQueryParams(params));
    },
    getResources(resource) {
        return axios.get('/api/' + resource);
    },
    getResource(resource, id) {
        return axios.get('/api/' + resource + '/' + id);
    },
    createResource(resource, data) {
        return axios.post('/api/' + resource, data);
    },
    deleteResource(resource, id) {
        return axios.delete('/api/' + resource + '/' + id);
    },
    updateResource(resource, id, data) {
        return axios.put('/api/' + resource + '/' + id, data);
    },
    me() {
        return axios.get('/api/me');
    }
}