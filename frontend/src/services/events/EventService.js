import axios from "axios";

const apiClient = axios.create({
    baseURL: `http://apecrosmieres.local/wp-json/wp/v2`,
    headers: {
        Accept: 'application/json',
        Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGVjcm9zbWllcmVzLmxvY2FsIiwiaWF0IjoxNjU4NDMyODA5LCJuYmYiOjE2NTg0MzI4MDksImV4cCI6MTY1OTAzNzYwOSwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoxLCJkZXZpY2UiOiIiLCJwYXNzIjoiNTNiODQ4NDkzOTA5MDE1YmNjOGFhNDVmNzJhMmRiMDcifX19.N5ghA1L6DlwcQl1L7eDijKlb2p4gOyiZhtOeFf-cSq8'

    },
    timeout: 10000
})

export default {

    // to upload a file
    upload(file, title, postId, onUploadProgress) {

        apiClient.defaults.headers.common['Content-Type'] = "multipart/form-data";

        let formData = new FormData();
        formData.append("title", 'event-' + title);
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


    // create an event
    async addEvent(param) {

        apiClient.defaults.headers.common['Content-Type'] = "application/json";

        try {
            const response = await apiClient.post('/event', param);
            return response
        } catch (errors) {
            return errors.response
        }
    },


    // to link media feature to an event
    async addMediaToEvent(postId, mediaId) {

        apiClient.defaults.headers.common['Content-Type'] = "image/*";
        apiClient.defaults.headers.common['Content-Disposition'] = "attachment";

        try {
            const response = await apiClient.post('/event/' + postId, {
                featured_media: mediaId
            });
            return response
        } catch (errors) {
            return errors.response
        }
    },

    // to view an event
    async readEvent(postId, param) {
        console.log(postId, param);
        apiClient.defaults.headers.common['Content-Type'] = "application/json";
        try {
            const response = await apiClient.post('/event/' + postId, param);
            return response
        } catch (errors) {
            return errors.response
        }
    },
}