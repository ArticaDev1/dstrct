import breakpoints from '@/assets/js/breakpoints';

export default {
  install: (app, options) => {
    app.config.globalProperties.$breakpoints = breakpoints;
  }
}