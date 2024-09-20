import axios from 'axios'

const createAuthAxios = async () => {
  const authAxios = axios.create({
    baseURL: `http://127.0.0.1:8000/api`,
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json',
    },
    withCredentials: true
  })

  // Get the CSRF token
  await authAxios.get('/sanctum/csrf-cookie')
    .then(response => {
      // Get the XSRF-TOKEN cookie
      const csrfToken = response.config.headers['X-XSRF-TOKEN']

      // Set the X-XSRF-TOKEN header on subsequent requests
      authAxios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken
    })
    .catch(error => {
      console.error(error)
    })

  return authAxios
}

export default createAuthAxios
