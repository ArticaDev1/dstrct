<template lang="pug">
.navigation(v-show="visible")
  .navigation__overlay(@click="setActive(false)")
  .navigation__wrapper-background
  .navigation__wrapper(
    :class="{scrollable: active}"
    data-scroll-lock-scrollable)
    .navigation__head
      .navigation__head-container
      .navigation__head-line

    .navigation__content
      nav.navigation__nav
        ul.navigation__large-list.h3
          li.navigation__large-item
            router-link(:to="{name: 'portfolio'}").navigation__large-link Портфолио 
              SpriteIcon(:id="'caret-right'")
        ul.navigation__list.h4
          li.navigation__item
            router-link(
              :to="{name: 'main', hash: '#help-in-choosing-an-apartment'}"
              :class="{'router-link-anchor-active': $route.hash === '#help-in-choosing-an-apartment'}").navigation__anchor Помощь в выборе квартиры
          li.navigation__item
            router-link(
              :to="{name: 'main', hash: '#design-project'}"
              :class="{'router-link-anchor-active': $route.hash === '#design-project'}").navigation__anchor Эскизный дизайн-проект
          li.navigation__item
            router-link(:to="{name: 'equipment'}").navigation__link Комплектация
          li.navigation__item
            router-link(
              :to="{name: 'main', hash: '#help-in-choosing-builders'}"
              :class="{'router-link-anchor-active': $route.hash === '#help-in-choosing-builders'}").navigation__anchor Помощь в выборе строительной бригады
          li.navigation__item
            router-link(:to="{name: 'monitoring'}").navigation__link Авторский контроль

      ContactsList.h3

</template>

<script>
import { mapMutations, mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";
import debounce from "@/assets/js/debounce";
import { disablePageScroll, enablePageScroll }  from  'scroll-lock';

import ContactsList from "@/components/ContactsList";

export default {
  data() {
    return {
      animationProgress: 0,
      navElementsAnimationProgress: 0
    }
  },
  components: {
    ContactsList
  },
  computed: {
    ...mapState({
      active: state => state.navigation.active,
      visible: state => state.navigation.visible
    })
  },
  watch: {
    active(value) {
      if (value) this.show();
      else this.hide();
    }
  },
  mounted() {
    this.elements = {
      wrapper: this.$el.querySelector('.navigation__wrapper'),
      line: this.$el.querySelector('.navigation__head-line'),
      overlay: this.$el.querySelector('.navigation__overlay'),
      back: this.$el.querySelector('.navigation__wrapper-background'),
      elements: this.$el.querySelectorAll('.contacts-list__item, .navigation__item, .navigation__large-item'),
      logoPosDefault: document.querySelector('.header__logo'),
      logoPosInNav: document.querySelector('.navigation__head-container'),
      logo: document.querySelector('.main-logo')
    }
    
    this.updateAnimationDebounced = debounce(this.updateAnimation, 500, this);
    window.addEventListener('resize', this.updateAnimationDebounced);
  },
  methods: {
    ...mapMutations({
      setActive: 'navigation/ACTIVE',
      setVisibile: 'navigation/VISIBLE'
    }),
    createLogoAnimation() {
      const ld = this.elements.logoPosDefault.getBoundingClientRect().left;
      const ln = this.elements.logoPosInNav.getBoundingClientRect().left;
      const lt = ln - ld;

      return gsap.timeline()
        .fromTo(this.elements.logo, 
          { x: 0 }, 
          { x: lt, duration: sDur[3] })
    },
    createBackAnimation() {
      const ww = this.elements.wrapper.getBoundingClientRect().width;

      return gsap.timeline()
        .fromTo([this.elements.back, this.elements.overlay], 
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: sDur[3] })
        .fromTo(this.elements.back, 
          { css: { width: '100%' } }, 
          { css: { width: `${ww}px` }, duration: sDur[3] }, '<')
    },
    createFadeInAnimation() {
      return gsap.timeline()
        .fromTo(this.$el,
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: sDur[3] })
    },
    createWrapperAnimation() {
      return gsap.timeline()
        .fromTo(this.elements.wrapper, 
          { autoAlpha: 0 }, 
          { autoAlpha: 1, duration: sDur[2] })
    },
    createAnimation() {
      if (this.animation) this.killAnimation();

      this.navElementsAnimation = gsap.timeline({ paused: true })
        .fromTo(this.elements.line, 
          { xPercent: 100 }, 
          { xPercent: 0, duration: sDur[3], ease: 'power2.out' })
        .fromTo(this.elements.elements, 
          { x: 30, autoAlpha: 0 }, 
          { x: 0, autoAlpha: 1, duration: sDur[3], ease: 'power2.out',
            stagger: { each: sDur[3] * 0.1 } 
          }, '<')
        .eventCallback('onUpdate', () => {
          this.navElementsAnimationProgress = this.navElementsAnimation.progress();
        })

      this.animation = gsap.timeline({ paused: true })
        .addLabel('start')

      if (window.innerWidth >= this.$breakpoints.sm) {
        this.animation
          .add(this.createLogoAnimation(), 'start')
          .add(this.createBackAnimation(), 'start')
          .add(this.createWrapperAnimation(), `-=${sDur[2]}`)
      } else {
        this.animation
          .add(this.createFadeInAnimation(), 'start')
      }

      this.animation
        .eventCallback('onStart', () => {
          if (window.innerWidth < this.$breakpoints.sm) {
            this.navElementsAnimation.play();
          }
        }) 
        .eventCallback('onReverseComplete', () => {
          enablePageScroll();
          this.setVisibile(false);
        })
        .eventCallback('onUpdate', () => {
          this.animationProgress = this.animation.progress();
        })
        .eventCallback('onComplete', () => {
          if (window.innerWidth >= this.$breakpoints.sm) {
            this.navElementsAnimation.play();
          }
        })
    },
    killAnimation() {
      const elements = [];
      elements.push(this.$el);
      for (let key in this.elements) {
        elements.push(this.elements[key]);
      }
      this.animation.kill();
      this.navElementsAnimation.kill();
      gsap.set(elements, {clearProps: "all"});
    },
    updateAnimation() {
      this.$nextTick(() => {
        if (!this.animation || this.animationProgress === 0) return;

        this.createAnimation();
        this.animation.progress(this.animationProgress, true);
        this.navElementsAnimation.progress(this.navElementsAnimationProgress, true);
  
        if (this.active && this.animationProgress !== 1) {
          this.animation.play();
        } else if (!this.active) {
          this.animation.reverse();
        }
      })
    },
    show() {
      this.setVisibile(true);
      this.$nextTick(() => {

        if (this.animationProgress == 0) {
          disablePageScroll();
          if (this.animation) this.killAnimation();
          this.createAnimation();
        }

        this.animation.play();
      })
    },
    hide() {
      this.animation.reverse();
    }
  }
}
</script>

