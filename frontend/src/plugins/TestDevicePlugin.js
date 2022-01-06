import device from "current-device";

const testDevice = {
  init() {
    if (device.ios()) {
      document.documentElement.style.setProperty('--window-safe-height-property', `${window.innerHeight}px`);
    }
    document.documentElement.style.setProperty('--scrollbar-width-property', `${window.innerWidth - document.body.clientWidth}px`);
  }
}

export default {
  install: (app, options) => {
    app.config.globalProperties.$testDevice = testDevice;
  }
}