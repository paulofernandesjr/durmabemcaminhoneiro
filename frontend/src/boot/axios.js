import Vue from 'vue'
import axios from 'axios'

Vue.prototype.$axios = axios

/*
    https://api.durmabemcaminhoneiro.com.br/api/locais?data_chegada_em=2020-06-13%2019:00&data_saida_em=2020-06-14%2008:00&rodovia=BR-116&sentido=norte&estado=SP
    https://api.durmabemcaminhoneiro.com.br/api/locais?data_chegada_em=2020-06-13 19:00&data_saida_em=2020-06-14 08:00&rodovia=BR-116&sentido=norte&estado=SP
*/
