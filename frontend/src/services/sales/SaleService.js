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
    async findAllSales() {
        try {
            const response = await apiClient.post('/wp/v2/sale');
            return response.data

        } catch (errors) {
            return errors.response.data
        }
    }
}