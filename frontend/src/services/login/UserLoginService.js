import axios from 'axios';

const apiClient = axios.create({
    baseURL: `http://apecrosmieres.local/wp-json`,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
    timeout: 10000
});

export default {
    async login(param) {
        try {
            const response = await apiClient.post('/jwt-auth/v1/token', param);
            return response.data

        } catch (errors) {
            return errors.response.data
        }
    },

    async getRoles(id) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const role = await apiClient.get('/wp/v2/users/' + id + '?context=edit');
            return role.data
        } catch(error) {
            return error.response.data
        } 
    }
}