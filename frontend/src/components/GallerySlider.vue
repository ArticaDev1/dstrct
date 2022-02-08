<template lang="pug">
.gallery-slider.row
  .col-10.offset-1.col-md-8.offset-md-2
    .gallery-slider__inner  
      button.gallery-slider__control.gallery-slider__control_prev(@click="slidePrev" type="button")
        SpriteIcon.gallery-slider__control-icon(:id="'arrow-left'")
      button.gallery-slider__control.gallery-slider__control_next(@click="slideNext" type="button")
        SpriteIcon.gallery-slider__control-icon(:id="'arrow-right'")

      Swiper(
        :modules="modules"
        :touchStartPreventDefault="false"
        :shortSwipes="false"
        :longSwipesMs="100"
        :longSwipesRatio="0.1"
        :loop="true"
        :loopedSlides="2"
        :lazy="{loadPrevNext: true}"
        :slides-per-view="1"
        :speed="$duration.ms[3]"
        @swiper="onSwiper")
        SwiperSlide(v-for="image in images")
          .image-content.image.image_cover
            img.swiper-lazy(
              :data-src="image"
              alt="image")
</template>

<script>
import { Lazy } from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue/swiper-vue';
import 'swiper/swiper.scss';
import '@/assets/scss/components/swiper.scss';

export default {
  components: {
    Swiper, 
    SwiperSlide
  },
  props: {
    images: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      swiper: undefined,
      modules: [Lazy]
    }
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper;
    },
    slideNext() {
      this.swiper.slideNext();
    },
    slidePrev() {
      this.swiper.slidePrev();
    }
  }
}
</script>

<style lang="scss">
.gallery-slider {
  --gap: calc((var(--content-width) - var(--grid-gutter-width) * 11) / 12 + var(--grid-gutter-width) * 2);
  &__inner {
    position: relative;
  }
  &__control {
    --size: 40px;
    position: absolute;
    z-index: 2;
    top: calc(50% - var(--size) / 2);
    color: var(--color-muted-1);
    transition: color var(--trs-1);
    &-icon {
      width: 34px;
      height: 34px;
    }
    &_prev {
      right: calc(100% + 30px);
    }
    &_next {
      left: calc(100% + 30px);
    }
    &[data-touch], &[data-hover] {
      color: var(--color-accent-1);
    }
  }

  .swiper {
    overflow: visible;
    width: calc(100% + var(--gap));
    margin-left: calc(var(--gap) / -2);
  }
  
  .swiper-slide {
    padding: 0 calc(var(--gap) / 2);
    transition: opacity var(--trs-3);
    opacity: 0.25;
    &-active, &-duplicate-active {
      opacity: 1;
    }
  }
  
  .image-content {
    --image-size: 66%;
  }

  @include media-breakpoint-down(md) {
    &__control {
      &-icon {
        width: 22px;
        height: 22px;
      }
      &_prev {
        right: calc(100% + 20px);
      }
      &_next {
        left: calc(100% + 20px);
      }
    }
  }

  @include media-breakpoint-down(sm) {
    &__control {
      &-icon {
        width: 22px;
        height: 22px;
      }
      &_prev {
        right: calc(100% + 12px);
      }
      &_next {
        left: calc(100% + 12px);
      }
    }

    .image-content {
      --image-size: 135%;
    }
  }

}
</style>