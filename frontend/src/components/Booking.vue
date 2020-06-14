<template>
  <div>
    <q-card class="my-card q-mb-md">
      <q-card-section>
        <div class="row no-wrap items-center">
          <div class="col text-h6 ellipsis">
            {{ title }}
          </div>
          <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
            R$ {{ booking.valor_estadia }}
          </div>
        </div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="text-subtitle1">
          {{ booking.nome }}
        </div>
        <div class="text-caption text-grey">
          {{ booking.rodovia}}, KM {{ booking.km }}, {{ booking.cidade_nome }}/{{ booking.estado_uf }}
        </div>
        <div class="row q-mt-sm">
          <div class="text-caption text-grey" v-if="booking.data_chegada_em || checkin">
            Chegada: {{ booking.data_chegada_em ? booking.data_chegada_em : checkin }}
          </div>

        </div>
        <div class="row">
          <div class="text-caption text-grey" v-if="booking.data_saida_em || checkout">
            Saída: {{ booking.data_saida_em ? booking.data_saida_em : checkout }}
          </div>
        </div>
        <div class="q-gutter-md text-blue q-mt-sm" v-if="title == 'Reserva'">
          <q-icon size="sm" name="hotel" v-if="booking.tags.dormir">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Local para descanso</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="fas fa-road" v-if="booking.tags.apoio_ccr">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Apoio CCR</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="local_dining" v-if="booking.tags.restaurante">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Restaurante</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="local_gas_station" v-if="booking.tags.abastecimento">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Posto de Combustível</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="fas fa-shower" v-if="booking.tags.chuveiro">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Chuveiro</strong>
            </q-tooltip>
          </q-icon>
          <!-- durma_bem_caminhoneiro: true, -->
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right" v-if="title == 'Confirmar Reserva'">
        <q-btn v-close-popup color="primary" flat icon="monetization_on" label="usar créditos" @click="addReserva()" />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
export default {
  name: 'Booking',
  props: ['title', 'booking', 'token', 'checkin', 'checkout'],
  data () {
    return {}
  },
  methods: {
    async addReserva () {
      const checkinAmericano = this.$moment(this.checkin, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm')
      const checkoutAmericano = this.$moment(this.checkout, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm')

      var config = {
        Authorization: `${this.token.token_type} ${this.token.access_token}`
      }

      const resultado = await this.$axios.post('https://api.durmabemcaminhoneiro.com.br/api/reservas/' + this.booking.uuid, {
        data_chegada_em: checkinAmericano,
        data_saida_em: checkoutAmericano
      }, { headers: config }).then((response) => {
        this.$root.$emit('updateReservas')

        return true
      }).catch((err) => {
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'Erro ao reservar um local ' + err,
          icon: 'report_problem'
        })

        return false
      })

      return resultado
    }
  }
}
</script>
