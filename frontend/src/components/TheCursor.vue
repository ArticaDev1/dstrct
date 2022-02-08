<template lang="pug">
.cursor

  transition(
    @leave="hideCursor"
    @enter="showCursor")
    .cursor-element.cursor-eye(v-if="watchProject")
      SpriteIcon.cursor-eye__icon(
        :id="'eye-watch'")
      .cursor-eye__text Смотреть<br> проект

  transition(
    @leave="hideCursor"
    @enter="showCursor")
    .cursor-element.cursor-eye(v-if="selectedProjects")
      SpriteIcon.cursor-eye__icon(
        :id="'eye-zoom-in'")
      .cursor-eye__text Лучшие<br> проекты

</template>

<script>
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  data() {
    return {
      attr: 'data-cursor',
      type: '',
      visible: false,
      mouseX: 0,
      mouseY: 0,
      xPos: 0,
      yPos: 0,
      smoothingFactor: 0.2
    }
  },
  computed: {
    ...mapState({
      onLeaveStart: state => state.transition.leaveStart,
    }),
    cursorIsVisible() {
      return this.mouseX && this.mouseY && this.visible;
    },
    watchProject() {
      return this.cursorIsVisible && this.type == 'watchProject';
    },
    selectedProjects() {
      return this.cursorIsVisible && this.type == 'selectedProjects';
    }
  },
  watch: {
    onLeaveStart(value) {
      if (value) this.visible = false;
    }
  },
  methods: {
    checkCursorType(target) {
      if (target == document ||
        target.closest(`[${this.attr}]`) !== target) {
        return false;
      } else {
        return target.getAttribute(this.attr) || 'default';
      }
    },
    checkMousePosition(event) {
      this.mouseX = event.clientX;
      this.mouseY = event.clientY;
    },
    checkTargetMouseenter(event) {
      const type = this.checkCursorType(event.target);
      if (!type) return;

      this.type = type;
      this.visible = true;
    },
    checkTargetMouseleave(event) {
      const type = this.checkCursorType(event.target);
      if (!type) return;

      this.visible = false;
    },
    checkCursorPosition() {
      this.xPos += (this.mouseX - this.xPos) * this.smoothingFactor;
      this.yPos += (this.mouseY - this.yPos) * this.smoothingFactor;

      gsap.set(this.$el, 
        { x: this.xPos, y: this.yPos });
      
      this.cursorMotionFrame = requestAnimationFrame(this.checkCursorPosition);
    },
    showCursor(el) {
      const icon = el.querySelector('.icon');
      el.animation = gsap.timeline({ defaults: { duration: sDur[2] } })
        .fromTo(el, 
          { autoAlpha: 0 }, 
          { autoAlpha: 1 })
        .fromTo(icon, 
          { scale: 0 }, 
          { scale: 1, ease: 'power2.out' }, '<')
    },
    hideCursor(el, done) {
      el.animation
        .duration(sDur[1])
        .reverse()
        .eventCallback('onReverseComplete', done);
    }
  },
  created() {
    document.addEventListener('mousemove', this.checkMousePosition);
  },
  mounted() {
    this.checkCursorPosition();
    document.addEventListener('custom:mouseenter', this.checkTargetMouseenter, true);
    document.addEventListener('custom:mouseleave', this.checkTargetMouseleave, true);
    
  }
}
</script>

<style lang="scss" scoped>
  .cursor {
    position: fixed;
    z-index: 1000;
    pointer-events: none;
    &__inner {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.5);
      margin-top: -30px;
      margin-left: -30px;
    }
  }

  .cursor-eye {
    --width: 133px;
    --height: calc(var(--width) * 0.52);
    top: calc(var(--height) / -2);
    left: calc(var(--width) / -2);
    position: absolute;
    &__icon {
      width: var(--width);
      height: var(--height);
      color: rgba(255, 255, 255, 0.35);
    }
    &__text {
      position: absolute;
      width: 100%;
      top: calc(100% + 15px);
      font-size: 12px;
      text-align: center;
      line-height: 1.3;
    }
    @include media-breakpoint-down(xxl) {
      --width: 110px;
    }
  }
</style>