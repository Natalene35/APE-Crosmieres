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

    },

    // to upload a file
    upload(file, title, postId) {

        apiClient.defaults.headers.common['Content-Type'] = "multipart/form-data";
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';

        let formData = new FormData();
        formData.append("title", 'sale-' + title);
        formData.append("file", file);
        formData.append("post", postId);

        return apiClient.post("/media", formData);
    },

    // to verify if files to upload exist
    getFiles() {
        return apiClient.get("/media");
    },


    // create an sale
    async addSale(param) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        apiClient.defaults.headers.common['Content-Type'] = "application/json";

        try {
            const response = await apiClient.post('/sale', param);
            return response
        } catch (errors) {
            return errors.response
        }
    },


    // to link media feature to an event
    async addMediaToSale(postId, mediaId) {

        apiClient.defaults.headers.common['Content-Type'] = "image/*";
        apiClient.defaults.headers.common['Content-Disposition'] = "attachment";

        try {
            const response = await apiClient.post('/sale/' + postId, {
                featured_media: mediaId
            });
            return response
        } catch (errors) {
            return errors.response
        }
    },
}