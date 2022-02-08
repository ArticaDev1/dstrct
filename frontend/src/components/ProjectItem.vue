<template lang="pug">
section.section.project-item(:class="`project-item_${index}`")
  BackgroundFigure.project-item__figure(
    v-if="figure"
    :name="figure"
    :class="`project-item__figure_${figure}`")
  .container
    .row.project-item__row
      .col-10.offset-2.col-md-8.offset-md-1.col-xl-8.offset-xl-2(
        data-aos="zoom-in" 
        data-aos-duration="500"
        :data-aos-anchor="`.project-item_${index}`")
        ProjectLinkImage.project-item__image.image-size-side.image-size-md-normal(
          ref="image"
          @click="startLeaveAnimation"
          :to="{name: 'project', params: {id: slug}}"
          :image="image")
          
      .col-md-2.offset-md-1.col-xl-1.d-none.d-md-block(
        data-aos="zoom-in-left" 
        data-aos-duration="500"
        :data-aos-anchor="`.project-item_${index}`")
        .project-item__image.project-item__side-image.image-content.image.image_cover.image-size-md-side(ref="sideImage")
          img.lazyload(
            :data-src="image2"
            alt="image")

      h2.col-10.col-lg-7.project-item__title(
        data-aos="fade-right" 
        data-aos-duration="500" 
        :data-aos-anchor="`.project-item_${index}`")
        h2.h1.font-accent(ref="title") {{name}}
      
      .col-sm-10.offset-sm-2.col-md-6.col-xl-4.offset-xl-5.project-item__params-list
        ParamsList(:items="attributes")

</template>

<script>
import { mapMutations } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";
import { disablePageScroll }  from  'scroll-lock';
import ProjectLinkImage from "@/components/ProjectLinkImage";
import ParamsList from '@/components/ParamsList';

export default {
  components: {
    ProjectLinkImage,
    ParamsList
  },
  props: {
    projects: {
      type: Array,
      required: true
    },
    index: {
      type: Number,
      required: true
    }
  },
  computed: {
    image() {
      return this.projects[this.index].preview_images[0];
    },
    name() {
      return this.projects[this.index].name;
    },
    image2() {
      return this.projects[this.index].preview_images[1];
    },
    slug() {
      return this.projects[this.index].slug;
    },
    figure() {
      const figures = ['15', '16', '17'];
      let figuresIndex = 0;
      for (let index in this.projects) {
        if (index % 3 === 0) {
          if (index == this.index) {
            return figures[figuresIndex];
          }
          figuresIndex = figuresIndex == figures.length - 1 ? 0 : figuresIndex + 1;
        }
      }
    },
    attributes() {
      const attributes = [[]];
      for (let attribute of this.projects[this.index].preview_attributes) {
        attributes[0].push(attribute.value)
      }
      return attributes;
    }
  },
  methods: {
    ...mapMutations({
      setLeaveDelay: 'transition/LEAVE_DELAY',
      setLeaveDuration: 'transition/LEAVE_DURATION',
      setEnterDuration: 'transition/ENTER_DURATION',
      setProjectTransition: 'transition/PROJECT_TRANSITION'
    }),
    startLeaveAnimation() {
      if (window.innerWidth < this.$breakpoints.xl) return;

      disablePageScroll();
      //timing
      const delay = sDur[2];
      const duration = sDur[4] - sDur[2];
      //create fixed image
      const fixedImage = document.createElement('img');
      fixedImage.setAttribute('src', this.image);
      fixedImage.style.cssText = `
        object-fit: cover;
        position: fixed;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
      `;
      document.querySelector('.wrapper').insertAdjacentElement('afterbegin', fixedImage);
      //change global animation timing
      this.setLeaveDelay(delay);
      this.setLeaveDuration(duration);
      this.setEnterDuration(0);

      this.$refs.image.$el.classList.add('clear');
      
      const yValue = this.$refs.image.$el.getBoundingClientRect().top,
            xValue = this.$refs.image.$el.getBoundingClientRect().left,
            wValue = this.$refs.image.$el.getBoundingClientRect().width,
            hValue = this.$refs.image.$el.getBoundingClientRect().height,
            w2Value = this.$el.getBoundingClientRect().width;

      this.leaveAnimation = gsap.timeline()
        .to([this.$refs.title, this.$refs.sideImage],
          { autoAlpha: 0, duration: delay })
        .to(this.$refs.title, 
          { x: -50, duration: delay, ease: 'power2.in' }, '<')
        .to(this.$refs.sideImage, 
          { x: 50, duration: delay, ease: 'power2.in' }, '<')

        .set(fixedImage, 
          { autoAlpha: 1 })
        .fromTo(fixedImage, 
          { x: xValue, y: yValue },
          { x: 0, y: 0, duration: duration })
        .fromTo(fixedImage, 
          { css: { width: `${wValue}px`, height: `${hValue}px` } },
          { css: { width: `${w2Value}px`, height: `${window.innerHeight}px` }, duration: duration }, '<')

      this.setProjectTransition({ image: fixedImage });
    }
  }
}
</script>

<style lang="scss" scoped>
.project-item {
  position: relative;
  &__figure {
    &_15 {
      width: 86%;
      top: 0;
      left: 0;
      transform: translateY(-15%);
    }
    &_16 {
      width: 100%;
      top: 0;
      left: 0;
      transform: translateY(-35%);
    }
    &_17 {
      width: 80%;
      top: 0;
      left: 5%;
      transform: translateY(-15%);
    }
  }
  &__row {
    position: relative;
  }
  &__image {
    --overlay: 0.4;
    --image-size: 70%;
    &.clear {
      --overlay: 0;
      --overlay-hover: 0;
    }
  }
  &__side-image {
    height: 100%;
    &::after {
      padding: 0;
      height: 100%;
    }
  }
  &__title {
    margin: 0 !important;
    position: absolute;
    z-index: 2;
    top: 20%;
    min-height: calc(2em * var(--title-h1-line-height));
    display: flex;
    flex-direction: column;
    justify-content: center;
    pointer-events: none;
  }
  &__params-list {
    margin-top: 20px;
  }
  @include media-breakpoint-down(sm) {
    &__figure {
      &_15 {
        width: 150%;
        transform: translateY(-30%);
      }
      &_17 {
        width: 140%;
        left: -20%;
      }
    }
  }
}
</style>