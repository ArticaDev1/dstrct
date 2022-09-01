<template lang="pug">

header.header
  .container.header__container
    .header__logo(:class="{'visible': logoVisible}")
      Logo
    .header__right
      //- .header__socials(:class="{'visible': visible}")
      //-   SocialsList
      a#cssda(href='http://www.cssdesignawards.com/' target='_blank')
        img(src='https://www.cssdesignawards.com/images/2017/monogram/cssda-nominee-white-vote.png')
      .header__nav-toggle
        TheNavToggle(:background="!visible")

</template>

<script>
import { mapState } from 'vuex';
import SocialsList from "@/components/SocialsList";
import TheNavToggle from "@/components/TheNavToggle";
import Logo from "@/components/Logo";

export default {
  data() {
    return {
      scrollThreshold: 50
    }
  },
  components: {
    SocialsList,
    TheNavToggle,
    Logo
  },
  computed: {
    ...mapState({
      navActive: state => state.navigation.active
    }),
    visible() {
      return this.navActive || this.$window.pageYOffset <= this.scrollThreshold;
    },
    hasLogo() {
      return this.$route.name === 'main' ? false : true;
    },
    logoVisible() {
      return this.navActive || (this.hasLogo && this.$window.pageYOffset <= this.scrollThreshold);
    }
  }
}
</script>

<style lang="scss" scoped>
.header {
  pointer-events: none;
  position: fixed;
  z-index: 2000;
  width: var(--page-width);
  top: var(--header-top-padding);
  &__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  &__right {
    display: flex;
    align-items: center;
    gap: 0 45px;
  }
  &__nav-toggle {
    pointer-events: all;
  }
  &__socials, &__logo {
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity var(--animation-duration-2) ease-in-out, visibility var(--animation-duration-2) ease-in-out;
    will-change: opacity;
    &.visible {
      opacity: 1;
      visibility: visible;
      pointer-events: all;
    }
  }
  @include media-breakpoint-down(lg) {
    &__right {
      justify-content: space-between;
      gap: 0 var(--grid-gutter-width);
      flex: 1 1 auto;
      max-width: 170px;
    }
  }
  @include media-breakpoint-down(md) {
    &__right {
      max-width: 140px;
    }
  }
  @include media-breakpoint-down(sm) {
    &__right {
      flex: 0 0 auto;
      gap: 0 30px;
    }
  }
}
#cssda {
  pointer-events: all;
  width: 60px;
  height: 0;
  display: flex;
  align-items: center;
  img {
    width: 100%;
    max-width: 100%;
    height: auto;
  }
  @include media-breakpoint-down(sm) {
  }
}
</style>