<template lang="pug">
.image-content.image.image_cover(ref="image")
  img.lazyload(
    v-if="lazyload"
    :class="{'lazypreload': preloadImage}"
    :data-src="image"
    alt="image")
  img(
    v-else
    :src="image"
    alt="image")
</template>

<script>
import ParallaxImage from "@/assets/js/parallax-image";

export default {
  props: {
    image: {
      type: String, 
      required: true
    },
    type: {
      type: String
    },
    lazyload: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    preloadImage() {
      return this.type === '1n';
    }
  },
  mounted() {
    if (window.innerWidth >= this.$breakpoints.xl && this.$device.type === 'desktop' && this.type === '1n') {
      this.parallax = new ParallaxImage(this.$refs.image, {
        oversize: false
      });
    }
  },
  unmounted() {
    if (this.parallax) this.parallax.destroy();
  }
}
</script>