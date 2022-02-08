<template lang="pug">
transition(
  @leave="hide"
  @enter="show")
  .loader(v-if="visible")
    .loader__back
    .loader__thumb
</template>

<script>
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";

export default {
  computed: {
    ...mapState({
      visible: state => state.loader
    })
  },
  methods: {
    show(el) {
      const thumb = el.querySelector('.loader__thumb');
      el.startAnimation = gsap.timeline()
        .fromTo(el, 
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: 0.5 })
        .fromTo(thumb, 
          { css: {'width': '0%'} },
          { css: {'width': '80%'}, ease: 'expo.out', duration: 15 }, '<')
    }, 
    hide(el, done) {
      el.startAnimation.pause();
      const thumb = el.querySelector('.loader__thumb');
      gsap.timeline()
        .to(el, { autoAlpha: 0, duration: 0.5 })
        .to(thumb, { css: {'width': '100%'}, ease: 'power2.in', duration: 0.5 }, '<')
        .eventCallback('onReverseComplete', done);
    }
  }
}
</script>

<style lang="scss" scoped>
.loader {
  position: fixed;
  z-index: 10000;
  height: 4px;
  width: 100%;
  top: 0;
  left: 0;
  &__back {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: var(--color-base-background);
    opacity: 0.5;
  }
  &__thumb {
    position: relative;
    z-index: 2;
    background: #fff;
    height: 100%;
  }
  @include media-breakpoint-down(lg) {
    height: 2px;
  }
}
</style>