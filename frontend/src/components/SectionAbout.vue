<template lang="pug">
  
section.section.section-about
  BackgroundFigure.section-about__figure(:name="'1'")
  .container
    SmallSectionTitle About
  .section-about__content
    .section-about__top(v-if="aboutText")
      .container
        h2 {{ aboutText }}
    .section-about__items
      .container
        .section-about__items-container.row
          //v-for    
          .col-8.offset-4.col-md-4.offset-md-7.col-xl-3.offset-xl-0(
            v-for='item in items')
            .section-about__items-element.color-accent-1 {{item}}

</template>

<script>
import { mapState } from "vuex";

export default {
  setup() {
    const items = [
      'Создаем функциональные жилые пространства',
      'Индивидуальный подход к каждому проекту',
      'Полная комплектация проектов',
      'Создаем функциональные жилые пространства'
    ]
    return { items };
  },
  computed: {
    ...mapState({
      aboutText: state => state.route.data.about
    })
  }
}
</script>

<style lang="scss" scoped>
  .section-about {
    &__figure {
      width: 75%;
      top: -180px;
      right: 0;
    }
    &__top {
      margin-bottom: 95px;
      padding-bottom: 40px;
      border-bottom: 1px solid var(--color-borders);
    }
    &__items-container {
      gap: 40px 0;
    }
    &__items-element {
      max-width: 250px;
    }
    @include media-breakpoint-down(lg) {
      &__figure {
        width: 110%;
        top: -20%;
      }
    }
    @include media-breakpoint-down(sm) {
      &__figure {
        width: 120%;
        top: 10%;
      }
      &__top {
        margin-bottom: 60px;
        padding-bottom: 60px;
      }
    }
  }
</style>