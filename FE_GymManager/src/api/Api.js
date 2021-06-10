import axios from "axios";
let token = window.localStorage.getItem('token');
const Api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
     headers: { Authorization: `Bearer ${token}`}
        
});

export default Api;