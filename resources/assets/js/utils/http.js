// axios instance
import axios from 'axios'

const instance = axios.create({
    // change this url to your api
    baseURL: '//localhost:8000/',
})

export default instance