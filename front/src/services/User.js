import API from "./API";


export default class User extends API {
    constructor(id) {
        super('users');

        this.id = id;
    }

    fetch(callback) {
        this.GET({ id: this.id }, 
            response => {
                this.login = response[0].login;
                this.public_name = response[0].public_name;
                callback(this);
            },
            error => {
                console.log(error);
            }
        );
    }

    register(data, callback) {
       this.POST(data,
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        ); 
    }
}