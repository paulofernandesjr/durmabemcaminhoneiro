<template>
  <div class="">
    <q-card class="q-pa-md">
      <h6 class="q-mt-none q-mb-lg">Use uma conta para reservar!</h6>
      <div class="q-gutter-md q-mb-lg">
        <q-input type="tel" filled autofocus v-model.trim="cpf" mask="###.###.###-##" label="CPF" stack-label :error="$v.cpf.$error" />
        <q-input filled v-model.trim="nome" label="Nome" stack-label v-if="modo === 'cadastro'" :error="$v.nome.$error" />
        <q-input type="tel" filled v-model.trim="celular" mask="(##) #####-####" label="Celular" stack-label v-if="modo === 'cadastro'" :error="$v.celular.$error" />
        <q-input filled v-model.trim="senha" label="Senha" type="password" stack-label :error="$v.senha.$error" />
        <q-input filled v-model.trim="confirmarSenha" label="Confirmar Senha" type="password" stack-label v-if="modo === 'cadastro'" :error="$v.confirmarSenha.$error" />
        <div class="text-right">
          <q-btn @click="submit" :label="modo === 'login' ? 'Entrar' : 'Cadastrar'" color="primary" />
        </div>
      </div>
      <q-btn v-if="!hideCadastro" flat class="full-width" @click="toggleModo" :label="modo === 'login' ? 'nova conta' : 'Usar conta existente'" />
    </q-card>
    <!-- Login<br/>
    TODO: chamada de login e salvar token<br/>
    TODO: separar interfaces conforme acao: login, cadastro, lembrete<br/> -->
  </div>
</template>

<script>
import { required, requiredIf, sameAs, minLength } from 'vuelidate/lib/validators'
import { validaCpf } from '../utils/validaCpf'

export default {
  name: 'Login',
  props: ['token', 'hideCadastro'],
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
      motorista: null
    }
  },
  validations: {
    cpf: {
      required, // TODO: validar CPF
      validaCpf
    },
    celular: {
      required: requiredIf(nM => nM.modo === 'cadastro'),
      formatoCelular (numero) {
        if (numero) {
          return numero.length === 15
        }
        return true
      }
    },
    nome: {
      required: requiredIf(nM => nM.modo === 'cadastro')
    },
    senha: {
      required,
      minLength: minLength(8)
    },
    confirmarSenha: {
      required: requiredIf(nM => nM.modo === 'cadastro'),
      sameAsPassword: sameAs('senha')
    }
  },
  methods: {
    toggleModo () {
      this.$v.$reset()
      this.modo = this.modo === 'login' ? 'cadastro' : 'login'
      this.cpf = null
      this.nome = null
      this.celular = null
      this.senha = null
      this.confirmarSenha = null
    },
    submit () {
      switch (this.modo) {
        case 'login':
          this.confirmarSenha = this.senha
          break
      }
      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log('ERRO!!!', this.$v)
        return
      }
      console.log('FOI!')
      switch (this.modo) {
        case 'login':
          this.confirmarSenha = this.senha
          this.logar()
          break
        case 'cadastro':
          this.cadastrar()
          break
      }
    },
    async logar () {
      var config = {
        headers: {
          Accept: '*/*',
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }
      var bodyFormData = new FormData()
      bodyFormData.set('client_id', this.client_id)
      bodyFormData.set('client_secret', this.client_secret)
      bodyFormData.set('grant_type', this.grant_type)
      bodyFormData.set('username', this.cpf)
      bodyFormData.set('password', this.senha)
      console.log('bodyFormData', bodyFormData)

      await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/oauth/token', bodyFormData, config).then((response) => {
        console.log('RESPOSTA LOGIN', response)
        this.$root.$emit('updateUser', response.data || {})
        this.$root.$emit('hideDialogLogin', {})
        return response || {}
      }).catch(() => {
        this.$root.$emit('updateUser', {})
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'Erro ao autenticar',
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
          const errsString = Object.keys(err.response.data.errors).map(e => err.response.data.errors[e].join()).join()
          this.$q.notify({
            color: 'negative',
            position: 'top',
            message: 'Erro ao encontrar motorista logado ' + errsString,
            icon: 'report_problem'
          })
        })
    },
    async cadastrar () {
      await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/api/registrar', {
        nome: this.nome,
        celular: this.celular,
        cpf: this.cpf,
        senha: this.senha
      }).then(() => {
        this.logar()
      }).catch((err) => {
        this.$root.$emit('updateUser', {})
        const errsString = Object.keys(err.response.data.errors).map(e => err.response.data.errors[e].join()).join()
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'Erro ao cadastrar ' + errsString,
          icon: 'report_problem'
        })
      })
    }
  }
}
</script>
