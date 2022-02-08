import { values } from "@/assets/js/animation-duration"

const duration = {
  ms: {},
  s: {}
};

for (let value in values) {
  duration.ms[value] = values[value];
  duration.s[value] = values[value] / 1000;
}

export default {
  install: (app, options) => {
    app.config.globalProperties.$duration = duration;
  }
}