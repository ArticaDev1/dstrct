import { reactive } from "vue";

export default {
  install: (app, options) => {
    const obj = reactive({});

    function updateSize() {
      obj.innerWidth = window.innerWidth;
      obj.innerHeight = window.innerHeight;
    }

    function updateScroll() {
      obj.pageYOffset = window.pageYOffset;
    }

    updateSize();
    updateScroll();
    window.addEventListener('resize', updateSize);
    window.addEventListener('scroll', updateScroll);

    app.config.globalProperties.$window = obj;
  }
}