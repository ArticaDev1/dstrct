import lazySizes from 'lazysizes';

export default {
  install: (app, options) => {
    app.config.globalProperties.$lazySizes = lazySizes;
  }
}