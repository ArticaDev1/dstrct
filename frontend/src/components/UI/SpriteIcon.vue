<template lang="pug">
  
svg.icon
  use(:xlink:href="require('@/assets/img/icons/icons.svg') + id")

</template>

<script>
export default {
  name: 'SpriteIcon',
  props: {
    id: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss">
  .icon {
    display: block;
    width: 20px;
    height: 20px;
  }
</style>