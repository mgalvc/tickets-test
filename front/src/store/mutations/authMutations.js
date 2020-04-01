export const authMutations = {
    login(state, data) {
        state.user = data.user;
        state.token = data.token;
    },
    logout(state) {
        state.user = {};
        state.tickets = [];
        state.token = '';
    }
    
}