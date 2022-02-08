<template lang="pug">
div(:class="[`gallery-${type}`, { 'container-fluid': hasContainerFluid, 'container': hasContainer }]")
  
  template(v-if="type === '1n'")
    div(
      :class="`gallery-${type}__image`")
      GalleryImage(:image="filteredImages[0]" :type="type" :lazyload="lazyload")

  .row.row-gap-20.justify-content-center(v-else-if="hasGrid")

    template(v-if="type === '2n_1'")
      .col-sm-6(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(:image="image" data-aos="zoom-in" :data-aos-delay="100 * index")

    template(v-else-if="type === '2n_2_left' || type === '2n_2_right'")
      .col-6.col-sm-5(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(:image="image" data-aos="zoom-in" :data-aos-delay="100 * index")

    template(v-else-if="type === '3n_1'")
      .col-sm-4(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(
          data-aos="fade-up-right"
          :data-aos-delay="(filteredImages.length - 1) * 100 - 100 * index"
          :image="image")

    template(v-else-if="type === '3n_2'")
      .col-sm-4(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(
          data-aos="fade-up-left"
          :data-aos-delay="100 * index"
          :image="image")

    template(v-else-if="type === '4n_1'")
      .col-6.col-md-3(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(
          data-aos="fade-up-right"
          :data-aos-delay="(filteredImages.length - 1) * 100 - 100 * index"
          :image="image")

    template(v-else-if="type === '4n_2'")
      .col-6.col-md-3(:class="`gallery-${type}__image`" v-for="(image, index) in filteredImages")
        GalleryImage(
          data-aos="fade-up-left" 
          :data-aos-delay="100 * index" 
          :image="image")

</template>

<script>
import GalleryImage from '@/components/GalleryImage';


export default {
  components: {
    GalleryImage
  },
  props: {
    type: {
      type: String,
      required: true
    },
    images: {
      type: Array, 
      required: true
    },
    lazyload: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    maxLength() {
      return +this.type[0];
    },
    filteredImages() {
      return this.images.filter((image, index) => index < this.maxLength);
    },
    hasContainer() {
      return this.type === '2n_2_left' || this.type === '2n_2_right';
    },
    hasContainerFluid() {
      return this.type === '2n_1' || 
             this.type === '3n_1' || 
             this.type === '3n_2' || 
             this.type === '4n_1' || 
             this.type === '4n_2';
    },
    hasGrid() {
      return this.hasContainer || this.hasContainerFluid;
    }
  }
}
</script>

<style lang="scss" scoped>
.gallery-1n {
  @include media-breakpoint-up(xl) {
    &__image {
      height: 100vh;     
      .image {
        height: 100%;
        &::after {
          padding: 0;
          height: 100%;
        }
      }
    }
  }
  @include media-breakpoint-down(xl) {
    &__image .image {
      --image-size: 62%;
    }
  }
  @include media-breakpoint-down(sm) {
    &__image .image {
      --image-size: 128%;
    }
  }
}

.gallery-2n_1 {
  &__image .image {
    --image-size: 70%;
  }
}

.gallery-2n_2_left {
  &__image {
    &:last-child {
      .image {
        margin-top: 14%;
      }
    }
    .image {
      --image-size: 146%;
    }
  }
}

.gallery-2n_2_right {
  &__image {
    &:first-child {
      .image {
        margin-top: 14%;
      }
    }
    .image {
      --image-size: 146%;
    }
  }
}

.gallery-3n_1 {
  &__image .image {
    --image-size: 150%;
  }
  @include media-breakpoint-down(sm) {
    &__image .image {
      --image-size: 120%;
    }
  }
}

.gallery-3n_2 {
  &__image .image {
    --image-size: 70%;
  }
  @include media-breakpoint-down(sm) {
    &__image .image {
      --image-size: 76%;
    }
  }
}

.gallery-4n_1 {
  &__image .image {
    --image-size: 150%;
  }
}

.gallery-4n_2 {
  &__image .image {
    --image-size: 66%;
  }
  @include media-breakpoint-down(sm) {
    &__image .image {
      --image-size: 100%;
    }
  }
}
</style>