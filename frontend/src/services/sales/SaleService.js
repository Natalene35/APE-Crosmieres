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
            const response = await apiClient.get('/sale?_embed');
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
    // Get the list of all the events with their metadata
    async findImage() {
        try {
            const response = await apiClient.get('/sale');
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
    // Get an sale by his id
    async find(id) {
        try {
            const response = await apiClient.get("/sale/" + id + "");
            return response.data;
        } catch (error) {
            return error.response.data
        }

    },
    async findMeta(id) {
        try {
            const response = await apiClient.get("/sale/meta/" + id + "");
            return response.data;
        } catch (error) {
            return error.response.data
        }

    },
    async update(params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const response = await apiClient.post("/sale/"+ params.id+ "", params);
            return response.data;
        } catch(error) {
            return error.response.data
        }        
    },
    async create(params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const response = await apiClient.post("/sale", params);
            console.log("la response est "+response)
            return response.data;
        } catch(error) {
            return error.response.data
        }        
    },
    async delete(params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const response = await apiClient.delete("/sale/"+ params.id+ "");
            return response.data;
        } catch(error) {
            return error.response.data
        }        
    },
}