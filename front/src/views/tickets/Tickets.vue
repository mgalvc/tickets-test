<template>
    <v-container fluid>
        <v-btn color="success" @click="newTicket">
            <v-icon>mdi-plus</v-icon> Abrir Ticket
        </v-btn>
        <v-btn class="ml-2" color="primary" @click="load">
            <v-icon>mdi-reload</v-icon>
        </v-btn>

        <v-row>
            <v-col v-for="ticket in tickets" :key="ticket.id" cols="12" md="4">
                <ticket-card
                    :ticket="ticket"
                    @editTicket="editTicket"
                    @removeTicket="removeTicket"
                ></ticket-card>
            </v-col>
        </v-row>

        <v-dialog v-model="newTicketDialog" max-width="800" persistent>
            <v-card>
                <v-card-title>Abrir Ticket</v-card-title>
                <v-card-text>
                    <v-text-field
                        label="Título"
                        v-model="ticketData.title"
                    ></v-text-field>
                    <v-textarea
                        label="Descrição"
                        v-model="ticketData.description"
                        auto-grow
                        outlined
                    ></v-textarea>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="success" @click="saveTicket" :disabled="invalid">Salvar</v-btn>
                    <v-btn @click="closeNewTicket">Cancelar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>    
</template>

<script>
import { mapGetters } from 'vuex'
import TicketCard from '@/views/tickets/TicketCard'

export default {
    components: {
        TicketCard
    },
    data() {
        return {
            newTicketDialog: false,
            ticketData: {
                title: '',
                description: ''
            },
            action: 'new'
        }
    },
    computed: {
        ...mapGetters(['tickets']),
        invalid() {
            return !this.ticketData.title.trim() || !this.ticketData.description.trim();
        }
    },
    methods: {
        load() {
            this.$store.dispatch('loadTickets');
        },
        newTicket() {
            this.newTicketDialog = true;
        },
        closeNewTicket() {
            this.ticketData = {
                title: '',
                description: ''
            };
            this.newTicketDialog = false;
            this.action = 'new';
        },
        saveTicket() {
            if(this.action === 'new')
                this.$store.dispatch('saveTicket', this.ticketData);
            else
                this.$store.dispatch('editTicket', this.ticketData);

            this.closeNewTicket();
        },
        editTicket(ticket) {
            this.ticketData = ticket;
            this.newTicket();
            this.action = 'edit';
        },
        removeTicket(id) {
            this.$store.dispatch('removeTicket', id);
        }
    },
    mounted() {
        this.load();
    }
    
}
</script>

<style scoped>

</style>