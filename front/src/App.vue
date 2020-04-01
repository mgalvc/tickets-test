<template>
  <v-app>
    <v-navigation-drawer
      absolute
      permanent
      color="primary"
      dark
      width="200"
      :class="{ 'hidden': auth }"
    >
      <v-list nav>
        <v-list-item>
            <v-list-item-content>
                <v-list-item-title>Ticket OS</v-list-item-title>
                <v-list-item-subtitle>Olá, {{userPublicName}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item to='/tickets'>
          <v-list-item-icon>
            <v-icon>mdi-face-agent</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Tickets</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="logoutConfirm = true">
          <v-list-item-icon>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Sair</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-content :class="{ 'content': !auth }">
      <router-view></router-view>
    </v-content>

    <v-dialog v-model="logoutConfirm" max-width="300">
        <v-card>
            <v-card-title>Logout</v-card-title>
            <v-card-text>Deseja realmente sair, {{userPublicName}}?</v-card-text>
            <v-card-actions>
                <v-btn @click="logout" color="success">Sim</v-btn>
                <v-btn @click="logoutConfirm = false">Não</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "App",
  data: () => ({
      logoutConfirm: false
  }),
  computed: {
    ...mapGetters(['userPublicName']),
    auth() {
      return this.$route.name === "Login" || this.$route.name === "Register";
    }
  },
  methods: {
      logout() {
          this.$store.dispatch('logout');
          this.logoutConfirm = false;
      }
  }
};
</script>

<style scoped>
.content {
  margin-left: 200px;
}
.hidden {
  display: none;
}
</style>
