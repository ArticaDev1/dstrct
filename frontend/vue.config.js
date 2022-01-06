module.exports = {
  assetsDir: 'assets',
  /* devServer: {
    proxy: {
      '^/api': {
        target: 'host',
        ws: true,
        changeOrigin: true
      }
    }
  }, */
  css: {
    loaderOptions: {
      sass: {
        prependData: `
          @import "@/assets/scss/components/_variables.scss";
        `
      }
    }
  }
}