import API from "./API";

export default class Ticket extends API {
    constructor() {
        super('tickets');
    }

    fetch(callback) {
        this.GET({},
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            } 
        );
    }

    solve(id, callback) {
        this.PUT({id: id, data: { status: "solved" }},
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }

    save(ticket, callback) {
        this.POST(ticket,
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }

    edit(ticket, callback) {
        this.PUT({id: ticket.id, data: { title: ticket.title, description: ticket.description }},
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }

    remove(id, callback) {
        this.DELETE({id: id},
            response => {
                callback(response);
            },
            error => {
                console.log(error);
            }
        );
    }
}