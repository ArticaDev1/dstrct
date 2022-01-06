<template lang="pug">
  
section.section.section-about
  .container
    SmallSectionTitle About
  .section-about__content
    .section-about__top.container
      h2 Каждый дом является точным отражением вас и вашей семьи. Понимая это мы создаем жилые пространства, которые соответствуют не только образу жизни будущего владельца, но и его взглядам на мир, учитывая при этом все пожелания.
    .section-about__items
      .container
        .section-about__items-container.row
          //v-for    
          .col-8.offset-4.col-md-4.offset-md-7.col-xl-3.offset-xl-0(
            v-for='item in items')
            .section-about__items-element {{item}}

</template>

<script>
export default {
  data() {
    return {
      items: [
        'Создаем функциональные жилые пространства',
        'Индивидуальный подход к каждому проекту',
        'Полная комплектация проектов',
        'Создаем функциональные жилые пространства'
      ]
    }
  }
}
</script>

<style lang="scss">
  .section-about {
    &__items {
      margin-top: 95px;
      padding-top: 40px;
      border-top: 1px solid var(--color-muted-3);
    }
    &__items-container {
      gap: 40px 0;
    }
    &__items-element {
      max-width: 250px;
    }
  }
</style>