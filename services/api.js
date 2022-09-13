import axios from 'axios'
/**
 * função analiza os cookies e procura por token=
 * caso encontre monta o Bearer token completo
 */
const getToken = () => {
  let token = false;
  document.cookie.split(';').forEach(value => {
    if (value.includes('token=')) {
      token = 'Bearer ' + value.split('=')[1];
    }
  });
  return token;
}

/**
 * configuração base do axios
 */
const config = {
  baseURL: 'http://127.0.0.1:8000/api/v1',
  timeout: 5000,
  headers: {
      'Accept': 'application/json',
      'Authorization': getToken(),
  }
}

export default axios.create(config);