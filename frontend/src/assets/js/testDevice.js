export default {
  test() {
    console.log(this)
  }
}

/* export default function() {
  if (this.$device.ios()) {
    document.documentElement.style.setProperty('--window-safe-height-property', `${window.innerHeight}px`);
  }
  document.documentElement.style.setProperty('--scrollbar-width-property', `${window.innerWidth - document.body.clientWidth}px`);
} */