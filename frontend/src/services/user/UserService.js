import axios from 'axios';

const apiClient = axios.create({
    baseURL: `http://apecrosmieres.local/wp-json`,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Authorization: 'Bearer' + sessionStorage.getItem('token') + ''
    },
    timeout: 10000
});

export default {

    async delete() {
        try {
            const response = await apiClient.delete('/wp/v2/user', {
                "force": true,
                "reassign": 1
            });
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },

    async update(id, params) {
        try {
            const response = await apiClient.post('/wp/v2/users/' + id, params);
            return response.data
        } catch (errors) {
            return errors.response.data
        }
    },
    async sendEmail(params) {
        try {
            const response = await apiClient.post('/wp/v2/send', params);
            return response.data
        } catch (errors) {
            return errors.response.data
        }
    },
}