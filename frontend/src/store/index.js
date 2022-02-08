import { createStore } from 'vuex';
//modules
import routeModule from '@/store/modules/route';
import navigationModule from '@/store/modules/navigation';
import transitionModule from '@/store/modules/transition';

export default createStore({
  modules: {
    route: routeModule,
    navigation: navigationModule,
    transition: transitionModule
  },
  state: {
    appReady: false,
    loader: false
  },
  mutations: {
    APP_READY(state, payload) {
      state.appReady = payload;
    },
    LOADER(state, payload) {
      state.loader = payload;
    }
  }
})