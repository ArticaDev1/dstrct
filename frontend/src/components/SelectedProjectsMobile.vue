<template lang="pug">
.projects

  SmallSectionTitle.projects__title Selected projects

  .projects__slider
    Swiper(
      :touchStartPreventDefault="false"
      :shortSwipes="false"
      :longSwipesMs="100"
      :longSwipesRatio="0.1"
      :speed="$duration.ms[3]"
      :slides-per-view="'auto'"
      @transitionStart="transition = true"
      @transitionEnd="transition = false"
      @touchStart="touched = true"
      @touchEnd="touched = false")

      SwiperSlide.project(v-for="project in projects")
        .project__content
          ProjectLinkImage.project__image(
            :to="{name: 'project', params: {id: project.slug}}"
            :size="'64%'")
            img(:data-src="project.image" alt="alt").lazyload.lazypreload
          .project__shadow.image
            img.lazyload.lazypreload(
              :data-src="require('@/assets/img/blurproject.png')" 
              alt="background")

</template>

<script>
import ProjectLinkImage from "@/components/ProjectLinkImage";

import { Swiper, SwiperSlide } from 'swiper/vue/swiper-vue';
import 'swiper/swiper.scss';
import '@/assets/scss/components/swiper.scss';

export default {
  components: {
    Swiper, 
    SwiperSlide,
    ProjectLinkImage
  },
  props: {
    projects: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      touched: false,
      transition: false
    }
  },
  computed: {
    active() {
      return this.touched || this.transition;
    }
  },
  watch: {
    active(value) {
      if (value) {
        if (this.disactivationTimeout) {
          clearTimeout(this.disactivationTimeout);
          delete this.disactivationTimeout;
        }
        this.$emit('activation');
      } else {
        this.disactivationTimeout = setTimeout(() => {
          this.$emit('disactivation');
        }, 2000) 
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.projects {
  padding: 60px 0 120px 0;
  --gap: 160px;
  --size: 410px;
  &__title {
    position: relative;
    display: inline-block;
    &::after {
      content: '';
      display: block;
      position: absolute;
      height: 1px;
      width: calc(var(--page-width) - 100% - var(--grid-gutter-width) - var(--content-fields-width));
      background-color: var(--color-borders);
      top: 50%;
      left: calc(100% + var(--grid-gutter-width));
    }
  }
  .swiper-wrapper {
    transition-timing-function: ease-out;
  }
  .swiper {
    overflow: visible;
    width: calc(100% + var(--gap));
    margin-left: calc(var(--gap) / -2);
  }
  .swiper-slide {
    width: calc(var(--size) + var(--gap));
    padding: 0 calc(var(--gap) / 2);
  }
  @include media-breakpoint-down(md) {
    --gap: 120px;
    --size: 360px;
    padding: 100px 0;
    &__title {
      display: none;
    }
  }
  @include media-breakpoint-down(sm) {
    --gap: calc(var(--content-width) * 0.2);
    --size: calc(var(--content-width) * 0.75);
  }
}

.project {
  &__content {
    position: relative;
  }
  &__image {
    z-index: 2;
    --overlay: 0.2;
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
}
</style>