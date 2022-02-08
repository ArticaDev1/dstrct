<template lang="pug">

.wrapper(
  :class="{'disabled': !onEnter}"
  data-custom-interaction)
  TheHeader
  TheNavigation
  .content(ref="content")
    main
      router-view(:key="routeKey")
    TheFooter

</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';
import gsap from "@/assets/js/gsap.js";
import { sDur } from "@/assets/js/animation-duration";
import { disablePageScroll, enablePageScroll }  from  'scroll-lock';

import TheHeader from '@/components/TheHeader';
import TheNavigation from '@/components/TheNavigation';
import TheFooter from '@/components/TheFooter';

export default {
  data() {
    return {
      isMounted: false
    }
  },
  components: {
    TheHeader, 
    TheNavigation,
    TheFooter
  },
  computed: {
    ...mapState({
      onEnter: state => state.transition.enterStart,
      onLeave: state => state.transition.leaveStart,
      appReady: state => state.appReady,
      routeKey: state => state.route.key,
      leaveDuration: state => state.transition.leaveDuration,
      enterDuration: state => state.transition.enterDuration,
      leaveDelay: state => state.transition.leaveDelay,
      enterDelay: state => state.transition.enterDelay,
    })
  },
  watch: {
    onEnter(value) {
      if (value) {
        if (!this.appReady) {
          this.startReadyAnimation();
          this.setAppReady(true);
        } else {
          this.startEnterAnimation();
        }
      }
    },
    onLeave(value) {
      if (value && this.appReady) this.startLeaveAnimation();
    }
  },
  mounted() {
    disablePageScroll();
    gsap.set(this.$el, {autoAlpha: 0});

    setTimeout(() => { 
      this.callEnterTransition();
    }, 500);
  },
  methods: {
    ...mapActions({
      callEnterTransition: 'transition/enter',
      setLeaveDefaults: 'transition/setLeaveDefaults',
      setEnterDefaults: 'transition/setEnterDefaults',
    }), 
    ...mapMutations({
      setAppReady: 'APP_READY',
      setEnterFinish: 'transition/ENTER_FINISH',
      setLeaveFinish: 'transition/LEAVE_FINISH'
    }),
    createStartAnimation() {
      this.startAnimation = gsap.timeline({ paused: true })
        .fromTo(this.$el,
          { autoAlpha: 0 },
          { autoAlpha: 1, duration: sDur[4] })
        .eventCallback('onComplete', () => {
          this.setEnterFinish(true);
        })
    },
    createRouteEnterAnimation() {
      this.routeEnterAnimation = gsap.timeline({ paused: true })
        .to(this.$refs.content, 
          { autoAlpha: 1, duration: this.enterDuration })
        .eventCallback('onComplete', () => {
          this.setEnterFinish(true);
        })
      this.setEnterDefaults();
    },
    createRouteLeaveAnimation() {
      this.routeLeaveAnimation = gsap.timeline({ paused: true })
        .to(this.$refs.content, 
          { autoAlpha: 0, duration: this.leaveDuration }, `+=${this.leaveDelay}`)
        .eventCallback('onComplete', () => {
          this.setLeaveFinish(true);
        })
      this.setLeaveDefaults();
    },
    startReadyAnimation() {
      this.createStartAnimation();
      this.startAnimation.play();
      enablePageScroll();
    },
    startEnterAnimation() {
      this.createRouteEnterAnimation();
      this.routeEnterAnimation.play();
      enablePageScroll();
    },
    startLeaveAnimation() {
      this.createRouteLeaveAnimation();
      this.routeLeaveAnimation.play();
      disablePageScroll();
    }
  }
}
</script>