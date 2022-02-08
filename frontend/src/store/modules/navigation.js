export default {
  namespaced: true,
  state: {
    active: false,
    visible: false
  },
  mutations: {
    VISIBLE(state, payload) {
      state.visible = payload;
    },
    ACTIVE(state, payload) {
      state.active = payload;
    }
  }
}