<style lang="scss" scoped>
.navigation {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 1000;
  &__overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: var(--color-overlay);
  }
  &__wrapper {
    --pl: 90px;
    position: absolute;
    z-index: 3;
    width: calc(var(--content-fields-width) + 470px);
    height: 100%;
    right: 0;
    top: 0;
    overflow-x: hidden;
    overflow-y: scroll;
    display: flex;
    flex-direction: column;
    align-items: stretch;
  }
  &__wrapper-background {
    position: absolute;
    z-index: 2;
    height: 100%;
    top: 0;
    right: 0;
    background-color: var(--color-base-background);
  }
  &__head {
    position: sticky;
    top: 0;
    flex: 0 0 auto;
    padding-right: var(--content-fields-width);
    padding-top: var(--header-top-padding);
    padding-left: var(--pl);
    padding-bottom: calc(var(--header-top-padding) - 10px);
    background-color: var(--color-base-background);
    z-index: 2;
  }
  &__head-container {
    height: var(--header-height);
  }
  &__head-line {
    display: block;
    position: absolute;
    width: calc(100% - var(--pl));
    height: 1px;
    left: var(--pl);
    bottom: 0;
    background-color: var(--color-borders);
  }
  &__contacts {
    --font-size: 28px;
  }
  &__content {
    padding: 40px var(--content-fields-width) 95px var(--pl);
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 40px;
  }
  &__nav {
    display: flex;
    flex-direction: column;
    gap: 35px;
  }
  &__large-list {
    margin: 0 !important;
  }
  &__large-item {
    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }
  &__large-link {
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 20px;
    color: var(--color-accent-1);
    transition: color var(--trs-1), gap var(--trs-1);
    .icon {
      width: 9px;
      height: 16px;
    }
    &[data-touch], &[data-hover] {
      &:not(.router-link-active) {
        color: var(--color-accent-2);
        gap: 30px;
      }
    }
    &.router-link-active {
      cursor: default;
      color: var(--color-active-1);
    }
  }
  &__list {
    margin: 0 !important;
  }
  &__item {
    &:not(:last-child) {
      margin-bottom: 22px;
    }
  }
  &__link, &__anchor {
    display: block;
    text-decoration: none;
    color: var(--color-base);
    &[data-touch], &[data-hover] {
      color: var(--color-accent-2);
    }
  }
  &__link {
    &.router-link-active {
      cursor: default;
      color: var(--color-active-1);
    }
  }
  &__anchor {
    &.router-link-anchor-active {
      cursor: default;
      color: var(--color-active-1);
    }
  }
  @include media-breakpoint-down(xxl) {
    &__content {
      padding-bottom: 60px;
    }
    &__nav {
      gap: 30px;
    }
    &__item {
      &:not(:last-child) {
        margin-bottom: 18px;
      }
    }
    &__wrapper {
      --pl: 60px;
    }
  }
  @include media-breakpoint-down(lg) {
    &__content {
      padding-top: 90px;
      padding-bottom: 100px;
      gap: 80px;
    }
    &__nav {
      gap: 34px;
    }
    &__item {
      &:not(:last-child) {
        margin-bottom: 22px;
      }
    }
    &__wrapper {
      --pl: 70px;
    }
  }
  @include media-breakpoint-down(sm) {
    background-color: var(--color-base-background);
    &__wrapper-background, &__overlay {
      display: none;
    }
    &__wrapper {
      width: 100%;
    }
    &__head {
      padding: var(--header-top-padding) var(--container-padding-x) 30px var(--container-padding-x);
      &-line {
        width: calc(100% - var(--container-padding-x));
        left: var(--container-padding-x);
      }
    }
    &__content {
      padding: 35px var(--container-padding-x) 60px var(--container-padding-x);
      gap: 50px;
    }
    &__item {
      &:not(:last-child) {
        margin-bottom: 18px;
      }
    }
  }
}
</style>