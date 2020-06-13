<template>
  <q-page padding class="q-pa-lg">
    <!-- flex flex-center <img
      alt="Quasar logo"
      src="~assets/quasar-logo-full.svg"
    > -->
    <Busca />
    <Login v-if="false" />

    <!-- <q-page-sticky position="bottom-right" :offset="[16,16]">
      <q-btn fab icon="add" color="primary"></q-btn>
    </q-page-sticky> -->

  </q-page>
</template>

<script>
import Login from 'components/Login'
import Busca from 'components/Busca'

export default {
  name: 'PageIndex',

  components: {
    Login,
    Busca
  }

}
</script>
