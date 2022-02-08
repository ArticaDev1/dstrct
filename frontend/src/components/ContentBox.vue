<template lang="pug">
.content-box
  img(:data-src="require(`@/assets/img/content-box-bg-${index}.jpg`)", alt="alt").content-box__background.lazyload.lazypreload
  SpriteIcon.content-box__icon(v-if="icon" :id="icon" :class="`content-box__icon_${icon}`")
  .content-box__index(v-else) {{ index }}
  .content-box__content
    slot
</template>

<script>
export default {
  props: {
    index: {
      type: String,
      required: true
    },
    icon: {
      type: String
    }
  }
}
</script>

<style lang="scss" scoped>
  .content-box {
    padding: 30px;
    border-radius: 30px;
    background: #1A1A1A;
    height: 100%;
    position: relative;
    &__background {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      top: 0;
      left: 0;
      border-radius: inherit;
    }
    @supports(mix-blend-mode: multiply) {
      &::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("~@/assets/img/noize.gif");
        background-size: 400px;
        background-position: center center;
        background-repeat: repeat;
        opacity: 0.15;
        mix-blend-mode: multiply;
        z-index: 2;
        border-radius: inherit;
      }
    }
    &__icon {
      --size: 60px;
      width: var(--size);
      height: var(--size);
      margin-bottom: 60px;
      position: relative;
      z-index: 3;
      &_eye {
        width: calc(var(--size) * 1.25);
      }
    }
    &__index {
      position: relative;
      z-index: 3;
      margin-bottom: 60px;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: 1px solid var(--color-muted-2);
      line-height: 28px;
      text-align: center;
      font-size: 16px;
      color: var(--color-accent-1);
    }
    &__content {
      position: relative;
      z-index: 3;
    }
  }
</style>