export const authMutations = {
    login(state, user) {
        state.user = user;
    },
    logout(state) {
        state.user = {};
        state.tickets = [];
    }
    
}