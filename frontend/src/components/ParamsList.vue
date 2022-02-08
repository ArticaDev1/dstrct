<template lang="pug">
.params-list
  .params-list__row(v-for="item in items") 
    .params-list__item(:class="item.name ? 'color-muted-1' : 'color-accent-1'")
      span {{ item.name || item[0]}}
    .params-list__item.color-accent-1 
      span {{ item.value || item[1] }}
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.params-list {
  width: 100%;
  &__row {
    display: flex;
    justify-content: space-between;
    &:not(:last-child) {
      margin-bottom: 16px;
    }
  }
  &__item {
    flex: 1 1 auto;
    overflow: hidden;
    span {
      position: relative;
      &::after {
        content: '';
        display: block;
        width: 100vw;
        height: 1px;
        background: var(--color-muted-2);
        position: absolute;
        top: calc(0.5em * var(--base-line-height));
      }
    }
    &:first-child {
      padding-right: 50px;
      span {
        &::after {
          left: calc(100% + 25px);
        }
      }
    }
    &:last-child {
      padding-left: 50px;
      text-align: right;
      span {
        &::after {
          right: calc(100% + 25px);
        }
      }
    }
  }
  @include media-breakpoint-down(xxl) {
    &__row {
      &:not(:last-child) {
        margin-bottom: 14px;
      }
    }
  }
}
</style>