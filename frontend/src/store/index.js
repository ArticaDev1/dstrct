import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    routeData: {}
  },
  getters: {
    getContacts(state) {
      if (!state.routeData.contacts) return;
      return state.routeData.contacts.map(obj => {
        if (obj.type == 'phone') {
          obj.href = `tel:${obj.value.replace(/[^0-9]/g, '')}`;
        } else if (obj.type == 'email') {
          obj.href = `mailto:${obj.value}`;
        }
        return obj;
      })
    }
  },
  mutations: {
    SET_ROUTE_DATA(state, payload) {
      state.routeData = payload;
    }
  },
  actions: {
    async loadRouteData({ commit }, routePath) {
      const requestURL = `/api${routePath}`;
      try {
        const response = await axios.get(requestURL);
        commit('SET_ROUTE_DATA', response.data);
        return true;
      } catch(error) {
        console.log(error);
        return false;
      }
    }
  }
})