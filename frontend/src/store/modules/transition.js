const defaults = {
  leaveDuration: 0.5,
  enterDuration: 1,
  leaveDelay: 0
}

export default {
  namespaced: true,
  state: {
    enterStart: false,
    enterFinish: false,
    leaveStart: false,
    leaveFinish: false,
    leaveDuration: defaults.leaveDuration,
    enterDuration: defaults.enterDuration,
    leaveDelay: defaults.leaveDelay,
    projectTransition: false
  },
  mutations: {
    ENTER_START(state, payload) {
      state.enterStart = payload;
    },
    ENTER_FINISH(state, payload) {
      state.enterFinish = payload;
    },
    LEAVE_START(state, payload) {
      state.leaveStart = payload;
    },
    LEAVE_FINISH(state, payload) {
      state.leaveFinish = payload;
    },
    LEAVE_DURATION(state, payload) {
      state.leaveDuration = payload;
    },
    ENTER_DURATION(state, payload) {
      state.enterDuration = payload;
    },
    LEAVE_DELAY(state, payload) {
      state.leaveDelay = payload;
    },
    PROJECT_TRANSITION(state, payload) {
      state.projectTransition = payload;
    } 
  },
  actions: {
    enter({ commit }) {
      commit('LEAVE_START', false);
      commit('LEAVE_FINISH', false);
      commit('ENTER_START', true);
    },
    leave({ commit }) {
      commit('ENTER_START', false);
      commit('ENTER_FINISH', false);
      commit('LEAVE_START', true);
    },
    setEnterDefaults({ commit }) {
      commit('ENTER_DURATION', defaults.enterDuration);
    },
    setLeaveDefaults({ commit }) {
      commit('LEAVE_DURATION', defaults.leaveDuration);
      commit('LEAVE_DELAY', defaults.leaveDelay);
    }
  }
}