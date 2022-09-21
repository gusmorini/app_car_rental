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
 * função que salva o token nos cookies
 */
const saveToken = (token) => {
    document.cookie = `token=${token};SameSite=Lax`;
};

export default { getToken, saveToken };
