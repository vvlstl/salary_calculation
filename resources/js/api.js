import axios from "axios";
import router from '@/routes';

const API = axios.create();

API.interceptors.request.use(
    config => {
        if (localStorage.getItem('access_token')) {
            config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
        }
        return config},

    error => {})

API.interceptors.response.use(
    config => {
        if (localStorage.getItem('access_token')) {
            config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
        }
        return config},

    error => {
        if (error.response.status===401){
            router.push({name: 'login.page'})
        }
    })

export default API
