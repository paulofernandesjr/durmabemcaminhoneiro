<template>
  <div>
    <q-card class="q-mb-sm" v-if="!showResult">
      <q-card-section class="q-pb-none">
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
          :error="$v.rodovia.$error"
          no-error-icon
          hide-hint="true"
          bottom-slots="false"
          error-message=""
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
          label="Sentido"
          :options="showSentidos"
          class="full-width"
          @input="$v.sentido.$touch()"
          :error="$v.sentido.$error"
          no-error-icon
          autofocus
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                Sem resultados
              </q-item-section>
            </q-item>
          </template>
        </q-select>
        <q-select
          filled
          v-model="estado"
          v-if="showEstados.length > 0"
          use-input
          hide-selected
          fill-input
          input-debounce="2"
          label="Estado"
          :options="showEstados"
          class="full-width"
          @input="$v.estado.$touch()"
          :error="$v.estado.$error"
          no-error-icon
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                No results
              </q-item-section>
            </q-item>
          </template>
        </q-select>
        <q-input v-if="rodovia" filled v-model.trim="checkin" clearable no-error-icon @input="$v.checkin.$touch()" class="full-width" label="Quando chega" :error="$v.checkin.$error" >
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
        <q-input v-if="rodovia" filled v-model.trim="checkout" clearable no-error-icon @input="$v.checkout.$touch()" class="full-width" label="Quando saí" :error="$v.checkout.$error" >
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
      </q-card-section>
      <q-card-actions align="right" v-if="rodovia">
        <q-btn @click="search" flat label="Verificar disponibilidades" color="primary" />
      </q-card-actions>
    </q-card>
    <q-card class="q-mb-lg bg-purple text-white" v-if="showResult">
      <q-card-section class="q-pb-none">
        <div class="text-h6 q-mb-none">{{ rodovia }} {{ sentido }} {{ estado ? ` - ${estado}` : '' }}</div>
        <div class="text-subtitle2">{{ checkin }} a {{ checkout }}</div>
      </q-card-section>
      <q-card-actions align="right">
        <q-btn flat @click="resetSearch" label="Refazer pesquisa" />
      </q-card-actions>
      <!-- <q-btn outline rounded color="primary" label="Refazer pesquisa" /> -->
    </q-card>
    <q-list v-if="!rodovia">
      <!-- <q-item>
        <q-item-section top thumbnail>
          <q-avatar color="positive" size="xl" text-color="white" icon="hotel" />
        </q-item-section>
        <q-item-section>
          <q-item-label>Descanse em local seguro e barato!</q-item-label>
          <q-item-label caption>Para começar, escolha qual rodovia deseja descansar...</q-item-label>
        </q-item-section>
      </q-item> -->
      <q-item class="q-mt-lg">
        <q-item-section top thumbnail>
          <q-avatar color="positive" size="xl" text-color="white" icon="hotel" />
        </q-item-section>
        <q-item-section>
          <p class="text-h6 q-ma-none q-mx-nome text-weight-light">Caminhoneiro, encontre um local de descanso com custo acessível e segurança!</p>
          <p class="text-subtitle1 q-mt-md q-mx-nome text-weight-normal">Escolha a Rodovia para começar...</p>
          <!-- <p class="q-ma-none text-weight-light text-white bg-grey-6 q-pa-sm">Escolha a rodovia onde será seu trecho!</p> -->
        </q-item-section>
      </q-item>
    </q-list>
    <q-list v-if="showResult" bordered>
      <div v-for="item in lista" v-bind:key="item.uuid">

        <q-item>
          <!-- <q-item-section side top>
            <q-avatar size="md" color="red" text-color="white" icon="directions" />
          </q-item-section> -->
          <q-item-section>
            <q-item-label>{{ item.nome }}</q-item-label>
            <q-item-label caption>{{ item.rodovia}}, KM {{ item.km }}, {{ item.cidade_nome }}/{{ item.estado_uf }}</q-item-label>
            <!-- <q-label caption>2 min ago</q-label><br/>
            <div class="text-orange">
              <q-icon name="star" />
              <q-icon name="star" />
              <q-icon name="star" />
            </div> -->
          </q-item-section>
          <q-item-section side top>
            <div class="text-orange" v-if="item.votos">
              <q-icon name="star" v-for="id in Array(Math.floor(item.avaliacao_media))" v-bind:key="id" />
            </div>
            <q-item-label caption v-if="item.votos">{{ item.votos }} votos</q-item-label>
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <div class="q-gutter-md text-blue">
              <q-icon size="sm" name="hotel" v-if="item.tags.dormir">
                <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                  <strong>Local para descanso</strong>
                </q-tooltip>
              </q-icon>
              <q-icon size="sm" name="fas fa-road" v-if="item.tags.apoio_ccr">
                <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                  <strong>Apoio CCR</strong>
                </q-tooltip>
              </q-icon>
              <q-icon size="sm" name="local_dining" v-if="item.tags.restaurante">
                <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                  <strong>Restaurante</strong>
                </q-tooltip>
              </q-icon>
              <q-icon size="sm" name="local_gas_station" v-if="item.tags.abastecimento">
                <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                  <strong>Posto de Combustível</strong>
                </q-tooltip>
              </q-icon>
              <q-icon size="sm" name="fas fa-shower" v-if="item.tags.chuveiro">
                <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
                  <strong>Chuveiro</strong>
                </q-tooltip>
              </q-icon>
              <!-- durma_bem_caminhoneiro: true, -->
            </div>
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <q-item-label color="primary" text-color="white" v-if="item.aceita_reserva">
              {{ item.vagas_disponiveis > 0 ? item.vagas_disponiveis : 'nenhuma' }} {{ item.vagas_disponiveis > 1 ? 'vagas' : 'vaga' }} {{ item.vagas_disponiveis > 1 ? 'disponíveis' : 'disponível' }}
            </q-item-label>
            <!-- <q-item-label class="full-width q-mt-sm text-subtitle2" v-if="item.vagas_disponiveis">{{ item.vagas_disponiveis > 0 ? item.vagas_disponiveis : 'nenhuma' }} {{ item.vagas_disponiveis > 1 ? 'vagas' : 'vaga' }} {{ item.vagas_disponiveis > 1 ? 'disponíveis' : 'disponível' }}</q-item-label> -->
          </q-item-section>
          <q-item-section side top>
            <q-btn label="reservar" @click="showDialog(item.uuid)" rounded color="primary" :disabled="item.vagas_disponiveis === 0" />
          </q-item-section>
        </q-item>
      </div>
      <q-separator spaced inset />

    </q-list>
    <q-list v-if="false && showResult" bordered class="q-my-lg">
      <q-card class="my-card" v-for="item in lista" v-bind:key="item.uuid">
        <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />
        <q-card-section>
          <q-btn
            fab
            color="primary"
            icon="event"
            class="absolute"
            style="top: 0; right: 12px; transform: translateY(-50%);"
          />

          <div class="row no-wrap items-center">
            <div class="col text-h6 ellipsis">
              {{ item.nome }}
            </div>
            <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
              <q-icon name="place" />
              250 ft
            </div>
          </div>

          <q-rating v-model="item.avaliacao_media" :max="5" size="32px" readonly />
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

        <q-card-actions>
          <q-icon size="sm" name="hotel" v-if="item.tags.dormir">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Local para descanso</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="fas fa-road" v-if="item.tags.apoio_ccr">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Apoio CCR</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="local_dining" v-if="item.tags.restaurante">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Restaurante</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="local_gas_station" v-if="item.tags.abastecimento">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Posto de Combustível</strong>
            </q-tooltip>
          </q-icon>
          <q-icon size="sm" name="fas fa-shower" v-if="item.tags.chuveiro">
            <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 10]">
              <strong>Chuveiro</strong>
            </q-tooltip>
          </q-icon>
            <!-- durma_bem_caminhoneiro: true, -->
          <!-- <q-btn flat round icon="event" />
          <q-btn flat color="primary">
            Reservar
          </q-btn> -->
        </q-card-actions>
      </q-card>
    </q-list>

    <!--
    TODO: se não autenticado, exibir componente de login<br/>
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
import { required, requiredIf } from 'vuelidate/lib/validators'

