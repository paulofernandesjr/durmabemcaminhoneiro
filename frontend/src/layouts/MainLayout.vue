<template>
  <q-layout view="lHh Lpr lFf" class="base">
    <q-ajax-bar
      ref="bar"
      position="bottom"
      color="accent"
      size="10px"
    />
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

        <div>v 0.3</div>
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
          Conheça o Projeto
        </q-item-label>

        <q-item
          clickable
          tag="a"
          to="/"
          exact
          v-if="this.$route.path !== '/'"
        >
          <q-item-section avatar >
            <q-icon name="home" />
          </q-item-section>

          <q-item-section>
            <q-item-label>Página inicial</q-item-label>
          </q-item-section>
        </q-item>

        <q-item
          clickable
          tag="a"
          to="/sobre"
          exact
        >
          <q-item-section avatar >
            <q-icon name="favorite" />
          </q-item-section>

          <q-item-section>
            <q-item-label>Sobre</q-item-label>
          </q-item-section>
        </q-item>

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
          title: 'Apresentação',
          icon: 'picture_as_pdf',
          link: 'https://PDF'
        },
        {
          title: 'Vídeo',
          icon: 'movie',
          link: 'https://youtu.be/XYZABC'
        },
        {
          title: 'Github',
          icon: 'code',
          link: 'https://github.com/paulofernandesjr/durmabemcaminhoneiro'
        }
      ]
    }
  }
}
</script>

<style lang="stylus" scoped>
  // .base:before {
  //   content: "";
  //   height: 127px;
  //   position: absolute;
  //   top: 0;
  //   width: 100%;
  //   background-color: $primary;
  // }
</style>
