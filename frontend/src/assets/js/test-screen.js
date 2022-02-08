import device from "current-device";

function checkScrollbar() {
  let testDiv = document.createElement('div');
  testDiv.style.cssText = 'position:fixed;width:100%;';

  document.body.insertAdjacentElement('afterbegin', testDiv);

  let testWidth = testDiv.getBoundingClientRect().width,
      windowWidth = window.innerWidth,
      value = windowWidth - testWidth;

  testDiv.remove();

  //set scrollbar params
  document.documentElement.style.setProperty('--scrollbar-width-property', `${value}px`);
}

export default function() {
  if (device.ios()) {
    document.documentElement.style.setProperty('--window-safe-height-property', `${window.innerHeight}px`);
  }
  checkScrollbar();
}

