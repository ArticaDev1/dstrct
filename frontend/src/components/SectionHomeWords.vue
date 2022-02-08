<template lang="pug">
.words
  .words__container
    .words__word(
      v-for="word in words") {{ word }}
</template>

<script>
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  setup() {
    const words = ['d', 's', 't', 'r', 'c', 't', '.'];
    return { words };
  },
  props: {
    activeSelectedProjects: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    ...mapState({
      onEnter: state => state.transition.enterStart
    }),
    visible() {
      return this.onEnter && !this.activeSelectedProjects;
    }
  },
  watch: {
    visible(value) {
      if (value) this.show();
      else this.hide();
    }
  },
  unmounted() {
    if (this.animation) this.animation.kill();
  },
  methods: {
    createAnimation() {
      const $words = this.$el.querySelectorAll('.words__word');

      this.animation = gsap.timeline({paused: true})
        .fromTo($words, 
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: sDur[4], stagger: {each: 0.1, from: 'random'}})
    },
    show() {
      if (!this.animation) this.createAnimation();
      this.animation.timeScale(1).play();
    },
    hide() {
      if (!this.animation) this.createAnimation();
      this.animation.duration(sDur[4]).reverse();
    }
  }
}
</script>

<style lang="scss" scoped>

.words {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  padding: 45px var(--container-padding-x);
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
    line-height: calc(var(--font-size) * 0.5);
    padding-top: calc(var(--font-size) * 0.22);
    color: #fff;
    @supports (background-clip: text) {
      background-image: url("~@/assets/img/noize.gif");
      background-size: 200px;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.95);
      -webkit-background-clip: text;
    }
    &:first-child {
      left: -0.07em;
      top: 0;
    }
    &:nth-child(2) {
      left: 0.9em;
    }
    &:nth-child(3) {
      left: 39%;
    }
    &:nth-child(4) {
      left: 39%;
      top: calc(50% - 0.36em);
    }
    &:nth-child(5) {
      bottom: 0;
      right: 1.15em;
    }
    &:nth-child(6) {
      bottom: 0;
      right: 0.25em;
    }
    &:nth-child(7) {
      bottom: 0;
      right: -0.08em;
      font-size: calc(var(--font-size) * 0.75);
      line-height: calc(var(--font-size) * 0.38);
    }
  }
  @include media-breakpoint-down(xxl) {
    padding-top: 30px;
    padding-bottom: 30px;
    &__word {
      --font-size: 142px;
    }
  }
  @include media-breakpoint-down(lg) {
    padding-top: var(--header-top-padding);
    padding-bottom: 200px;
    &__word {
      --font-size: 124px;
      &:nth-child(3) {
        left: 46%;
      }
      &:nth-child(4) {
        left: 46%;
        top: 35%;
      }
    }
  }
  @include media-breakpoint-down(md) {
    --height: 300px;
    padding-top: 0;
    padding-bottom: 0;
    height: var(--height);
    top: calc(50.2% - var(--height) / 2);
    &__word {
      --font-size: 98px;
    }
  }
  @include media-breakpoint-down(sm) {
    --height: calc(var(--window-width) * 0.74);
    padding: 0;
    &__word {
      --font-size: calc(var(--window-width) * 0.20);
      &:nth-child(4) {
        top: calc(46% - 0.36em);
      }
    }
  }
}
</style>