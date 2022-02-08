import AOS from 'aos';
import 'aos/dist/aos.css';

export default {
  install: (app, options) => {
    AOS.init(options);
    app.config.globalProperties.$aos = AOS;
  }
}