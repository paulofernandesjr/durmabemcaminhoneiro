<template>
  <q-page padding>
    <div class="q-px-lg">
      <h4 class="q-mb-lg q-mt-lg q-mb-sm">Sobre o projeto</h4>
      <p>O Durma Bem Caminhoneiro é uma solução inovadora, pois os caminhoneiros poderão acessar nosso webapp e pesquisar locais úteis que existe na rodovia, como: pontos de apoio da CCR, restaurantes, postos de combustível e outros.</p>
      <p>O webapp também permite a reserva de uma vaga para passar a noite em algum Ponto de Parada e Descanso credenciado.</p>
      <p>O Durma Bem Caminhoneiro tem como objetivo prover mais qualidade de vida para o caminhoneiro, através da instalação de containers limpos e padronizados onde ele pode tomar banho e ficar tranquilo durante o seu momento de descanso.</p>
      <h5 class="q-mb-sm q-mt-lg">Quem desenvolveu o projeto?</h5>
      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="~/assets/adriel.png" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Adriel Renato</q-item-label>
          <q-item-label caption>Backend</q-item-label>
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="~/assets/leao.jpg" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Luís Leão</q-item-label>
          <q-item-label caption>Frontend</q-item-label>
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="~/assets/paulo.jpg" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Paulo Fernandes</q-item-label>
          <q-item-label caption>Marketing</q-item-label>
        </q-item-section>
      </q-item>

    </div>
  </q-page>
</template>

<script>
export default {
  name: 'Sobre'
}
</script>
