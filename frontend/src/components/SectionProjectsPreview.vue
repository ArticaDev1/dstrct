<template lang="pug">

section.section(v-if="filteredProjects")
  BackgroundFigure.section__figure-1(:name="'2'" v-if="filteredProjects.length > 2")
  BackgroundFigure.section__figure-2(:name="'3'" v-if="filteredProjects.length > 5")
  BackgroundFigure.section__figure-3(:name="'4'")
  .container
    SmallSectionTitle.section__title Проекты
    .row
      //v-for
      .project(
        v-for="(project, index) in filteredProjects"
        :class="layouts[index].templateGrid")
        .project__inner(:data-aos="animations[index]")
          ProjectLinkImage(
            @click="startLeaveAnimation(index)"
            :to="{name: 'project', params: {id: project.slug}}"
            :class="layouts[index].imageGrid"
            :image="project.image"
            :style="`--image-size:${layouts[index].imageSize};`")
          .project__title(
            :class="layouts[index].titleGrid")
            p {{project.description}}

    .row.section__more(
      :class="{'section__more_no-indent': noIndent}")
      .col-10.offset-2.col-md-3.offset-md-9.col-xl-11
        LinkIcon(
          :href="$router.resolve({name: 'portfolio'}).fullPath"
          @click.prevent="$router.push({name: 'portfolio'})") Все проекты
    
</template>

<script>
import { mapState, mapMutations } from "vuex";
import ProjectLinkImage from "@/components/ProjectLinkImage";
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";

export default {
  components: {
    ProjectLinkImage
  },
  setup() {
    const layouts = [
      {
        templateGrid: 'col-md-8 offset-md-4 col-xl-6 offset-xl-5',
        imageSize: '67%',
        imageGrid: 'image-size-wide image-align-screen image-size-md-normal image-align-md-normal',
        titleGrid: 'text-end'
      }, {
        templateGrid: 'col-md-7 col-xl-4',
        imageSize: '150%',
        imageGrid: 'image-size-side image-align-screen',
        titleGrid: 'text-end'
      }, {
        templateGrid: 'col-11 offset-1 col-md-6 offset-md-6 col-xl-3 offset-xl-9',
        imageSize: '126%',
        imageGrid: 'image-size-side',
        titleGrid: 'text-start'
      }, {
        templateGrid: 'col-md-7 offset-md-1 col-xl-5 offset-xl-1',
        imageSize: '67%',
        imageGrid: 'image-size-side image-align-screen image-align-md-normal image-size-md-normal',
        titleGrid: 'text-end'
      }, {
        templateGrid: 'col-md-10 offset-md-2 col-xl-8 offset-xl-3',
        imageSize: '65%',
        imageGrid: 'image-size-wide image-align-screen image-size-md-normal image-align-md-normal',
        titleGrid: 'text-end'
      }, {
        templateGrid: 'col-10 offset-2 col-md-6 offset-md-0 col-xl-4 offset-xl-1',
        imageSize: '100%',
        imageGrid: 'image-size-side image-size-md-normal',
        titleGrid: 'text-start'
      },
    ]

    const animations = [
      'zoom-in',
      'zoom-in-right',
      'zoom-in-left',
      'zoom-in',
      'zoom-in',
      'zoom-in'
    ]

    return { layouts, animations };
  },
  computed: {
    ...mapState({
      projects: state => state.route.data.projects
    }),
    maxLength() {
      return this.layouts.length;
    },
    noIndent() {
      return this.filteredProjects.length === 2 
          || this.filteredProjects.length === 4 
          || this.filteredProjects.length === 6 ? true : false;
    },
    filteredProjects() {
      return this.projects?.filter((project, index) => index < this.maxLength);
    }
  },
  unmounted() {
    if (this.leaveAnimation) this.leaveAnimation.kill();
  },
  methods: {
    ...mapMutations({
      setLeaveDelay: 'transition/LEAVE_DELAY'
    }),
    startLeaveAnimation(indexFrom) {
      if (this.$window.innerWidth < this.$breakpoints.xl) return;

      this.setLeaveDelay(sDur[3]);

      const projects = this.$el.querySelectorAll('.project');

      this.leaveAnimation = gsap.timeline({defaults: {
        duration: sDur[3]
      }})
        .to(projects, 
          { scale: 0.75, ease: 'power2.in', stagger: { each: 0.1, from: indexFrom } })
        .to(projects,
          { autoAlpha: 0, stagger: { each: 0.1, from: indexFrom } }, '<')
    }
  }
}
</script>

<style lang="scss" scoped>
  .section {
    /* &__figure-1 {
      width: 78vw;
      top: 21vw;
      left: 13vw;
    }
    &__figure-2 {
      width: 46vw;
      left: 0;
      top: 88vw;
    } */

    &__figure-1 {
      --width: calc(var(--page-width) * 2.5);
      width: var(--width);
      top: 25%;
      left: calc(var(--width) / -2);
    }
    &__figure-2 {
      --width: calc(var(--page-width) * 1.4);
      width: var(--width);
      top: 58%;
      left: 0;
    }
    &__figure-3 {
      --width: calc(var(--page-width) * 1.2);
      --height: var(--width) * 0.9;
      width: var(--width);
      height: var(--height);
      right: 20px;
      bottom: calc(var(--height) / -2);
    }

    @include media-breakpoint-up(md) {
      &__more {
        margin-top: 130px;
        &_no-indent {
          margin-top: calc(1em * var(--large-line-height) * -1) !important;
        }
      }
      &__figure-1 {
        --width: calc(var(--page-width) * 1.6);
        top: 13%;
        left: calc(var(--width) / -10);
      }
      &__figure-2 {
        --width: var(--page-width);
      }
      &__figure-3 {
        --width: var(--page-width);
        right: calc(var(--width) / -4);
      }
    }

    @include media-breakpoint-up(xl) {
      &__title {
        margin-bottom: calc(1em * var(--base-line-height) * -1) !important;
      }
      &__more {
        margin-top: 200px;
      }
      &__figure-1 {
        --width: calc(var(--page-width) * 0.78);
        left: calc(var(--width) * 0.15);
        top: 10%;
      }
      &__figure-2 {
        --width: calc(var(--page-width) * 0.5);
        top: 40%;
      }
      &__figure-3 {
        --width: calc(var(--page-width) * 0.6);
        right: calc(var(--content-fields-width) - calc(var(--page-width) * 0.15));
      }
    }

    @include media-breakpoint-up(xxl) {
      &__more {
        margin-top: 250px;
      }
    }
  }

  .project {
    margin-bottom: 120px;
    &__title {
      margin-top: 15px;
      color: var(--color-accent-1);
    }
    @include media-breakpoint-up(md) {
      margin-bottom: 130px;
      &:last-child {
        margin-bottom: 0;
      }
    }
    @include media-breakpoint-up(xl) {
      margin-bottom: 0;
      &:not(:first-child) {
        margin-top: 200px;
      }
      &:nth-child(2) {
        margin-top: -200px;
      }
      &:nth-child(3) {
        margin-top: calc(-130px + var(--content-fields-width) * -1.5);
      }
      &:nth-child(4) {
        margin-top: calc(-100px + var(--content-fields-width) * 0.25);
      }
    }
    @include media-breakpoint-up(xxl) {
      &:not(:first-child) {
        margin-top: 250px;
      }
      &:nth-child(2) {
        margin-top: -220px;
      }
      &:nth-child(3) {
        margin-top: -20vw;
      }
      &:nth-child(4) {
        margin-top: calc(-13vw + 120px)
      }
    }
  }


</style>