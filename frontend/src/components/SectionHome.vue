<template lang="pug">
section.section.home(ref="parent")
  .container.home__container
    .home__slogan.row(:class="{'hidden': sloganHidden}")
      .col-lg-3.offset-lg-7.home__slogan-inner
        p Cовременный дизайн жилых пространств премиум сегмента

    SelectedProjects.home__projects(
      :active="activeSelectedProjects"
      @activation="activeSelectedProjects = true"
      @disactivation="activeSelectedProjects = false")

    .home__links
      LinkIcon(
        :href="$router.resolve({name: 'portfolio'}).fullPath"
        @click.prevent="$router.push({name: 'portfolio'})") Посмотреть<br> портфолио

      LinkIcon.home__form-trigger(
        :tag="'button'"
        :icon="false"
        @click="modalFormVisible = true"
        type="button") Оставить<br> заявку

  SectionHomeWords(
    :activeSelectedProjects="activeSelectedProjects")

  Teleport(to="#app")
    ModalForm(
      :visible="modalFormVisible"
      @submitted="modalFormVisible = false; modalSuccessVisible = true;"
      @close="modalFormVisible = false")

  Teleport(to="#app")
    ModalSuccess(
      :visible="modalSuccessVisible"
      @close="modalSuccessVisible = false")
</template>

<script>
import { mapState } from 'vuex';

import SelectedProjects from '@/components/SelectedProjects';
import SectionHomeWords from '@/components/SectionHomeWords';
import ModalForm from "@/components/ModalForm";
import ModalSuccess from "@/components/ModalSuccess";

export default {
  components: {
    SelectedProjects,
    SectionHomeWords,
    ModalForm,
    ModalSuccess
  },
  data() {
    return {
      activeSelectedProjects: false,
      modalFormVisible: false,
      modalSuccessVisible: false
    }
  },
  computed: {
    ...mapState({
      navActive: state => state.navigation.active
    }),
    sloganHidden() {
      return this.navActive && window.innerWidth < this.$breakpoints.sm;
    }
  }
}
</script>

<style lang="scss" scoped>
.home {
  --padding-bottom: 85px;
  margin-top: 0;
  min-height: calc(min(var(--screen-max-height), var(--window-safe-height)));
  margin-bottom: calc(var(--section-margin) - var(--padding-bottom));
  position: relative;
  display: flex;
  &__container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-bottom: var(--padding-bottom);
    padding-top: var(--header-top-padding);
  }
  &__slogan {
    color: var(--color-accent-1);
    flex: 0 0 auto;
    transition: opacity var(--trs-2), visibility var(--trs-2);
    &.hidden {
      opacity: 0;
      visibility: hidden;
    }
  }
  &__links {
    flex: 0 0 auto;
    display: flex;
    gap: 110px;
  }
  &__projects {
    flex: 1 1 auto;
  }
  @include media-breakpoint-up(xl) {
    &__slogan {
      p {
        max-width: 220px;
      }
    }
  }
  @include media-breakpoint-up(xxl) {
    &__slogan {
      p {
        max-width: 270px;
      }
    }
  }
  @include media-breakpoint-down(xxl) {
    --padding-bottom: 50px;
  }

  @include media-breakpoint-down(xl) {
    &__projects {
      flex: 0 0 auto;
    }
  }
  @include media-breakpoint-down(lg) {
    --padding-bottom: 80px;
    &__container {
      padding-top: 120px;
    }
    &__slogan {
      &-inner {
        display: flex;
        justify-content: flex-end;
      }
      p {
        max-width: 170px;
      }
    }
    &__links {
      gap: 70px;
    }
  }
  @include media-breakpoint-down(md) {
    --padding-bottom: 45px;
    &__container {
      padding-top: var(--header-top-padding);
    }
    &__slogan {
      margin-top: -0.15em;
      &-inner {
        display: block;
      }
      p {
        max-width: 200px;
      }
    }
  }
  @include media-breakpoint-down(sm) {
    &__links {
      gap: var(--grid-gutter-width);
      justify-content: space-between;
    }
    &__form-trigger {
      min-width: 90px;
    }
  }
}
</style>