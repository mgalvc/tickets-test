import Vue from 'vue'
import Vuex from 'vuex'
import { authActions } from './actions/authActions'
import { authMutations } from './mutations/authMutations'
import { ticketActions } from './actions/ticketActions'
import { ticketMutations } from './mutations/ticketMutations'
import { userActions } from './actions/userActions'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: {},
        token: '',
        tickets: []
    },
    getters: {
        tickets: state => {
            return state.tickets;
        },
        user: state => {
            return state.user;
        },
        token: state => {
            return state.token;
        },
        userPublicName: state => {
            return state.user.hasOwnProperty('public_name') ? state.user.public_name : '';
        }
    },
    mutations: {
        ...authMutations,
        ...ticketMutations
    },
    actions: {
        ...authActions,
        ...ticketActions,
        ...userActions
    },
    plugins: [createPersistedState()]
})
