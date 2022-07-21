import axios from "axios";

const apiClient = axios.create({
    baseURL: `http://apecrosmieres.local/wp-json/wp/v2`,
    headers: {
        "Content-Type": "multipart/form-data",
        Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGVjcm9zbWllcmVzLmxvY2FsIiwiaWF0IjoxNjU4Mzk0MjU3LCJuYmYiOjE2NTgzOTQyNTcsImV4cCI6MTY1ODk5OTA1NywiZGF0YSI6eyJ1c2VyIjp7ImlkIjoxLCJkZXZpY2UiOiIiLCJwYXNzIjoiNTNiODQ4NDkzOTA5MDE1YmNjOGFhNDVmNzJhMmRiMDcifX19.4ywPovVHcd5ZEoqBvM15tNjiM3hXyLrqUnePAXHc2j8'

    },
    timeout: 10000
})

// class UploadFilesService {
export default {

    title: '',

    upload(file, firstname, lastname, onUploadProgress) {
        let formData = new FormData();
        formData.append("file", file);
        this.title = 'profile-' + firstname + '-' + lastname;
        formData.append("title", this.title);
        console.log(this.title);
        console.log(formData);

        return apiClient.post("/media", formData, {
            onUploadProgress
        });
    },

    getFiles() {
        return apiClient.get("/media");
    },


    async addEvent(param) {
        try {
            const response = await apiClient.post('/event', param);
            return response.data
        } catch (errors) {
            return errors.response.data
        }
    },
}
// }
// export default new UploadFilesService();