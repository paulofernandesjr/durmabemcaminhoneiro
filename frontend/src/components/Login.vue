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
    return {}
  }
}
</script>
