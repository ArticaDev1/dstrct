<template lang="pug">
Transition(
  @enter="show"
  @leave="hide")
  .modal(v-show="visible" data-scroll-lock-scrollable)
    .modal-close-area(@click="$emit('close')")
    .modal-block
      BackgroundFigure.modal-block__figure(:name="'19'")
      SpriteIcon.modal-close-icon(:id="'close'" v-if="closeIcon")
      slot
</template>

<script>
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";
import { disablePageScroll, enablePageScroll }  from  'scroll-lock';

export default {
  props: {
    visible: {
      type: Boolean,
      default: false
    },
    closeIcon: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close'],
  computed: {
    ...mapState({
      onLeave: state => state.transition.leaveStart
    })
  },
  watch: {
    onLeave(value) {
      if (value) this.$emit('close');
    }
  },
  methods: {
    show(el) {
      disablePageScroll();
      const block = el.querySelector('.modal-block');
      el.animation = gsap.timeline()
        .fromTo(el, { autoAlpha: 0 }, { autoAlpha: 1, duration: sDur[3] })
        .eventCallback('onStart', () => {
          gsap.fromTo(block, { y: 30, scale: 0.9 }, { y: 0, scale: 1, ease: 'power2.out', duration: sDur[3] })
        });
    },
    hide(el, done) {
      el.animation.reverse().eventCallback('onReverseComplete', () => {
        enablePageScroll();
        done();
      });
    }
  }
}
</script>

<style lang="scss" scoped>
.modal {
  position: fixed;
  z-index: 2000;
  width: var(--window-width);
  height: 100%;
  top: 0;
  left: 0;
  overflow-x: hidden;
  overflow-y: scroll;
  padding: 60px var(--content-fields-width);
  display: flex;
  background-color: var(--color-overlay);
  @include media-breakpoint-down(sm) {
    padding: 60px 16px;
  }
}

.modal-close-icon {
  position: absolute;
  top: 0;
  left: calc(100% + 20px);
  width: 22px;
  height: 22px;
  color: var(--color-accent-1);
  pointer-events: none;
  @include media-breakpoint-down(lg) {
    bottom: calc(100% + 20px);
    right: 0;
    left: initial;
    top: initial;
  }
  @include media-breakpoint-down(sm) {
    bottom: calc(100% + 14px);
  }
}

.modal-close-area {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  cursor: pointer;
}

.modal-block {
  background-color: var(--color-base-background);
  border-radius: 30px;
  position: relative;
  margin: auto;
  will-change: transform;
  &__figure {
    width: 100%;
    height: 100%;
    object-fit: cover;
    top: 0;
    left: 0;
  }
  @supports(mix-blend-mode: multiply) {
    &::before {
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
  @include media-breakpoint-down(sm) {
    width: 100%;
  }
}
</style>