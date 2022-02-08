<template lang="pug">

h1.heading-title.container.font-accent
  span.heading-title__element(ref="text1") {{ text[0] }}
  span.heading-title__line(v-if="$window.innerWidth >= $breakpoints.xl" ref="line")
  span.heading-title__element(v-if="text[1]" ref="text2") {{ text[1] }} 

</template>

<script>
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  props: {
    text: {
      type: Array,
      required: true
    }
  },
  computed: {
    ...mapState({
      onEnter: state => state.transition.enterStart
    })
  },
  watch: {
    onEnter(value) {
      if (value && window.innerWidth >= this.$breakpoints.xl) this.show();
    }
  },
  methods: {
    show() {
      this.animation = gsap.timeline({ paused: true })
        .fromTo(this.$refs.text1, 
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: sDur[3] }, `+=0.25`)
        .fromTo(this.$refs.line, 
          { scaleX: 0, xPercent: -50 }, 
          { scaleX: 1, xPercent: 0, duration: sDur[3] }, '<')

      if (this.$refs.text2) {
        const animation = gsap
          .fromTo(this.$refs.text2, 
            { autoAlpha: 0 }, 
            { autoAlpha: 1, duration: sDur[3] })

        this.animation.add(animation, `-=${sDur[3] / 2}`);
      }
        

      this.animation.play();
    }
  },
  unmounted() {
    if (this.animation) this.animation.kill();
  }
}
</script>

<style lang="scss" scoped>
.heading-title {
  margin-top: var(--section-margin-first-top);
  margin-bottom: 100px;
  @include media-breakpoint-up(xl) {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 28px;
    &__element {
      flex: 0 0 auto;
    }
    &__line {
      flex: 1 1 auto;
      height: 3px;
      background-color: currentColor;
    }
  }
  @include media-breakpoint-up(xxl) {
    &__line {
      height: 4px;
    }
  }
  @include media-breakpoint-down(xl) {
    margin-bottom: var(--section-margin);
  }
}
</style>