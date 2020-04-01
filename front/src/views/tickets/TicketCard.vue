<template>
    <div>
        <v-card link hover @click="openDetails">
            <v-card-title>
                <span class="ticket-card-title text-truncate">{{ticket.title}}</span>
                <v-spacer></v-spacer>
                <v-chip small label class="" :color="status.color">{{status.text}}</v-chip>
            </v-card-title>
            <v-card-subtitle>
                Aberto por <span class="font-weight-bold">{{ticket.user_public_name}}</span> em <span class="font-weight-bold">{{created_at}}</span>
            </v-card-subtitle>
            <v-card-text class="text-truncate">{{ticket.description}}</v-card-text>
        </v-card>   

        <v-dialog v-model="details" max-width="800">
            <v-card>
                <v-card-title class="headline">
                    <span class="ticket-dialog-title text-truncate">{{ticket.title}}</span>
                    <v-spacer></v-spacer>
                    <v-chip label class="ml-2" :color="status.color">{{status.text}}</v-chip>
                </v-card-title>
                <v-card-subtitle style="margin-top: -10px">
                    Aberto por <span class="font-weight-bold">{{ticket.user_public_name}}</span> em <span class="font-weight-bold">{{created_at}}</span>
                </v-card-subtitle>
                <v-card-text class="body-1">
                    {{ticket.description}}
                </v-card-text>
                <v-card-actions>
                    <v-btn v-if="ticket.status === 'open'" @click="solve" small color="success">
                        <v-icon class="mr-1">mdi-check</v-icon>
                        Marcar como Resolvido
                    </v-btn>
                    <v-btn v-if="ticket.status === 'open'" @click="edit" small color="primary">
                        <v-icon class="mr-1">mdi-pencil</v-icon>
                        Editar
                    </v-btn>
                    <v-btn @click="remove" small color="error">
                        <v-icon class="mr-1">mdi-delete</v-icon>
                        Apagar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
const moment = require('moment');

export default {
    props: ['ticket'],
    data() {
        return {
            details: false
        }
    },
    computed: {
        status() {
            return {
                text: this.ticket.status === 'open' ? 'Em Aberto' : 'Resolvido',
                color: this.ticket.status === 'open' ? 'warning' : 'success'
            }
        },
        created_at() {
            return moment(this.ticket.created_at).format("DD/MM/YYYY HH:mm");
        }
    },
    methods: {
        openDetails() {
            this.details = true;
        },
        closeDetails() {
            this.details = false;
        },
        solve() {
            this.$store.dispatch('solveTicket', this.ticket.id);
            this.closeDetails();
        },
        edit() {
            this.$emit('editTicket', this.ticket);
            this.closeDetails();
        },
        remove() {
            this.$emit('removeTicket', this.ticket.id);
            this.closeDetails();
        }
    }
}
</script>

<style scoped>
    .ticket-card-title {
        width: calc(100% - 90px);
    }
    .ticket-dialog-title {
        width: calc(100% - 110px);
    }
</style>