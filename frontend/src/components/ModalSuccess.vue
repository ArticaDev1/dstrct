<template lang="pug">
Modal(
  :visible="visible"
  @close="$emit('close')")
  .success-block
    .success-block__content
      h2.success-block__title Спасибо!
      p.success-block__text Скоро мы с вами свяжемся

</template>

<script>
import Modal from "@/components/Modal";

export default {
  components: {
    Modal
  },
  props: {
    visible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close'],
  watch: {
    visible(value) {
      if (value) setTimeout(() => {
        this.$emit('close')
      }, 3000);
    }
  }
}
</script>

<style lang="scss" scoped>
.success-block {
  width: 700px;
  min-height: 400px;
  display: flex;
  &__content {
    margin: auto;
    position: relative;
    z-index: 2;
  }
  &__title {
    text-align: center;
  }
  @include media-breakpoint-down(xxl) {
    width: 600px;
    min-height: 350px;
  }
  @include media-breakpoint-down(xl) {
    width: 400px;
    min-height: 270px;
  }
  @include media-breakpoint-down(sm) {
    width: 100%;
    min-height: 230px;
  }
}
</style>