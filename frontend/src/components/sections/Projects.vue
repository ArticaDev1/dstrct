<template lang="pug">

section.section.project-preview-section
  .container
    SmallSectionTitle.project-preview-section__title Projects
    .row
      //v-for
      .project-preview-section__project(
        v-for="(project, index) in this.projects"
        :class="layouts[index].templateGrid")
        .project-preview
          router-link.project-preview__image.image.image_cover.image-content(
            :to="{name: 'project', params: {id: project.id}}"
            :class="layouts[index].imageGrid" 
            :style="`--image-size:${layouts[index].imageSize}`")
            img.lazyload(
              :data-src="project.image" 
              :alt="project.title")
          .project-preview__title(
            :class="layouts[index].titleGrid")
            p {{project.title}}
    .row.project-preview-section__projects
      .col-xl-11
        LinkIcon.project-preview-section__projects-link(
          :href="$router.resolve({name: 'projects'}).fullPath"
          @click.prevent="$router.push({name: 'projects'})") Все проекты
    
</template>

<script>

export default {
  props: {
    projects: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      layouts: [
        {
          templateGrid: 'col-xl-6 offset-xl-5',
          imageSize: '67%',
          imageGrid: '',
          titleGrid: 'text-end'
        }, {
          templateGrid: 'col-xl-4',
          imageSize: '150%',
          imageGrid: 'image-size-side image-align-screen',
          titleGrid: 'text-end'
        }, {
          templateGrid: 'col-xl-3 offset-xl-9',
          imageSize: '126%',
          imageGrid: 'image-size-side',
          titleGrid: 'text-start'
        }, {
          templateGrid: 'col-xl-5 offset-xl-1',
          imageSize: '67%',
          imageGrid: '',
          titleGrid: 'text-end'

        }, {
          templateGrid: 'col-xl-8 offset-xl-3',
          imageSize: '65%',
          imageGrid: '',
          titleGrid: 'text-end'
        }, {
          templateGrid: 'col-xl-4 offset-xl-1',
          imageSize: '100%',
          imageGrid: '',
          titleGrid: 'text-start'
        },
      ]
    }
  }
}
</script>

<style lang="scss">
  .project-preview-section {
    &__title {
      margin-bottom: calc(1em * var(--base-line-height) * -1) !important;
    }
    &__projects {
      margin-top: calc(1em * var(--large-line-height) * -1) !important;
      text-align: right;
    }
    &__project {
      &:not(:first-child) {
        margin-top: 250px;
      }
      &:nth-child(2) {
        margin-top: -220px;
      }
      &:nth-child(3) {
        margin-top: -380px;
      }
      &:nth-child(4) {
        margin-top: -180px;
      }
    }
    @include media-breakpoint-down(xxl) {
      &__project {
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
    }
  }

  .project-preview {
    &__title {
      margin-top: 20px;
    }
    &__image {
      display: block;
      &::after {
        content: '';
        display: block;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        pointer-events: none;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity var(--trs-1);
      }
      &[data-touch], &[data-hover] {
        &::after {
          opacity: 1;
        }
      }
    }
  }
</style>