const stringRodovias = [
  'BR-040', 'BR-381', 'BR-101', 'BR-116', 'MG-011', 'SP-035'
]
const stringSentido = [
  'Norte',
  'Sul',
  'Leste',
  'Oeste'
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
      showResult: false,
      lista: [
        {
          uuid: 'fa2424a2-3ee1-40c4-96af-370095710a76',
          nome: 'Teste',
          estado_uf: 'SP',
          cidade_nome: 'Itu',
          rodovia: 'BR-116',
          km: '500',
          aceita_reserva: true,
          valor_estadia: null,
          tags: {
            durma_bem_caminhoneiro: true,
            apoio_ccr: true,
            restaurante: true,
            abastecimento: true,
            chuveiro: false,
            dormir: false
          },
          vagas_disponiveis: 0,
          votos: 1,
          avaliacao_media: 4.5
        }
      ]
    }
  },
  computed: {
    showEstados () {
      const arrRodovia = this.rodovia ? this.rodovia.split('-') : []
      switch (arrRodovia[0]) {
        case 'BR':
          switch (arrRodovia[1]) {
            case '040': return ['DF', 'GO', 'MG', 'RJ']
            case '101': return ['RS', 'SC', 'PR', 'SP', 'RJ', 'ES', 'BA', 'SE', 'AL', 'PE', 'PB', 'RN']
            case '116': return ['RS', 'SC', 'PR', 'SP', 'RJ', 'ES', 'BA', 'PE', 'PB', 'CE']
            case '381': return ['SP', 'MG', 'ES']
          }
          return ['RS', 'SC', 'PR', 'SP', 'RJ', 'ES', 'BA', 'SE', 'AL', 'PE', 'PB', 'RN']
        default:
          return []
      }
    },
    showSentidos () {
      const arrRodovia = this.rodovia ? this.rodovia.split('-') : []
      if (!arrRodovia) return []
      switch (arrRodovia[0]) {
        case 'BR':
          switch (arrRodovia[1][0]) {
            case '0': return ['Brasília', 'Interior']
            case '1': return ['Norte', 'Sul']
            case '2': return ['Leste', 'Oeste']
            case '3': return ['Noroeste', 'Nordeste', 'Sudoeste', 'Sudeste']
            case '4': return [...stringSentido]
            case '6': return [...stringSentido]
          }
          return true
        default:
          return ['Capital', 'Interior', ...stringSentido]
      }
    }
  },
  validations: {
    rodovia: {
      required
    },
    sentido: {
      required
    },
    estado: {
      required: requiredIf(nM => {
        console.log('Verificando required de Estado', nM)
        console.log(nM.showEstados.length)
        return nM.showEstados.length > 0
      })
    },
    checkin: {
      required
    },
    checkout: {
      required
    }
  },

  methods: {
    search () {
      // Validar dados
      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log('ERRO!!!')
        return
      }
      // Chamar Axios
      // Mudar showResult
      this.showResult = true
    },
    resetSearch () {
      this.showResult = false
      this.rodovia = null
      this.sentido = null
      this.estado = null
      this.checkin = null
      this.checkout = null
    },
    showDialog (uuid) {
      // TODO: montar formulário de reserva
      this.$q.dialog({
        title: 'Deseja confirmar sua reserva?',
        message: `${uuid}`,
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
        // TODO: chamar axios e realizar requisicao de reserva
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
  },

  watch: {
    checkin (to, from) {
      const dataCheckin = this.$moment(to, 'DD/MM/YYYY HH:mm')
      if (!to) {
        this.checkout = null
        return
      }
      if (dataCheckin.toDate() < new Date()) {
        this.checkin = this.$moment(new Date()).format('DD/MM/YYYY HH:mm')
      }
      this.checkout = dataCheckin.add(12, 'hours').format('DD/MM/YYYY HH:mm')
    },
    checkout (to, from) {
      if (this.$moment(to, 'DD/MM/YYYY HH:mm').toDate() < this.$moment(this.checkin, 'DD/MM/YYYY HH:mm').toDate()) {
        const dataCheckin = this.$moment(to, 'DD/MM/YYYY HH:mm')
        this.checkout = dataCheckin.add(12, 'hours').format('DD/MM/YYYY HH:mm')
      }
    }
  }
}
</script>
