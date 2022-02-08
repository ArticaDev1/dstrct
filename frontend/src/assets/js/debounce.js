export default function(func, interval, context) {
  let timeout = false;
  return function() {
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => {
      func.apply(context || this, arguments);
    }, interval);
  };
}