// axios
import axios from 'axios'

const baseURL = window.location.origin+'/api'
axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('accessToken')
export default axios.create({
  baseURL,

  // You can add your headers here
})
