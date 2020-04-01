import API from "./API";

export default class Auth extends API {
    constructor(data) {
        super('auth');

        if(data) {
            this.login = data.login;
            this.password = data.password;
        }
    }
    
    static create(data) {
        return new Auth(data);
    }
    
    run(callback) {
        this.POST({ login: this.login, password: this.password },
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }

    logout(token, callback) {
        this.DELETE({ token: token },
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }
}