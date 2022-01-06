<template lang="pug">

.service-dropdown-element(
  @click="toggle"
  :class="{active: element.state}"
  data-custom-interaction)

  SectionServiceElementHead(:title="element.title" :icon="'plus'")

  .service-dropdown-element__content(ref="content")
    .service-dropdown-element__content-container.container
      slot(name="content")

</template>

<script>
import SectionServiceElementHead from "@/components/SectionServiceElementHead";
import msDuration from "@/assets/js/msDuration";

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
  methods: {
    toggle() {
      this.$emit('toggle', this.element.id);
    }
  },
  mounted() {
    this.animation = this.$gsap.timeline({paused: true})
      .slide(this.$refs.content, {duration: msDuration[2] / 1000})
      .fromTo(this.$refs.content, {autoAlpha: 0}, {autoAlpha: 1, duration: msDuration[2] / 1000}, '<')

    this.animation.progress(this.element.state ? 1 : 0);

    this.$watch(
      () => this.element.state, (newValue) => {
        if (newValue) {
          this.animation.play();
        } else {
          this.animation.reverse();
        }
      }
    )
  } 
}
</script>

<style lang="scss">
  .service-dropdown-element {
    --icon-size: 36px;
    &[data-touch], &[data-hover] {
      --hover-transform: rotate(15deg);
    }
    &.active {
      --hover-transform: rotate(45deg);
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
  }
</style>