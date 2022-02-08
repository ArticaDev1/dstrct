<template lang="pug">

section.section.project-head
  BackgroundFigure.project-head__figure(:name="'6'")
  .container
    .row
      .col-md-10.offset-md-1.col-lg-6.offset-lg-0
        h1.project-head__title {{ title }}
        .row.project-head__description(v-if="description")
          .col-lg-10
            p {{ description }}

      .col-sm-10.offset-sm-1.col-md-8.offset-md-2.col-lg-6.offset-lg-0.pt-xl-5.pt-xxl-10(v-if="attributes && attributes.length")
        ParamsList(:items="attributes")

  Gallery.project-head__image#photo(
    :lazyload="transition ? false : true"
    :type="'1n'" 
    :images="[mainImage]")

section.section.project-important(v-if="important && important.length")
  BackgroundFigure.project-important__figure(:name="'7'")
  .container
    .row.justify-content-center
      .col-lg-10.col-xl-8
        h3.project-important__title Для заказчика было важно:
        ul.project-important__list.list.color-base.h4
          li.project-important__item(v-for="item in important") {{ item }}

section.section.project-plan(v-if="planImage")
  BackgroundFigure.project-plan__figure(:name="'8'")
  .container
    .row.justify-content-center
      .col-lg-10.col-xl-8
        .project-plan__title.color-muted-3 План расстановки мебели
        .image.project-plan__image(data-aos="zoom-in")
          img.lazyload(:src="planImage" alt="image" @load="this.$aos.refresh()")

section.section(v-if="galleries && galleries.length")
  .gallery(v-for="gallery in galleries")
    Gallery(:type="gallery.name" :images="gallery.images")

section.section(v-if="elseProjects && elseProjects.length")
  .container
    h2.mb-30.mb-lg-40.mb-xl-60 Другие проекты:
    .row.row-gap-25
      .col-6.col-md-3(v-for="project in elseProjects")
        ProjectLinkImage(
          :to="{name: 'project', params: {id: project.slug}}"
          :image="project.preview_images[0]"
          style="--image-size: 136%;")
        .mt-10.mt-xl-20.color-accent-1 {{ project.name }}
        
FormSection
SectionContacts

.back(
  v-if="routeFrom.name === 'portfolio' && $window.innerWidth >= $breakpoints.sm"
  :class="{'visible': enterFinish}")
  ButtonElement.form-section__submit(
    @click.prevent="$router.go(-1)"
    type="button")
    SpriteIcon.back__button-icon(:id="'arrow-left'")
    | Назад

</template>

<script>
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";
import { mapState } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";
import { enablePageScroll }  from  'scroll-lock';

import ParamsList from '@/components/ParamsList';
import SectionContacts from "@/components/SectionContacts";
import Gallery from '@/components/Gallery';
import ProjectLinkImage from "@/components/ProjectLinkImage";
import FormSection from "@/components/FormSection";

export default {
  mixins: [ViewAnimationEvents],
  components: {
    ParamsList,
    SectionContacts,
    FormSection,
    Gallery,
    ProjectLinkImage
  },
  data() {
    return {
      enterFinish: false
    }
  },
  computed: {
    ...mapState({
      onEnter: state => state.transition.enterStart,
      onEnterFinish: state => state.transition.enterFinish,
      title: state => state.route.data.project?.name,
      description: state => state.route.data.project?.description,
      attributes: state => state.route.data.project?.attributes,
      mainImage: state => state.route.data.project?.main_image,
      galleries: state => state.route.data.project?.galleries,
      important: state => state.route.data.project?.important,
      planImage: state => state.route.data.project?.schema_image,
      elseProjects: state => state.route.data.see_also,
      routeFrom: state => state.route.from
    })
  },
  watch: {
    onEnter(value) {
      if (value && this.transition) {
        this.enterTransition();
      }
    }, 
    onEnterFinish(value) {
      if (value && !this.transition) {
        this.enterFinish = true;
      }
    }
  },
  created() {
    this.transition = this.projectTransition;
  },
  methods: {
    enterTransition() {
      gsap.to(window, { duration: sDur[3], scrollTo: { y: 0 }, 
        onStart: () => {
          this.projectTransition.image.remove();
          this.setProjectTransition(false);
        }, 
        onComplete: () => {
          enablePageScroll();
          this.enterFinish = true;
        }
      }, '+=0.25');
    }
  }
}
</script>

<style lang="scss" scoped>
  .back {
    position: fixed;
    z-index: 10;
    bottom: var(--container-padding-x);
    left: var(--container-padding-x);
    opacity: 0;
    visibility: hidden;
    transition: opacity var(--trs-2), visibility var(--trs-2);
    &__button {
      &-icon {
        width: 9px;
      }
    }
    &.visible {
      opacity: 1;
      visibility: visible;
    }
  }

  .gallery {
    &:not(:last-child) {
      margin-bottom: var(--section-small-margin);
    }
  }
  .project-head {
    &__figure {
      width: var(--content-width);
      left: var(--content-fields-width);
      top: calc(var(--section-margin-first-top) * -1);
    }
    &__description {
      color: var(--color-accent-1);
    }
    &__title {
      font-family: var(--font-family-accent);
      &:not(:last-child) {
        margin-bottom: 30px;
      }
    }
    &__image {
      margin-top: 100px;
    }
    @include media-breakpoint-down(lg) {
      &__title {
        text-align: center;
        &:last-child {
          margin-bottom: 100px;
        }
        &:not(:last-child) {
          margin-bottom: 35px;
        }
      }
      &__description {
        margin-bottom: 80px;
        text-align: center;
      }
      &__image {
        margin-top: var(--section-small-margin);
      }
    }
    @include media-breakpoint-down(sm) {
      &__figure {
        width: 150%;
        left: -25%;
        top: calc(var(--section-margin-first-top) * -1);
      }
      &__title {
        &:last-child {
          margin-bottom: 65px;
        }
      }
      &__description {
        margin-bottom: 50px;
      }
    }
  }

  .project-important {
    &__figure {
      width: 50%;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
    }
    &__title {
      margin-bottom: 40px;
      text-align: center;
    }
    @include media-breakpoint-down(lg) {
      &__title {
        margin-bottom: 30px;
      }
    }
    @include media-breakpoint-down(sm) {
      &__title {
        text-align: left;
      }
      &__figure {
        width: 70%;
      }
    }
  }

  .project-plan {
    &__figure {
      width: 40vw;
      top: 0;
      right: 0;
    }
    &__title {
      margin-bottom: 45px;
    }
  }

</style>