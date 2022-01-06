class СustomInteraction {
  constructor(options = {}) {
    this.targets = options.targets;
    this.touchendDelay = options.touchendDelay || 100; //ms

    const events = (event) => {
      const $targets = [];

      $targets[0] = event.target !== document ? event.target.closest(this.targets) : null;
      
      let $element = $targets[0], i = 0;
  
      while($targets[0]) {
        $element = $element.parentNode;
        if($element!==document) {
          if($element.matches($targets.value)) {
            i++;
            $targets[i] = $element;
          }
        } 
        else {
          break;
        }
      }
  
      //touchstart
      if(event.type=='touchstart') {
        this.touched = true;
        if(this.timeout) clearTimeout(this.timeout);
        if($targets[0]) {
          for(let $target of $targets) $target.setAttribute('data-touch', '');
        }
      } 
      //touchend
      else if(event.type=='touchend' || (event.type=='contextmenu' && this.touched)) {
        this.timeout = setTimeout(() => {this.touched = false}, this.touchendDelay);
        if($targets[0]) {
          setTimeout(()=>{
            for(let $target of $targets) {
              $target.removeAttribute('data-touch');
            }
          }, this.touchendDelay)
        }
      } 
      //mouseenter
      if(event.type=='mouseenter' && !this.touched && $targets[0] && $targets[0]==event.target) {
        $targets[0].setAttribute('data-hover', '');
      }
      //mouseleave
      else if(event.type=='mouseleave' && !this.touched && $targets[0] && $targets[0]==event.target) {
        $targets[0].removeAttribute('data-click');
        $targets[0].removeAttribute('data-hover');
      }
      //mousedown
      if(event.type=='mousedown' && !this.touched && $targets[0]) {
        $targets[0].setAttribute('data-click', '');
      } 
      //mouseup
      else if(event.type=='mouseup' && !this.touched  && $targets[0]) {
        $targets[0].removeAttribute('data-click');
      }
    }

    document.addEventListener('touchstart',  events);
    document.addEventListener('touchend',    events);
    document.addEventListener('mouseenter',  events, true);
    document.addEventListener('mouseleave',  events, true);
    document.addEventListener('mousedown',   events);
    document.addEventListener('mouseup',     events);
    document.addEventListener('contextmenu', events);
  }
}

export default {
  install: (app, options) => {
    app.config.globalProperties.$customInteraction = new СustomInteraction(options);
  }
}