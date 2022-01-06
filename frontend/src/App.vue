<template lang="pug">

TheHeader

TheNavigation

main.main
  router-view
  
TheFooter

</template>

<script>
  import TheHeader from '@/components/TheHeader';
  import TheNavigation from '@/components/TheNavigation';
  import TheFooter from '@/components/TheFooter';
  
  export default {
    components: {
      TheHeader, 
      TheNavigation,
      TheFooter
    }, 
    created() {
      this.$testDevice.init();

    },
    mounted() {

    }
  }
</script>
  
<style lang='scss'>
  @import '@/assets/scss/theme.scss';
  @import '@/assets/scss/main.scss';
</style>