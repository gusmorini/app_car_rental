import axios from "axios";
import token from "./token";

// instance axios
const api = axios.create({
    baseURL: "/api/v1",
    timeout: 10000,
    headers: {
        Accept: "application/json",
        Authorization: token.getToken(),
    },
});

const verifyToken = ({ data, status }) => {
    if (status == 401 && data.message.toLowerCase() == "token has expired") {
        // refresh token
        api.post("/refresh")
            .then(({ data }) => {
                console.log(data);
                if (data.token) {
                    // salva o token nos cookies
                    token.saveToken(data.token);
                    // refaz a requisição anterior
                    window.location.reload();
                }
            })
            .catch((e) => console.log(e));
    }
};

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
        // verifica token
        verifyToken(error.response);
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        return Promise.reject(error);
    }
);

export default api;
