export default {
  namespaced: true,
  state: {
    from: undefined,
    data: undefined,
    key: 0,
  },
  getters: {
    getContacts(state) {
      return state.data.contacts?.map(obj => {
        if (obj.type == 'phone') {
          obj.href = `tel:${obj.value.replace(/[^0-9]/g, '')}`;
        } else if (obj.type == 'email') {
          obj.href = `mailto:${obj.value}`;
        }
        return obj;
      })
    },
    getSocials(state) {
      return state.data.socials;
    }
  },
  mutations: {
    DATA(state, payload) {
      state.data = payload;
    },
    KEY(state, payload) {
      state.key = payload;
    },
    FROM(state, payload) {
      state.from = payload;
    }
  }
}