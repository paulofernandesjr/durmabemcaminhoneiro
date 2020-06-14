<template>
  <div class="">
    <q-card class="q-my-lg q-pa-md">
      <h6 class="q-mt-none q-mb-lg">Use uma conta para reservar!</h6>
      <div class="q-gutter-md q-mb-lg">
        <q-input filled label="Celular" stack-label />
        <q-input filled label="CPF" stack-label />
        <q-input filled label="Nome" stack-label />
        <q-input filled label="Senha" type="password" stack-label />
        <q-input filled label="Confirmar Senha" type="password" stack-label />
        <q-btn label="Entrar/Cadastrar" color="primary" />
      </div>
      <q-btn label="Criar nova conta" />
      <q-btn label="Esqueci minha senha" flat />

    </q-card>
    Login<br/>
    TODO: chamada de login e salvar token<br/>
    TODO: separar interfaces conforme acao: login, cadastro, lembrete<br/>
  </div>
</template>

<script>
export default {
  // name: 'ComponentName',
  data () {
    return {
      cpf: null,
      senha: null,
      client_id: '90ccb958-aa43-4c1b-9181-4f7f110f04f8',
      client_secret: 'WSoX61q4Dt7EuXhyzAex5LTFra6tgqzNSjBo2NKR',
      grant_type: 'password',
      token: null,
      motorista: null
    }
  },
  methods: {
    async logar () {
      var config = {
        headers: { Accept: '*/*' }
      }

      this.token = await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/oauth/token', {
        client_id: this.client_id,
        client_secret: this.client_secret,
        grant_type: this.grant_type,
        username: this.cpf,
        password: this.senha
      }, config).then((response) => {
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

      this.motorista = await this.$axios.get('https://api.durmabemcaminhoneiro.com.br/api/motorista', config)
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
