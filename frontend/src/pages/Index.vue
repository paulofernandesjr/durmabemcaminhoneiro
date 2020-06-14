<template>
  <q-page>
    <!-- flex flex-center <img
      alt="Quasar logo"
      src="~assets/quasar-logo-full.svg"
    > -->
    <q-tabs
      v-model="tab"
      dense
      align="left"
      class="bg-primary text-white shadow-2"
      :breakpoint="0"
      v-if="isAuthenticated && totalBookings > 0"
    >
      <q-tab name="bookings" icon="alarm" v-if="totalBookings > 0">
        <q-badge color="red" floating v-if="totalBookings > 0">{{ totalBookings }}</q-badge>
      </q-tab>
      <q-tab name="search" icon="search" />
    </q-tabs>
    <q-tab-panels
      v-model="tab"
      animated
      swipeable
    >
      <q-tab-panel name="bookings" v-if="isAuthenticated">
        <Booking v-for="booking in bookings" v-bind:key="booking.uuid" :booking="booking" />
      </q-tab-panel>
      <q-tab-panel name="bookings" v-if="!isAuthenticated">
        <Login />
      </q-tab-panel>
      <q-tab-panel name="search">
        <Busca />
      </q-tab-panel>
    </q-tab-panels>

    <!-- <q-page-sticky position="bottom-right" :offset="[16,16]">
      <q-btn fab icon="add" color="primary"></q-btn>
    </q-page-sticky> -->

  </q-page>
</template>

<script>
import Login from 'components/Login'
import Busca from 'components/Busca'
import Booking from 'components/Booking'

export default {
  name: 'PageIndex',

  components: {
    Login,
    Busca,
    Booking
  },

  data () {
    return {
      tab: 'search',
      bookings: [
      ],
      token: {}
    }
  },
  computed: {
    totalBookings () {
      return this.bookings.length
    },
    isAuthenticated () {
      return this.getToken.access_token || false
    },
    getToken () {
      return this.token
    }
  },
  created () {
    this.getBookings()
    this.$root.$on('updateUser', this.updateUser)
    this.updateUser()
    if (this.isAuthenticated && this.totalBookings) {
      this.tab = 'bookings'
    }
  },
  methods: {
    updateUser () {
      this.token = JSON.parse(this.$q.localStorage.getItem('token')) || {}
    },
    getBookings () {
      // TODO: sair se não estiver autenticado
      // TODO: chamada no servidor
      // https://api.durmabemcaminhoneiro.com.br/api/reservas
      console.log('carregar dados servidor')
      this.bookings = [
        {
          uuid: 'db49c992-01f8-401e-8178-466007566d7f',
          data_chegada_em: '2020-06-14 21:00:00',
          data_saida_em: '2020-06-15 08:00:00',
          nome: 'Teste',
          estado_uf: 'SP',
          cidade_nome: 'Itu',
          rodovia: 'BR-116',
          km: '500',
          valor_estadia: 50,
          tags: {
            durma_bem_caminhoneiro: true,
            apoio_ccr: true,
            restaurante: true,
            abastecimento: true,
            chuveiro: false,
            dormir: false
          },
          latitude: '-23.2847281',
          longitude: '-47.27839300000001'
        },
        {
          uuid: '7f03b8c8-6e28-4783-843c-4369aa562501',
          data_chegada_em: '2020-06-14 21:00:00',
          data_saida_em: '2020-06-15 08:00:00',
          nome: 'Teste',
          estado_uf: 'SP',
          cidade_nome: 'Itu',
          rodovia: 'BR-116',
          km: '500',
          valor_estadia: 50,
          tags: {
            durma_bem_caminhoneiro: true,
            apoio_ccr: true,
            restaurante: true,
            abastecimento: true,
            chuveiro: false,
            dormir: false
          },
          latitude: '-23.2847281',
          longitude: '-47.27839300000001'
        }
      ]
    }
  }

}
</script>
