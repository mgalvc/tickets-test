<template>
    <v-container fluid>
        <v-row
            align="center"
            justify="center"
            class="mt-12"
        >
            <v-col
                cols="12"
                sm="6"
                md="4"
            >
                <v-card>
                    <v-card-text>
                        <p class="headline text--primary form-width mx-auto mt-5 mb-5">Tickets OS</p>
                        <v-form class="mx-auto form-width">
                            <v-text-field
                                v-model="data.login"
                                label="Usuário"
                                required
                            >
                            </v-text-field>
                            <v-text-field
                                v-model="data.password"
                                label="Senha"
                                required
                                type="password"
                            >
                            </v-text-field>
                        </v-form>    
                    </v-card-text>
                    <v-card-actions>
                        <div class="mx-auto form-width">
                            <v-btn @click="login" class="mb-2" block color="info">Entrar</v-btn>
                            <v-btn @click="register" class="mb-10" block color="info" outlined>Criar conta</v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            data: {
                login: '',
                password: ''
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('login', this.data);
        },
        register() {
            this.$router.push('/register');
        }
    }
}
</script>

<style scoped>
    .form-width {
        width: 80%;
    }
</style>