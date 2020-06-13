<template>
  <q-layout view="lHh Lpr lFf" class="base">
    <q-header >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Durma Bem Caminhoneiro
        </q-toolbar-title>

        <div>v 0.1</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          Links do Projeto
        </q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <div class="bg"></div>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink'

export default {
  name: 'MainLayout',

  components: {
    EssentialLink
  },

  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: [
        {
          title: 'Página Inicial',
          caption: 'Voltar para Home',
          icon: 'home',
          link: '/',
          target: ''
        },
        {
          title: 'Sobre',
          caption: 'Hackathon CCR',
          icon: 'favorite',
          link: '/sobre',
          target: ''
        },
        {
          title: 'Github',
          caption: 'github.com/quasarframework',
          icon: 'code',
          link: 'https://github.com/quasarframework'
        },
        {
          title: 'Facebook',
          caption: '@QuasarFramework',
          icon: 'public',
          link: 'https://facebook.quasar.dev'
        }
      ]
    }
  }
}
</script>

<style lang="stylus" scoped>
  .base:before {
    content: "";
    height: 127px;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: $primary;
  }
</style>
