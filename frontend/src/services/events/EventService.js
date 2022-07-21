import axios from "axios";

const apiClient = axios.create({
    baseURL: `http://apecrosmieres.local/wp-json/wp/v2`,
    headers: {
        Accept: 'application/json, image/jpeg',
        Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGVjcm9zbWllcmVzLmxvY2FsIiwiaWF0IjoxNjU4Mzk0MjU3LCJuYmYiOjE2NTgzOTQyNTcsImV4cCI6MTY1ODk5OTA1NywiZGF0YSI6eyJ1c2VyIjp7ImlkIjoxLCJkZXZpY2UiOiIiLCJwYXNzIjoiNTNiODQ4NDkzOTA5MDE1YmNjOGFhNDVmNzJhMmRiMDcifX19.4ywPovVHcd5ZEoqBvM15tNjiM3hXyLrqUnePAXHc2j8'

    },
    timeout: 10000
})

// class UploadFilesService {
export default {


    upload(file, title, postId,onUploadProgress) {

        apiClient.defaults.headers.common['Content-Type'] = "multipart/form-data";

        let formData = new FormData();
        formData.append("file", file);
        this.title = 'event-' + title;
        formData.append("title", this.title);
        formData.append("post", postId);
        console.log(this.title);
        console.log(postId);
        console.log(formData);

        return apiClient.post("/media", formData, {
            onUploadProgress
        });
    },

    getFiles() {
        return apiClient.get("/media");
    },


    async addEvent(param) {

        apiClient.defaults.headers.common['Content-Type'] = "application/json";

        try {
            const response = await apiClient.post('/event', param);
            return response
        } catch (errors) {
            return errors.response
        }
    },

    async addMediaToEvent(postId, param) {

        apiClient.defaults.headers.common['Content-Type'] = "image/*";

        try {
            const response = await apiClient.post('/event/' + postId, param);
            return response
        } catch (errors) {
            return errors.response
        }
    },
}
// }
// export default new UploadFilesService();