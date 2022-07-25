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
    // Get the list of all the events with their metadata
    async findAll() {
        try {
            const response = await apiClient.get('/sale');
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
    // Get an event by his id
    async find(id) {
        try {
            const response = await apiClient.get("/sale/" + id + "?_embed");
            return response.data;
        } catch (error) {
            return error.response.data
        }

    }
}