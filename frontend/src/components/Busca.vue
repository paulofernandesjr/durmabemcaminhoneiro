<template>
  <div>
    <q-card class="q-mb-lg q-pa-md">
      <div class="q-gutter-md full-width">
        <q-select
          filled
          v-model="rodovia"
          use-input
          hide-selected
          fill-input
          input-debounce="2"
          label="Rodovia"
          :options="optionsRodovia"
          @filter="filterFn"
          @filter-abort="abortFilterFn"
          class="full-width"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                No results
              </q-item-section>
            </q-item>
          </template>
        </q-select>
        <q-select
          filled
          v-model="estado"
          v-if="showEstado"
          use-input
          hide-selected
          fill-input
          input-debounce="2"
          label="Estado"
          :options="optionsEstados"
          class="full-width"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                No results
              </q-item-section>
            </q-item>
          </template>
        </q-select>
        <q-select
          filled
          v-model="sentido"
          v-if="rodovia"
          use-input
          hide-selected
          fill-input
          input-debounce="2"
          label="Sentido"
          :options="optionsSentido"
          class="full-width"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                No results
              </q-item-section>
            </q-item>
          </template>
        </q-select>
        <q-input v-if="rodovia" filled v-model="checkin" class="full-width" label="Quando chega">
          <template v-slot:prepend>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-date v-model="checkin" mask="DD/MM/YYYY HH:mm" />
              </q-popup-proxy>
            </q-icon>
          </template>
          <template v-slot:append>
            <q-icon name="access_time" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-time v-model="checkin" mask="DD/MM/YYYY HH:mm" format24h />
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
        <q-input v-if="rodovia" filled v-model="checkout" class="full-width" label="Quando saí">
          <template v-slot:prepend>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-date v-model="checkout" mask="DD/MM/YYYY HH:mm" />
              </q-popup-proxy>
            </q-icon>
          </template>
          <template v-slot:append>
            <q-icon name="access_time" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-time v-model="checkout" mask="DD/MM/YYYY HH:mm" format24h />
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
        <q-btn v-if="rodovia" @click="search" rounded label="Verificar disponibilidades" color="primary" class="full-width" />
      </div>
    </q-card>
    <q-list v-if="!showResult">
      <q-item>
        <q-item-section top thumbnail>
          <q-avatar color="positive" size="xl" text-color="white" icon="hotel" />
        </q-item-section>
        <q-item-section>
          <!-- <p class="text-h6 q-ma-none text-weight-light">Caminhoneiro, encontre um local de descanso com custo acessível e segurança!</p>
          <p class="q-ma-none text-weight-light text-white bg-grey-6 q-pa-sm">Escolha a rodovia onde será seu trecho!</p> -->
          <q-item-label>Descanse em local seguro e barato!</q-item-label>
          <q-item-label caption>Para começar, escolha qual rodovia deseja descansar...</q-item-label>
        </q-item-section>
      </q-item>
      <q-item class="q-mt-lg">
        <q-item-section top thumbnail>
          <q-avatar color="positive" size="xl" text-color="white" icon="hotel" />
        </q-item-section>
        <q-item-section>
          <p class="text-h6 q-ma-none text-weight-light">Caminhoneiro, encontre um local de descanso com custo acessível e segurança!</p>
          <!-- <p class="q-ma-none text-weight-light text-white bg-grey-6 q-pa-sm">Escolha a rodovia onde será seu trecho!</p> -->
        </q-item-section>
      </q-item>
    </q-list>
    <q-list v-if="showResult">
      <q-item>
        <!-- <q-item-section side top>
          <q-avatar size="md" color="red" text-color="white" icon="directions" />
        </q-item-section> -->
        <q-item-section>
          <q-item-label>Posto Arco-íris</q-item-label>
          <q-item-label caption>Rodovia Régis Bittencourt, KM 1134, Camanducaia/MG</q-item-label>
          <!-- <q-label caption>2 min ago</q-label><br/>
          <div class="text-orange">
            <q-icon name="star" />
            <q-icon name="star" />
            <q-icon name="star" />
          </div> -->
        </q-item-section>
        <q-item-section side top>
          <div class="text-orange">
            <q-icon name="star" />
            <q-icon name="star" />
            <q-icon name="star" />
          </div>
          <q-item-label caption>283 votos</q-item-label>
          <q-item-label caption>3 vagas</q-item-label>
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-section>
          <div class="q-gutter-md text-blue">
            <q-icon size="sm" name="hotel" />
            <q-icon size="sm" name="fas fa-road" />
            <q-icon size="sm" name="local_dining" />
            <q-icon size="sm" name="local_gas_station" />
            <q-icon size="sm" name="fas fa-shower" />
          </div>
        </q-item-section>
        <q-item-section side top>
          <q-btn label="reservar" @click="showDialog" outline rounded color="primary" />
        </q-item-section>
      </q-item>

      <q-separator spaced inset />

    </q-list>

    <!-- TODO: se não autenticado, exibir componente de login<br/>
    TODO: se autenticado, exibir busca e reservas atuais<br/>
    TODO: se autenticado, exibir sugestão de novo local<br/>
    <ul>
      <li>login/cadastro</li>
      <li>busca de local</li>
      <li>resultado de locais (com filtro e busca)</li>
      <li>reserva de local de descanso</li>
      <li>sugerir novo local</li>
    </ul>

    // data saida automatica = 1º + 12 horas
 -->
  </div>
</template>

<script>
const stringRodovias = [
  'BR-381', 'BR-101', 'BR-116', 'MG-11', 'SP-35'
]
const stringSentido = [
  'Norte',
  'Sul',
  'Leste',
  'Oeste',
  'Capital',
  'Interior'
]
const stringEstados = [
  'SP',
  'MG',
  'BA'
]

export default {
  // name: 'ComponentName',
  data () {
    return {
      rodovia: null,
      sentido: null,
      estado: null,
      checkin: null,
      checkout: null,
      optionsRodovia: stringRodovias,
      optionsSentido: stringSentido,
      optionsEstados: stringEstados,
      showResult: true
    }
  },
  computed: {
    showEstado () {
      const arrRodovia = this.rodovia ? this.rodovia.split('-') : []

      switch (arrRodovia[0]) {
        case 'BR':
          return true
        default:
          return false
      }
    }
  },

  methods: {
    search () {
      this.showResult = true
    },
    showDialog () {
      this.$q.dialog({
        title: 'Alert<em>!</em>',
        message: '<em>I can</em> <span class="text-red">use</span> <strong>HTML</strong>',
        html: true,
        ok: {
          label: 'Confirmar',
          color: 'primary',
          outline: true,
          rounded: true
        },
        cancel: {
          label: 'Cancelar',
          flat: true
        }
      }).onOk(() => {
        console.log('OK')
      }).onCancel(() => {
        console.log('Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    filterFn (val, update, abort) {
      // call abort() at any time if you can't retrieve data somehow
      update(() => {
        if (val === '') {
          this.options = stringRodovias
        } else {
          const needle = val.toLowerCase()
          this.options = stringRodovias.filter(v => v.toLowerCase().indexOf(needle) > -1)
        }
      })
    },

    abortFilterFn () {
      // console.log('delayed filter aborted')
    }
  }
}
</script>
