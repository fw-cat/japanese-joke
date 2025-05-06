import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

// Change this to your Laravel API URL
const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000'

const apiClient = axios.create({
  baseURL: apiBaseUrl,
  headers: {
    'Referrer-Policy': 'strict-origin-when-cross-origin',
    'Accept': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
  withCredentials: true
})

apiClient.interceptors.request.use(async (config: any) => {
 
  const requestMethod = config.method.toUpperCase()
  if (requestMethod === 'POST' || requestMethod === 'PUT' || requestMethod === 'DELETE') {
    try {
      const response = await axios.get(`${apiBaseUrl}/sanctum/csrf-cookie`, {
        withCredentials: true,
        headers: {
          'Referrer-Policy': 'strict-origin-when-cross-origin',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      // Extract the XSRF-TOKEN from cookies
      const xsrfToken = response.headers['x-xsrf-token'] ||
                        response.headers['X-XSRF-TOKEN'] ||
                        document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN='))?.split('=')[1]


      if (xsrfToken) {
        // Add the XSRF-TOKEN to the request headers
        config.headers['X-XSRF-TOKEN'] = xsrfToken
      }

      // POST時のみ
      // if(requestMethod === 'POST') {
      //   config.headers['Content-Type'] = 'multipart/form-data';
      // }
  
    } catch (csrfError) {
      console.error('CSRF cookie fetch failed', csrfError)
    }
  }
  return config

}, (error) => {
  return Promise.reject(error);
});

// Response interceptor for handling authentication errors
apiClient.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    if (error.response) {
      switch (error.response.status) {
        case 401:
        case 419:
          // Redirect to login on unauthorized or expired token
          console.log('Unauthorized or token expired', error);
          break;
        default:
          console.log('API error', error);
      }
    } else if (error.request) {
      console.error('No response received', error.request);
    } else {
      console.error('Error setting up request', error.message);
    }
    return Promise.reject(error);
  }
);

export default apiClient