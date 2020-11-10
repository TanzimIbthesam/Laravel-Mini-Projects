export function isLoggedIn() {
    return localStorage.getItem("isLoggedIn")==='true';

}
export function logIn() {
    return localStorage.getItem("isLoggedIn",true);

}
export function logOut() {
    return localStorage.getItem("isLoggedIn",false);

}
