module.exports = {
  assetsDir: 'assets',
  devServer: {
    proxy: 'https://dstrct-bureau.com'
  },
  css: {
    loaderOptions: {
      sass: {
        prependData: `
          @import "@/assets/scss/global.scss";
        `
      }
    }
  }
}