import lazySizes from 'lazysizes';

lazySizes.cfg.customMedia = {
  '--small': '(max-width: 575px)',
  '--medium': '(max-width: 1023px)',
  '--large': '(max-width: 1279px)',
};

export default {
  install: (app, options) => {
    app.config.globalProperties.$lazySizes = lazySizes;
  }
}