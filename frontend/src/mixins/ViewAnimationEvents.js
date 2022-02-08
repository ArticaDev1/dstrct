import { mapActions, mapMutations, mapState } from "vuex";
import { enablePageScroll }  from  'scroll-lock';

export default {
  computed: {
    ...mapState({
      projectTransition: state => state.transition.projectTransition,
      appReady: state => state.appReady
    })
  },
  mounted() {
    this.$nextTick(function() {
      if (this.appReady) this.callEnterTransition();
    })

    if (this.projectTransition && this.$route.name !== 'project') {
      this.projectTransition.image.remove();
      enablePageScroll();
      this.setProjectTransition(false);
    }
  },
  methods: {
    ...mapActions({
      callEnterTransition: 'transition/enter'
    }),
    ...mapMutations({
      setProjectTransition: 'transition/PROJECT_TRANSITION'
    })
  }
}