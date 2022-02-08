<template lang="pug">

section.section.not-found
  .container.not-found__container
    .not-found__text
      h1.not-found__title 404
      h3.not-found__text Такой страницы не существует
    ButtonElement.not-found__button(
      :tag="'a'"
      :modifier="'2'"
      :href="$router.resolve({name: 'main'}).path"
      @click.prevent="$router.push({name: 'main'})")
      | На главную


</template>

<script>
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";

export default {
  mixins: [ViewAnimationEvents],
}
</script>

<style lang="scss" scoped>
  .not-found {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1 1 auto;
    &__title {
      font-family: var(--font-family-accent);
      margin-bottom: 40px;
    }
    &__text {
      color: var(--color-base);
      margin: 0;
    }
    &__button {
      min-width: 220px;
      margin-top: 100px;
    }
    @include media-breakpoint-down(sm) {
      &__title {
        font-size: 42px;
        margin-bottom: 30px;
      }
      &__button {
        margin-top: 60px;
      }
    }
  }
</style>