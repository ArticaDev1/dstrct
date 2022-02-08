<template lang="pug">
router-link.project-link.image-content.image.image_cover(
  data-cursor='watchProject')
  img.lazyload(
    v-if="image"
    :data-src="image"
    alt="image")
  slot
</template>

<script>
export default {
  props: {
    image: {
      type: String
    }
  }
}
</script>

<style lang="scss" scoped>
.project-link {
  --overlay-hover: 0.6;
  display: block;
  @include media-breakpoint-down(lg) {
    --overlay-hover: calc(var(--overlay) + 0.2);
    &::after {
      transition-duration: var(--animation-duration-1);
    }
  }
}
</style>