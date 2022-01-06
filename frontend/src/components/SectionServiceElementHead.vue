<template lang="pug">

.service-element-head 
  .container
    .row.align-items-center
      h2.mb-0.mt-0.col-10 {{title}}

      .col-2
        SpriteIcon.icon_plus(v-if="icon=='plus'" :id="'#' + icon")
        SpriteIcon.icon_link(v-if="icon=='link'" :id="'#' + icon")

      
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    icon: {
      type: String,
      required: true
    }
  },
}
</script>

<style lang="scss">
  .service-element-head {
    color: var(--color-accent);
    width: 100%;
    padding: 35px 0;
    .icon {
      width: var(--icon-size);
      height: var(--icon-size);
      transform: var(--hover-transform);
      transition: transform var(--trs-1);
      will-change: transform;
    }
  }
</style>