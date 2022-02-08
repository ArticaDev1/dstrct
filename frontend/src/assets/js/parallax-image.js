import { ScrollTrigger } from "gsap/ScrollTrigger";

export default class {
  constructor(element, options) {
    this._element = element;
    this._percent = options?.percent || 25;
    this._oversize = options?.oversize ? true : false;
    this._init();
  }

  _init() {
    this._image = this._element.querySelector('img');

    this._image.style.willChange = 'transform';
    
    this._trigger = ScrollTrigger.create({
      trigger: this._element,
      start: "top bottom",
      end: "bottom top",
      onUpdate: self => {
        const progress = 1 - self.progress / 0.5;
        const translate = (-this._percent / 2) * progress;
        requestAnimationFrame(() => {
          this._image.style.transform = `translate3d(0, ${translate}%, 0)`;
        })
      }
    });
  }

  destroy() {
    this._trigger.kill();
  }
}