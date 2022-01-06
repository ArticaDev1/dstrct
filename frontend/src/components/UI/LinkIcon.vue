<template lang="pug">
  
a.link-icon
  .link-icon__text
    span
      slot
  SpriteIcon(
    v-if="icon !== false" 
    :id="icon")

</template>

<script>
export default {
  name: 'LinkIcon',
  props: {
    icon: {
      type: [Boolean, String],
      default() {
        return '#caret-right';
      }
    }
  }
}
</script>

<style lang="scss">
  .link-icon {
    color: var(--color-base);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 24px;
    line-height: var(--large-line-height);
    &__text {
      span {
        border-bottom: 1px solid currentColor;
      }
    }
    .icon {
      width: 16px;
      height: 16px;
    }
    &[data-touch], &[data-hover] {
      color: var(--color-accent);
    }
  }
</style>