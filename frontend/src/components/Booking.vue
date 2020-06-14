<template>
  <div>
    <q-card class="my-card">
      <q-card-section>
        <div class="row no-wrap items-center">
          <div class="col text-h6 ellipsis">
            Confirmar Reserva
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
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn v-close-popup color="primary" flat icon="monetization_on" label="usar créditos" @click="addReserva()" />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
export default {
  name: 'Booking',
  props: ['booking', 'token', 'checkin', 'checkout'],
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
