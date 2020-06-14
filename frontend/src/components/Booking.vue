<template>
  <div>
    <q-card class="my-card">
      <q-card-section>
        <div class="row no-wrap items-center">
          <div class="col text-h6 ellipsis">
            Confirmar Reserva
          </div>
          <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
            R$ 50
          </div>
        </div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="text-subtitle1">
          $・Italian, Cafe
        </div>
        <div class="text-caption text-grey">
          Small plates, salads & sandwiches in an intimate setting.
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn v-close-popup color="primary" flat icon="monetization_on" label="usar créditos" />
        <q-btn v-close-popup color="primary" flat icon="credit_card" label="usar cartão" />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
export default {
  name: 'Booking',
  props: ['booking'],
  data () {
    return {}
  }
}
</script>
