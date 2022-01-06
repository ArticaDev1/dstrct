import device from "current-device";

export default {
  install: (app, options) => {
    app.config.globalProperties.$device = device;
  }
}