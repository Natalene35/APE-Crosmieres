import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://apecrosmieres.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    },
    timeout: 10000
});

export default {
    // Get the list of all the sales with their metadata
    async findAll() { 
        try {
            const response = await apiClient.get('/sale?_embed');
            return response.data;

        } catch (error) {
            return error.response.data;
        }
    },
    // Get a sale by his id
    async find(id) {
        try {
            const response = await apiClient.get("/sale/" + id + "?_embed");
            return response.data;
        } catch (error) {
            return error.response.data;
        }

    }
}