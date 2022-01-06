import { createApp } from 'vue';
import App from '@/App';
//plugins
import $router from '@/router';
import $store from '@/store';
import $gsap from '@/plugins/GsapPlugin';
import $lazySizes from '@/plugins/LazySizesPlugin';
import $customInteraction from '@/plugins/CustomInteractionPlugin';
import $device from "@/plugins/CurrentDevicePlugin";
import $testDevice from "@/plugins/TestDevicePlugin";
//ui
import UIComponents from '@/components/UI';

//fake api
import { startServer } from "@/server";
startServer();

//create app
const app = createApp(App);

app.use($store);
app.use($router);
app.use($gsap);
app.use($lazySizes);
app.use($customInteraction, {
  targets: 'a, button, [data-custom-interaction]'
});
app.use($device);
app.use($testDevice);

UIComponents.forEach(component => {
  app.component(component.name, component);
});

app.mount('#app');
