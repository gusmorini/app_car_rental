import axios from "axios";
/**
 * função analiza os cookies e procura por token=
 * caso encontre monta o Bearer token completo
 */
const getToken = () => {
    let token = false;
    document.cookie.split(";").forEach((value) => {
        if (value.includes("token=")) {
            token = "Bearer " + value.split("=")[1];
        }
    });
    return token;
};

/**
 * configuração base do axios
 */
const config = {
    baseURL: "/api/v1",
    timeout: 10000,
    headers: {
        Accept: "application/json",
        Authorization: getToken(),
    },
};

// instance axios
const api = axios.create(config);

/**
 * interceptando request instancia do axios
 */
api.interceptors.request.use(
    function (config) {
        // Do something before request is sent
        return config;
    },
    function (error) {
        // Do something with request error
        return Promise.reject(error);
    }
);

/**
 * interceptando response instancia do axios
 */
api.interceptors.response.use(
    function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        return response;
    },
    function (error) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        return Promise.reject(error);
    }
);

export default api;
