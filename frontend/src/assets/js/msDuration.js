export default {
  1: +getComputedStyle(document.documentElement).getPropertyValue('--animation-duration-1').replace(/[^\d.-]/g, ''),
  2: +getComputedStyle(document.documentElement).getPropertyValue('--animation-duration-2').replace(/[^\d.-]/g, ''),
  3: +getComputedStyle(document.documentElement).getPropertyValue('--animation-duration-3').replace(/[^\d.-]/g, '')
}