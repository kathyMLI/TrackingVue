import axios from 'axios'

export default {
    getAnnouncement() {
        return axios.get('/api/announcement');
    },
    sendAnnouncement(data) {
        return axios.post('/api/announcement', data);
    },
    markAsRead(data) {
        return axios.post('/api/markNotificationsAsRead', data);
    },
    markAsReadAll(data) {
        return axios.post('/api/markOneAsRead', data);
    },
    delete(data) {
        return axios.post('/api/deleteNotification', data);
    }
}