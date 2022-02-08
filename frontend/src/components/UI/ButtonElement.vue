<template lang="pug">

component(
  :is="tag"
  :class="['button', `button_type-${this.modifier}`]")
  span.button__background

  transition
    span.button__content(v-if="!loader")
      slot

  transition
    span.button__loader(v-if="loader")
      svg(xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 30' fill='currentColor')
        circle(cx='15' cy='15' r='15')
          animate(attributeName='r' from='15' to='15' begin='0s' dur='0.8s' values='15;9;15' calcMode='linear' repeatCount='indefinite')
          animate(attributeName='fill-opacity' from='1' to='1' begin='0s' dur='0.8s' values='1;.5;1' calcMode='linear' repeatCount='indefinite')
        circle(cx='60' cy='15' r='9' fill-opacity='0.3')
          animate(attributeName='r' from='9' to='9' begin='0s' dur='0.8s' values='9;15;9' calcMode='linear' repeatCount='indefinite')
          animate(attributeName='fill-opacity' from='0.5' to='0.5' begin='0s' dur='0.8s' values='.5;1;.5' calcMode='linear' repeatCount='indefinite')
        circle(cx='105' cy='15' r='15')
          animate(attributeName='r' from='15' to='15' begin='0s' dur='0.8s' values='15;9;15' calcMode='linear' repeatCount='indefinite')
          animate(attributeName='fill-opacity' from='1' to='1' begin='0s' dur='0.8s' values='1;.5;1' calcMode='linear' repeatCount='indefinite')

</template>

<script>

export default {
  name: 'ButtonElement',
  props: {
    tag: {
      type: String,
      default: 'button'
    },
    loader: {
      type: Boolean,
      default: false
    },
    modifier: {
      type: String,
      default: '1'
    }
  }
}
</script>

<style lang="scss" scoped>
  .v-enter-active, .v-leave-active {
    transition: opacity var(--animation-duration-1) ease-in-out;
  }
  .v-enter-from, .v-leave-to {
    opacity: 0;
  }

  .button {
    --radius: 10px;
    position: relative;
    display: inline-flex;
    justify-content: center;
    align-self: center;
    text-align: center;
    text-decoration: none;
    transition: color var(--trs-1);
    line-height: 62px;
    height: 62px;
    padding: 0 28px;
    border-radius: var(--radius);
    font-size: 18px;
    color: var(--color);
    &__background {
      position: absolute;
      width: 100%;
      height: 100%;
      z-index: 2;
      top: 0;
      left: 0;
      border-radius: var(--radius);
      background-color: var(--bg);
      transition: background-color var(--trs-1);
    }

    &__content {
      position: relative;
      z-index: 3;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: 0 14px;
    }

    &__loader {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 4;
      display: flex;
      svg {
        margin: auto;
        width: 60px;
      }
    }

    .icon {
      width: 16px;
      height: 16px;
    }

    --bg-hover: var(--bg);
    --color-hover: var(--color);

    &[data-touch], &[data-hover] {
      --bg: var(--bg-hover);
      --color: var(--color-hover);
    }

    &_type-1 {
      --bg: rgba(62, 62, 62, 0.8);
      --bg-hover: rgb(62, 62, 62);
      --color: var(--color-accent-1);
    }

    &_type-2 {
      --bg: rgba(255, 255, 255, 0.11);
      --bg-hover: rgba(255, 255, 255, 0.15);
      --color: var(--color-accent-1);
      --color-hover: #fff;
      &::before {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 15px;
        left: 0;
        z-index: 1;
        border-radius: var(--radius);
        background: linear-gradient(84.99deg, #515279 -9.03%, #8198B4 50.6%, #5C7152 114.56%);
        opacity: 0.6;
        filter: blur(25px);
        transition: opacity var(--trs-1);
        pointer-events: none;
      }
      &[data-touch], &[data-hover] {
        &::before {
          opacity: 1;
        }
      }
      &[disabled] {
        --color: var(--color-muted-1);
        cursor: not-allowed;
        &::before {
          opacity: 0;
        }
      }
    }
  }
</style>