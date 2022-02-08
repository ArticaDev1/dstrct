<template lang="pug">
component.link-icon(:is="tag")
  .link-icon__text
    span
      slot
  SpriteIcon(
    v-if="icon"
    :id="'caret-right'")

</template>

<script>
export default {
  name: 'LinkIcon',
  props: {
    tag: {
      type: String,
      default: 'a'
    },
    icon: {
      type: Boolean,
      default: true
    }
  }
}
</script>

<style lang="scss">
  .link-icon {
    transition: color var(--trs-1);
    color: var(--color-accent-1);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    text-align: left;
    gap: 25px;
    line-height: var(--large-line-height);
    &__text {
      span {
        border-bottom: 1px solid currentColor;
      }
    }
    .icon {
      width: 9px;
      height: 16px;
      transition: transform var(--trs-1)
    }
    &[data-touch], &[data-hover] {
      color: var(--color-accent-2);
      .icon {
        transform: translateX(5px);
      }
    }
  }
</style>