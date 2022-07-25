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
    async registerChild(params) {
         apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.post('/wp/v2/child', params);
            return response.data
        } catch (errors) {
            return errors.response.data
        }
    },

    async findChild(id) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.get("/wp/v2/child?user_id=" + id + "?context=edit" );
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
}