import Auth from "../../services/Auth"
import Vue from 'vue';
import router from '@/router'
import User from "../../services/User";

export const authActions = {
    login({ commit }, data) {
        let auth = Auth.create(data);
        auth.run(response => {
            if(response.success) {
                Vue.http.headers.common['Authorization'] = `Basic ${response.auth.token}`;
                let user = new User(response.auth.user_id);
                user.fetch(user => {
                    commit('login', user);
                    router.push('/tickets');
                });
            }
        });
    },
    register({ dispatch }, data) {
        let user = new User();
        return new Promise((resolve) => {
            user.register(data, response => {
                if(response.success) {
                    dispatch('login', data);
                } 
                resolve(response);
            });
        });
    },
    logout({ commit }) {
        let authService = new Auth();
        let token = Vue.http.headers.common['Authorization'].split(" ")[1];
        authService.logout(token, response => {
            if(response.success) {
                commit('logout');
                router.push('/login');
            }
        });
    }
}