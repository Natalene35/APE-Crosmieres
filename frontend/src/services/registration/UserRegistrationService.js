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
    async register(params) {
        try {
            const response = await apiClient.post('/wp/v2/users/register', params);
            return response.data
        } catch (errors) {
            return errors.response.data
        }
    },

     async delete(id) {
          apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.delete('/wp/v2/users/' + id + '?reassign=1&force=true');
            return response.data;
        } catch(error) {
            return error.response.data
        }
        
    },
}