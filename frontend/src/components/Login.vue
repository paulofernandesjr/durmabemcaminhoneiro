<template>
  <div class="">
    <q-card class="q-pa-md">
      <h6 class="q-mt-none q-mb-lg">Use uma conta para reservar!</h6>
      <div class="q-gutter-md q-mb-lg">
        <q-input filled v-model.trim="cpf" label="CPF" stack-label />
        <q-input filled v-model.trim="nome" label="Nome" stack-label v-if="modo === 'cadastro'" />
        <q-input filled v-model.trim="celular" label="Celular" stack-label v-if="modo === 'cadastro'" />
        <q-input filled v-model.trim="senha" label="Senha" type="password" stack-label />
        <q-input filled v-model.trim="confirmarSenha" label="Confirmar Senha" type="password" stack-label v-if="modo === 'cadastro'" />
        <div class="text-right">
          <q-btn :label="modo === 'login' ? 'Entrar' : 'Cadastrar'" color="primary" />
        </div>
      </div>
      <q-btn flat class="full-width" @click="toggleModo" :label="modo === 'login' ? 'nova conta' : 'Usar conta existente'" />
    </q-card>
    <!-- Login<br/>
    TODO: chamada de login e salvar token<br/>
    TODO: separar interfaces conforme acao: login, cadastro, lembrete<br/> -->
  </div>
</template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      modo: 'login',
      cpf: null,
      celular: null,
      nome: null,
      senha: null,
      confirmarSenha: null,
      client_id: '90ccb958-aa43-4c1b-9181-4f7f110f04f8',
      client_secret: 'WSoX61q4Dt7EuXhyzAex5LTFra6tgqzNSjBo2NKR',
      grant_type: 'password',
      token: null,
      motorista: null
    }
  },
  methods: {
    toggleModo () {
      this.modo = this.modo === 'login' ? 'cadastro' : 'login'
    },
    async logar () {
      var config = {
        headers: { Accept: '*/*' }
      }

      this.token = await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/oauth/token', { headers: config }, {
        client_id: this.client_id,
        client_secret: this.client_secret,
        grant_type: this.grant_type,
        username: this.cpf,
        password: this.senha
      }).then((response) => {
        return response || []
      }).catch((err) => {
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'Erro ao autenticar ' + err,
          icon: 'report_problem'
        })
      })
    },
    async carregarMotorista () {
      var config = {
        headers: { Authorization: 'Bearer ' + this.token.access_token }
      }

      this.motorista = await this.$axios.get('https://api.durmabemcaminhoneiro.com.br/api/motorista', { headers: config })
        .then((response) => {
          return response || {}
        }).catch((err) => {
          this.$q.notify({
            color: 'negative',
            position: 'top',
            message: 'Erro ao encontrar motorista logado ' + err,
            icon: 'report_problem'
          })
        })
    },
    async cadastrar () {
      await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/api/registrar', {
        nome: null,
        celular: null,
        cpf: null,
        senha: null
      }).catch((err) => {
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'Erro ao cadastrar ' + err,
          icon: 'report_problem'
        })
      })
    }
  }
}
</script>
