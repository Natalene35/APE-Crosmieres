import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://apecrosmieres.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',

    },
    timeout: 10000

})

export default {

    // delete user by himself with his id
    async deleteMyUserAccount(params) {
        console.log(params);
        try {
            apiClient.defaults.headers.common['Content-Type'] = "application/json";
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const response = await apiClient.delete("/user", params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
}