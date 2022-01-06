import {gsap} from "gsap";
import {ScrollToPlugin} from "gsap/ScrollToPlugin";
gsap.registerPlugin(ScrollToPlugin);

import msDuration from "@/assets/js/msDuration";

gsap.defaults({
  ease: "power2.inOut",
  duration: msDuration[1] / 1000
});

gsap.registerEffect({
  name: "fadeIn",
  effect: ($element, config) => {
    return gsap.fromTo($element, {autoAlpha: 0}, {immediateRender: false, autoAlpha: 1, duration: config.duration || msDuration[1] / 1000,
      onStart: () => {
        $element.forEach($this => {
          $this.classList.add('d-block');
        })
      },
      onReverseComplete: () => {
        $element.forEach($this => {
          gsap.set($this, {clearProps: "all"});
          $this.classList.remove('d-block');
        })
      }
    })
  },
  extendTimeline: true
});

gsap.registerEffect({
  name: "slide",
  effect: ($element, config) => {
    return gsap.fromTo($element, {css: {height:'0px'}}, {css: {height:'auto'}, duration: config.duration || msDuration[1] / 1000, immediateRender: false})
  },
  extendTimeline: true
});
 
export default {
  install: (app, options) => {
    app.config.globalProperties.$gsap = gsap;
  }
}