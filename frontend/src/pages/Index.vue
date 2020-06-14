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
      </q-tab-panel>
      <q-tab-panel name="search">
        <Busca :token="token" />
      </q-tab-panel>
    </q-tab-panels>

    <!-- <q-page-sticky position="bottom-right" :offset="[16,16]">
      <q-btn fab icon="add" color="primary"></q-btn>
    </q-page-sticky> -->
    {{ token }}

  </q-page>
</template>

<script>
import Busca from 'components/Busca'
import Booking from 'components/Booking'

export default {
  name: 'PageIndex',

  components: {
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
      return [null, undefined].indexOf(this.token.access_token) < 0
    }
  },
  created () {
    this.$root.$on('updateUser', this.updateUser)
    this.updateUser(JSON.parse(this.$q.localStorage.getItem('token')) || {})
    this.getBookings()
    if (this.isAuthenticated && this.totalBookings) {
      this.tab = 'bookings'
    }
  },
  methods: {
    updateUser (newToken) {
      console.log('UPDATE USER INDEX')
      this.token = newToken
      // TODO: salvar no localStorage
      // JSON.parse(this.$q.localStorage.getItem('token')) || {}
    },
    async getBookings () {
      if (!this.isAuthenticated) {
        console.log('NAO AUTENTICADO!!!')
        return
      }
      var config = {
        Authorization: `${this.token.token_type} ${this.token.access_token}` // @TODO: Colocar Token de acesso
      }

      // https://api.durmabemcaminhoneiro.com.br/api/reservas
      this.bookings = this.$axios.get('https://api.durmabemcaminhoneiro.com.br/api/reservas', { headers: config })
        .then((response) => {
          console.log('bookings', response)
          return response || []
        })
    }
  },
  watch: {
    token (to, from) {
      console.log('mudou token', to, from)
    }
  }

}
</script>
