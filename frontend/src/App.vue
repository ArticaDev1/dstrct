<template lang="pug">
TheLoader
TheCursor(v-if="$device.type=='desktop' && $window.innerWidth >= $breakpoints.xl")
Layout(v-if="routeData")
</template>

<script>
import { mapState } from 'vuex';
import CustomInteraction from '@/assets/js/custom-interaction';

import Layout from '@/layouts/Layout';
import TheCursor from '@/components/TheCursor';
import TheLoader from '@/components/TheLoader';

export default {
  components: {
    Layout, 
    TheCursor,
    TheLoader
  },
  computed: {
    ...mapState({
      routeData: state => state.route.data,
      appReady: state => state.appReady
    })
  },
  watch: {
    appReady(value) {
      if (value) {
        document.querySelector('#app').classList.add('ready');
      }
    }
  },
  created() {
    new CustomInteraction({
      targets: ['a', 'button']
    });
  }
}
</script>
  
<style lang='scss'>
@import '@/assets/scss/theme.scss';
@import '@/assets/scss/main.scss';
</style>