import axios from 'axios'

// Change this to your Laravel API URL
const apiBaseUrl = 'http://localhost:8000/api'

const apiClient = axios.create({
  baseURL: apiBaseUrl,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  withCredentials: true
})

export default apiClient