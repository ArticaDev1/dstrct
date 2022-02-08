<template lang="pug">
.background-figure
  img.lazyload.lazypreload(
    :data-src="require(`@/assets/img/figures/optimized/${name}-min.png`)" 
    alt="alt")
</template>

<script>
export default {
  name: 'BackgroundFigure',
  props: {
    name: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.background-figure {
  position: absolute;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}
</style>