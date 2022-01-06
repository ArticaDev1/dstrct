<template lang="pug">

section.section.home(ref="parent")
  .container.home__container
    .home__slogan.row
      .col-xl-3.offset-xl-7
        p Cовременный дизайн жилых пространств премиум сегмента

    .home__links
      LinkIcon(
        :href="$router.resolve({name: 'projects'}).fullPath"
        @click.prevent="$router.push({name: 'projects'})") Посмотреть<br> портфолио

  .home-words
    .home-words__container
      .home-words__word d
      .home-words__word s
      .home-words__word t
      .home-words__word r
      .home-words__word c
      .home-words__word t
      .home-words__word .


</template>

<script>
import msDuration from "@/assets/js/msDuration";

export default {
  methods: {

    createWordsAnimation() {
      const $words = this.$el.querySelectorAll('.home-words__word');
      const dur = msDuration[3] / 1000;

      return this.$gsap.timeline({paused: true})
        .fromTo($words, {autoAlpha: 0}, {autoAlpha: 1, duration: dur, stagger: {amount: dur / 2, from: 'random'}})
    }

  },
  mounted() {
    this.wordsAnimation = this.createWordsAnimation();
    this.wordsAnimation.play();
  }
}
</script>

<style lang="scss">
  .home {
    --padding-bottom: 80px;
    min-height: calc(min(var(--screen-max-height), var(--window-safe-height)));
    margin-bottom: calc(var(--section-margin) - var(--padding-bottom));
    position: relative;
    display: flex;
    &__container {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding-bottom: var(--padding-bottom);
      padding-top: var(--header-top-padding);
    }
    &__slogan {
      p {
        max-width: 270px;
      }
    }
    &__links {
      
    }
  }

  .home-words {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    padding: 45px 75px;
    z-index: 2;
    pointer-events: none;
    &__container {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      position: relative;
    }
    &__word {
      --font-size: 220px;
      position: absolute;
      z-index: 2;
      text-transform: uppercase;
      font-family: var(--font-family-accent);
      font-size: var(--font-size);
      line-height: calc(var(--font-size) * 0.65);
      padding-top: calc(var(--font-size) * 0.2);
      color: #fff;

      @supports (background-clip: text) {
        background-image: url("~@/assets/img/noize.gif");
        -webkit-text-fill-color: rgba(255, 255, 255, 0.75);
        -webkit-background-clip: text;
      }
      
      &:first-child {
        left: 0;
        top: 0;
      }
      &:nth-child(2) {
        left: 1em;
      }
      &:nth-child(3) {
        left: 39%;
      }
      &:nth-child(4) {
        left: 39%;
        top: calc(50% - 0.4em);
      }
      &:nth-child(5) {
        bottom: 0;
        right: 1.2em;
      }
      &:nth-child(6) {
        bottom: 0;
        right: 0.3em;
      }
      &:nth-child(7) {
        bottom: 0;
        right: 0;
        font-size: calc(var(--font-size) * 0.75);
        line-height: calc(var(--font-size) * 0.53);
      }
    }
    @include media-breakpoint-down(xxl) {
      padding: 40px;
      &__word {
        --font-size: 160px;
      }
    }
  }
</style>