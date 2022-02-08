import { createApp } from 'vue';
import App from '@/App';
//plugins
import router from '@/router';
import store from '@/store';
import breakpointsPlugin from '@/plugins/Breakpoints';
import devicePlugin from '@/plugins/Device';
import windowSizePlugin from '@/plugins/WindowSize';
import aosPlugin from '@/plugins/Aos';
import lazySizesPlugin from '@/plugins/LazySizes';
import durationPlugin from '@/plugins/Duration';
//components
import components from '@/components/ui';
//test
import testScreen from "@/assets/js/test-screen";

import breakpoints from '@/assets/js/breakpoints';


//create app
const app = createApp(App);

app.use(store);
app.use(router);
app.use(breakpointsPlugin);
app.use(devicePlugin);
app.use(windowSizePlugin);
app.use(lazySizesPlugin);
app.use(durationPlugin);
app.use(aosPlugin, {
  disable: () => window.innerWidth < breakpoints.xl,
  duration: 500,
  easing: 'ease-out-quart',
  anchorPlacement: 'top-bottom',
  offset: 0
});

components.forEach(component => {
  app.component(component.name, component);
});

app.mount('#app');

testScreen();
