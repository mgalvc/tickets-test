import Ticket from "../../services/Ticket"

export const ticketActions = {
    loadTickets({ commit }) {
        let ticketsService = new Ticket();
        ticketsService.fetch(response => {
            commit('loadTickets', response);
        });
    },
    solveTicket({ dispatch }, id) {
        let ticketsService = new Ticket();
        ticketsService.solve(id, response => {
            if(response.success) {
                dispatch('loadTickets');
            }
        });
    },
    saveTicket({ dispatch, getters }, ticket) {
        ticket.user_id = getters.user.id;
        let ticketsService = new Ticket();
        ticketsService.save(ticket, response => {
            if(response.success) {
                dispatch('loadTickets');
            }
        })
    },
    editTicket({ dispatch }, ticket) {
        let ticketsService = new Ticket();
        ticketsService.edit(ticket, response => {
            if(response.success) {
                dispatch('loadTickets');
            }
        })
    },
    removeTicket({ dispatch }, id) {
        let ticketsService = new Ticket();
        ticketsService.remove(id, response => {
            if(response.success) {
                dispatch('loadTickets');
            }
        })
    }
}