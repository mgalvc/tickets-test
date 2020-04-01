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
                        <p class="headline text--primary form-width mx-auto mt-5 mb-5">Insira os seus dados</p>
                        <v-form class="mx-auto form-width">
                            <v-text-field
                                v-model="data.public_name"
                                label="Nome Público"
                            ></v-text-field>
                            <v-text-field
                                v-model="data.login"
                                label="Usuário"
                                :error="error.login != ''"
                                :error-messages="error.login"
                            ></v-text-field>
                            <v-text-field
                                v-model="data.password"
                                label="Senha"
                                required
                                type="password"
                            ></v-text-field>
                        </v-form>    
                    </v-card-text>
                    <v-card-actions>
                        <div class="mx-auto form-width">
                            <span :class="{ 'hidden' : !disabled }" class="caption info--text">Preencha todos os campos para continuar</span>
                            <v-btn :disabled="disabled" @click="register" class="mb-10" block color="info">Criar</v-btn>
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
                password: '',
                public_name: ''
            },
            error: {
                login: ''
            }
        }
    },
    computed: {
        disabled() {
            return !this.data.login || !this.data.password || !this.data.public_name;
        }
    },
    methods: {
        register() {
            this.$store.dispatch('register', this.data)
                .then(response => {
                    if(response.login === 'unavailable') {
                        console.log(`${this.data.login} is unavailable`);
                        this.error.login = "Este usuário já está em uso";
                    }
                });
        }
    }
    
}
</script>

<style scoped>
    .form-width {
        width: 80%;
    }

    .hidden {
        display: none;
    }
</style>