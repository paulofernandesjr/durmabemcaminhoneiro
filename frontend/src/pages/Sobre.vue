<template>
  <q-page padding>
    <div class="q-px-lg">
      <h4 class="q-mb-lg q-mt-none">Sobre o projeto</h4>
      <p>Este projeto foi desenvolvido com o objetivo de oferecer conforto para os caminhoneiros nas estradas brasileiras.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum pretium est vitae tincidunt. Cras dictum euismod congue. Suspendisse aliquam eu velit et sagittis. Donec ultricies sapien ac cursus efficitur. Nam auctor leo a eros cursus, quis consequat magna luctus. Phasellus feugiat ipsum est, sed lacinia massa malesuada vel. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum et vulputate tortor, a porttitor nunc. Nunc in nulla semper, gravida eros in, accumsan lorem. In neque lectus, scelerisque at enim in, rutrum porttitor ex. Integer mi metus, bibendum ut pulvinar eu, iaculis sed quam.</p>
      <p>In a luctus eros. Sed vel est dui. Suspendisse purus velit, bibendum quis diam nec, sollicitudin tincidunt elit. Nullam ut leo ullamcorper, blandit metus non, sodales augue. Etiam consequat dictum orci in convallis. Ut sed lacus a diam fermentum laoreet a vel lorem. Vestibulum vel dolor ipsum. Fusce elementum arcu quis ligula suscipit, a gravida odio finibus. Sed eget eleifend mi. Suspendisse aliquet, tortor sed porttitor gravida, velit metus dictum leo, sit amet tempor justo orci in purus. Etiam quis imperdiet lectus. Nullam posuere aliquet sapien, at iaculis tortor tincidunt in. Nam interdum vulputate nisl, eu ultrices nunc laoreet sed. Integer sed efficitur est, id tristique enim.</p>
      <h5 class="q-mb-sm q-mt-lg">Quem desenvolveu o projeto?</h5>
      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="https://cdn.quasar.dev/img/avatar.png" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Adriel</q-item-label>
          <q-item-label caption>Backend</q-item-label>
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="https://cdn.quasar.dev/img/avatar.png" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Leão</q-item-label>
          <q-item-label caption>Frontend</q-item-label>
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section side>
          <q-avatar size="48px">
            <img src="https://cdn.quasar.dev/img/avatar.png" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>Paulo</q-item-label>
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
