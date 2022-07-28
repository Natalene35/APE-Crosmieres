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
    async login(param) {
        try {
            const response = await apiClient.post('/jwt-auth/v1/token', param);
            return response.data

        } catch (errors) {
            return errors.response.data
        }
    },

    async getRoles(id) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
            const role = await apiClient.get('/wp/v2/users/' + id + '?context=edit');
            return role.data
        } catch (error) {
            return error.response.data
        }
    },

    async find(id) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.get("/wp/v2/users/" + id + "?context=edit" );
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
        
    async getMeta(id) {
         apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const meta = await apiClient.get('/wp/v2/users/meta/'+ id +'');
            return meta.data
        } catch(error) {
            return error.response.data
        } 
    },
    async findAll() {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.get("/wp/v2/users/?context=edit");
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },
    //GET META EXPLICATION WE NEED TO PLACE IN YOUR COMPONENTS

    // let arrayMeta= await UserLoginService.getMeta(index)
    // for (let index = 0; index < arrayMeta.length; index++) {
    //     const metaElmt = arrayMeta[index];
    //     //For take meta_key enter key in the exemple its "phone"
    //     if(metaElmt.meta_key=="phone"){
    //         console.log(metaElmt.meta_value)
    //     }
    // }
    
}