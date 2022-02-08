<template lang="pug">
.projects(
  :class="{active: active}")
  h2.projects__title Лучшие проекты
  .projects__wrapper(ref="wrapper")
    SmallSectionTitle.projects__small-title Лучшие проекты
      span.projects__small-title-line
    .projects__container
      .projects__content

        .projects__activation-area(
          v-show="!active"
          @click="activateTrigger"
          data-custom-interaction
          data-cursor='selectedProjects')
          
        .project(v-for="(project, index) in projects")
          .project__image
            ProjectLinkImage.project__image-front(
              @click="startLeaveAnimation(index)"
              :to="{name: 'project', params: {id: project.slug}}"
              :image="project.image")
            .project__shadow.image
              img.lazyload(
                :data-src="require('@/assets/img/blurproject.png')" 
                alt="background")
          .project__title {{project.name}}
</template>

<script>
import { mapMutations } from 'vuex';
import ProjectLinkImage from "@/components/ProjectLinkImage";
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  components: {
    ProjectLinkImage
  },
  props: {
    active: {
      type: Boolean,
      required: true
    },
    projects: {
      type: Array,
      required: true
    }
  },
  emits: ['activation', 'disactivation'],
  data() {
    return {
      xMouseValue: 0,
      xPos: 0,
      inview: false,
      closestActivationIndex: 0,
      activationAnimationProgress: 0,
      activationAnimation: undefined,
      disactivationAnimation: undefined,
      disactivationAnimationProgress: 0,
    }
  },
  watch: {
    inview(value) {
      if (!value) this.$emit('disactivation');
    },
    active(value) {
      if (value) this.activateSlider();
      else this.disactivateSlider();
    }
  },
  mounted() {
    this.elements = {
      $content: this.$el.querySelector('.projects__content'),
      $projects: this.$el.querySelectorAll('.project'),
      $images: this.$el.querySelectorAll('.project__image'),
      $titles: this.$el.querySelectorAll('.project__title'),
      $smallTitle: this.$el.querySelector('.projects__small-title'),
      $line: this.$el.querySelector('.projects__small-title-line'),
      $largeTitle: this.$el.querySelector('.projects__title')
    }

    if (this.active) {
      this.createActivationAnimation();
      this.activationAnimation.progress(1);
    } else {
      this.createDisactivationAnimation();
      this.disactivationAnimation.progress(1);
    }

    window.addEventListener('resize', this.updateActivationAnimation);
    window.addEventListener('resize', this.updateDisactivationAnimation);
    window.addEventListener('mousemove', this.checkMouseValue);
    document.addEventListener('click', this.clickOver);
    this.createObserver();
    this.checkSliderPosition();
  },
  unmounted() {
    if (this.leaveAnimation) this.leaveAnimation.kill();
    if (this.disactivationAnimation) this.disactivationAnimation.kill();
    if (this.activationAnimation) this.activationAnimation.kill();
    window.removeEventListener('resize', this.updateActivationAnimation);
    window.removeEventListener('resize', this.updateDisactivationAnimation);
    window.removeEventListener('mousemove', this.checkMouseValue);
    document.removeEventListener('click', this.clickOver);
    cancelAnimationFrame(this.sliderPosAnimFrame);
    this.observer.disconnect();
  },
  methods: {
    ...mapMutations({
      setLeaveDelay: 'transition/LEAVE_DELAY'
    }),
    createObserver() {
      this.observer = new IntersectionObserver((entries) => {
        this.inview = entries[0].isIntersecting;
      });
      this.observer.observe(this.$el);
    },
    checkMouseValue(event) {
      const pw = this.elements.$projects[0].getBoundingClientRect().width;
      const w = this.$el.getBoundingClientRect().width - pw;
      const x = this.$el.getBoundingClientRect().left + pw / 2;
      const val = (event.clientX - x) / w;
      this.xMouseValue = Math.min(1, Math.max(0, val));
    },
    checkSliderPosition() {
      if (this.inview) {
        const w1 = this.$el.getBoundingClientRect().width;
        const w2 = this.elements.$content.getBoundingClientRect().width;
        this.xPos += ((w1 - w2) * this.xMouseValue - this.xPos) * 0.05;
        gsap.set(this.elements.$content, {x: this.xPos})
      }
      this.sliderPosAnimFrame = requestAnimationFrame(this.checkSliderPosition);
    },
    createActivationAnimation() {
      const from = this.closestActivationIndex;
      const imageScale = 1.12;
      const projectWidth = this.elements.$projects[0].getBoundingClientRect().width;
      const projectHeight = this.elements.$projects[0].getBoundingClientRect().height;
      const titleSize = this.elements.$titles[0].getBoundingClientRect().height;
      const imageResizeX = ( ( projectWidth * imageScale ) - projectWidth ) / 2;
      const imageResizeY = ( ( projectHeight * imageScale ) - projectHeight ) / 2;
      const containerPaddingBottom = imageResizeY + titleSize;

      this.activationAnimation = gsap.timeline({ 
        paused: true,
        defaults: {
          duration: sDur[4]
        }
      })
        .to(this.elements.$line, 
          { scaleX: 0, xPercent: -50, duration: sDur[3], ease: 'power2.out' })
        .to(this.elements.$smallTitle, 
          { y: -40, duration: sDur[3], autoAlpha: 0, ease: 'power2.in' }, `-=0.2`)
        
        .to(this.elements.$largeTitle, 
          { y: 0, duration: sDur[4], autoAlpha: 1, ease: 'power2.out' })
        .to(this.elements.$images, 
          { scale: imageScale, stagger: { each: 0.15, from: from } }, `-=${sDur[4] + 0.25}`)
        .to(this.elements.$titles, 
          { y: imageResizeY, stagger: { each: 0.15, from: from } }, '<')
        .to(this.elements.$content, 
          { css: {'padding': `${imageResizeY}px ${imageResizeX}px ${containerPaddingBottom}px ${imageResizeX}px`} }, '<')
        
        .fromTo(this.elements.$titles, 
          { x: -imageResizeX + 30 },
          { x: -imageResizeX, ease: 'power2.out', autoAlpha: 1, stagger: { each: 0.15, from: from } }, `-=${sDur[4]}`)
        .eventCallback('onUpdate', () => {
          this.activationAnimationProgress = this.activationAnimation.progress();
        })
    },
    createDisactivationAnimation() {
      const heightTitle = this.elements.$smallTitle.getBoundingClientRect().height;
      const paddingContainerTop = heightTitle + 30;

      this.disactivationAnimation = gsap.timeline({ 
        paused: true,
        defaults: {
          duration: sDur[4]
        }
      })
        .to(this.elements.$largeTitle, { y: 40, autoAlpha: 0 })
        .to(this.elements.$smallTitle, { y: 0, autoAlpha: 1 }, '<')
        .to(this.elements.$line, { scaleX: 1, xPercent: 0 }, '<')
        .to(this.elements.$images, { scale: 1 }, '<')
        .to(this.elements.$titles, { autoAlpha: 0, x: 0, y: 0 }, '<')
        .to(this.elements.$titles, { autoAlpha: 0, x: 0, y: 0 }, '<')
        .to(this.elements.$content, 
          { css: { 'padding': `${paddingContainerTop}px 0 0 0` } }, '<')
        .eventCallback('onUpdate', () => {
          this.disactivationAnimationProgress = this.disactivationAnimation.progress();
        })
    },
    updateActivationAnimation() {
      if (!this.activationAnimation || !this.active) return;
      this.createActivationAnimation();
      this.activationAnimation.progress(this.activationAnimationProgress);
    },
    updateDisactivationAnimation() {
      if (!this.disactivationAnimation || this.active) return;
      this.createDisactivationAnimation();
      this.disactivationAnimation.progress(this.disactivationAnimationProgress);
    },
    findClosestActivationIndex(clickXValue) {
      const centersOfElements = [];
      for (const $element of this.elements.$images) {
        const elWidth = $element.getBoundingClientRect().width;
        const elPosLeft = $element.getBoundingClientRect().left;
        centersOfElements.push( 
          Math.round( 
            Math.abs(clickXValue - (elPosLeft + elWidth / 2)) 
          )
        );
      }
      for (const value in centersOfElements) {
        if (centersOfElements[value] == Math.min(...centersOfElements)) {
          this.closestActivationIndex = value;
          break;
        }
      }
    },
    activateTrigger(event) {
      if (this.active) return;
      this.findClosestActivationIndex(event.clientX);
      this.$emit('activation');
    },
    activateSlider() {
      if (this.disactivationAnimation.isActive()) {
        this.disactivationAnimation.pause();
      }
      this.createActivationAnimation();
      this.activationAnimation.play();
    },
    disactivateSlider() {
      if (this.activationAnimation.isActive()) {
        this.activationAnimation.pause();
      }
      this.createDisactivationAnimation();
      this.disactivationAnimation.play();
    },
    startLeaveAnimation(indexFrom) {
      const delay = sDur[3];
      this.setLeaveDelay(delay);

      this.leaveAnimation = gsap.timeline({defaults: {
        duration: sDur[3]
      }})
        .to(this.elements.$projects, 
          { scale: 0.75, ease: 'power2.in', stagger: { each: 0.1, from: indexFrom } })
        .to(this.elements.$projects,
          { autoAlpha: 0, stagger: { each: 0.1, from: indexFrom } }, '<')
    },
    clickOver(event) {
      if (this.active && !this.$refs.wrapper.contains(event.target) && !event.target.closest('a, button') && event.target.closest('main')) {
        this.$emit('disactivation');
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.projects {
  position: relative;
  padding: 80px 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: stretch;
  &__wrapper {
    position: relative;
    pointer-events: none;
  }
  &__container {
    display: flex;
  }
  &__activation-area {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 2;
    cursor: pointer;
    pointer-events: all;
    &[data-touch], &[data-hover] {
      & ~ .project .project__image-front {
        &::after {
          opacity: var(--overlay-hover);
        }
      }
    }
  }
  &__content {
    position: relative;
    display: flex;
    flex-shrink: 0;
    gap: 10vw;
  }
  &__small-title {
    margin: 0 !important;
    position: absolute;
    left: 0;
    top: 0;
  }
  &__small-title-line {
    position: absolute;
    height: 1px;
    width: calc(var(--page-width) - 100% - var(--grid-gutter-width) - var(--content-fields-width));
    background-color: var(--color-borders);
    top: 50%;
    left: calc(100% + var(--grid-gutter-width));
  }
  &__title {
    position: absolute;
    bottom: 100%;
    left: 0;
    margin: 0 !important;
    font-size: 36px;
  }
  @include media-breakpoint-down(xxl) {
    padding: 60px 0 40px 0;
    &__title {
      font-size: 30px;
    }
  }
}

.project {
  width: 26vw;
  flex-shrink: 0;
  position: relative;
  pointer-events: all;
  &__image {
    will-change: transform;
  }
  &__image-front {
    --image-size: 64%;
    --overlay: 0.2;
    z-index: 2;
  }
  &__shadow {
    pointer-events: none;
    position: absolute;
    width: 220%;
    height: 270%;
    top: -85%;
    left: -38%;
    img {
      height: 100%;
    }
  }
  &__title {
    position: absolute;
    top: 100%;
    padding-top: 16px;
    color: var(--color-accent-1);
  }
  @include media-breakpoint-down(xxl) {
    width: 380px;
  }
}
</style>