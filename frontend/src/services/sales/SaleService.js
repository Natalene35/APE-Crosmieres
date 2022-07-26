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
            const response = await apiClient.get('/sale');
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
    // Get an sale by his id
    async find(id) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.get("/sale/" + id + "?_embed");
            return response.data;
        } catch (error) {
            return error.response.data
        }

    },

    // Get meta value by sale's id
    async getMeta(id) {
        try {
            const meta = await apiClient.get('/wp/v2/sale/meta/'+ id +'');
            return meta.data
        } catch(error) {
            return error.response.data
        } 
    },

    // to upload a file
    upload(file, title, postId, onUploadProgress) {

        apiClient.defaults.headers.common['Content-Type'] = "multipart/form-data";
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';



        let formData = new FormData();
        formData.append("title", 'sale-' + title);
        formData.append("file", file);
        formData.append("post", postId);

        return apiClient.post("/media", formData,
            onUploadProgress
        );
    },

    // to verify if files to upload exist
    getFiles() {

        return apiClient.get("/media");
    },


    // create an sale
    async addSale(param) {

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