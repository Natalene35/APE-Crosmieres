import axios from 'axios';

const apiClient = axios.create({
    baseURL: `http://ape.local/wp-json`,
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
}