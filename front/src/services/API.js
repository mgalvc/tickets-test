import Vue from 'vue';
import router from '@/router';

export default class API {
    constructor(resource) {
        this.url = `index.php?r=${resource}`;
    }

    POST(body, successCallback, errorCallback) {
        Vue.http.post(this.url, body).then(
            response => {
                this.checkAuth(response.body);
                successCallback(response.body);
            },
            error => {
                errorCallback(error);
            }
        );        
    }

    GET(params, successCallback, errorCallback) {
        Vue.http.get(this.url, { params: params }).then(
            response => {
                this.checkAuth(response.body);
                successCallback(response.body);
            },
            error => {
                errorCallback(error);
            }
        );
    }

    PUT(body, successCallback, errorCallback) {
        Vue.http.put(this.url, body).then(
            response => {
                this.checkAuth(response.body);
                successCallback(response.body);
            },
            error => {
                errorCallback(error);
            }
        );
    }

    DELETE(body, successCallback, errorCallback) {
        Vue.http.delete(this.url, { body: body }).then(
            response => {
                this.checkAuth(response.body);
                successCallback(response.body);
            },
            error => {
                errorCallback(error);
            }
        );
    }

    checkAuth(data) {
        if(!data.success && data.error === 'unauthenticated') {
            router.push('/login');
        }
    }
}