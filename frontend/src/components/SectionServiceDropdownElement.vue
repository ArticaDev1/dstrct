<template lang="pug">

.service-dropdown-element(
  @click="toggle"
  :class="{active: element.state}"
  :id="element.id.slice(1)"
  data-custom-interaction)

  SectionServiceElementHead(:title="element.title" :icon="'plus'")

  .service-dropdown-element__content(ref="content")
    .service-dropdown-element__content-container.container
      slot(name="content")

</template>

<script>
import SectionServiceElementHead from "@/components/SectionServiceElementHead";
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  components: {
    SectionServiceElementHead
  },
  props: {
    element: {
      type: Object,
      required: true
    }
  },
  computed: {
    state() {
      return this.element.state;
    }
  },
  watch: {
    state(value) {
      if (value) {
        this.animation.play();
      } else {
        this.animation.reverse();
      }
    }
  },
  mounted() {
    this.animation = gsap.timeline({paused: true})
      .slide(this.$refs.content, 
        { duration: sDur[2] })
      .fromTo(this.$refs.content, 
        { autoAlpha: 0 }, 
        { autoAlpha: 1, duration: sDur[2] }, '<')

    this.animation.progress(this.element.state ? 1 : 0);
  },
  unmounted() {
    this.animation.kill();
  },
  methods: {
    toggle() {
      if (this.element.state) {
        this.$router.push({ name: this.$route.name });
      } else {
        this.$router.push({ hash: this.element.id });
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .service-dropdown-element {
    &[data-touch], &[data-hover] {
      --transform: rotate(15deg);
    }
    &.active {
      --transform: rotate(45deg);
    }
    &__content {
      height: 0;
      overflow: hidden;
      &.active {
        height: auto;
      }
    }
    &__content-container {
      padding-bottom: 80px;
    }
    @include media-breakpoint-down(xl) {
      &__content-container {
        padding-bottom: 45px;
      }
    }
  }
</style>