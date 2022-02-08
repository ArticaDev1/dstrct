<template lang="pug">
.wrapper
  .scroll-content
    slot
</template>

<script>
import Scrollbar from '@/assets/js/smooth-scrollbar';

export default {
  methods: {
    create() {
      if (this.$device.type === 'desktop') {
        this.createScrollbar();
      } 
    },
    createScrollbar() {
      this.scrollbar = Scrollbar.init(this.$el, {
        damping: 0.1,
        thumbMinSize: 100,
        plugins: {
          SoftScroll: {}
        }
      })
    }
  },
  mounted() {
    this.create();
  }
}
</script>

<style lang="scss" scoped>
  .scrollbar {
    width: 100%;
    height: 100%;
  }
</style>