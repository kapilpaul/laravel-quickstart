import Vue from "vue";
import Vuex from "vuex";
import { commonStore } from "./modules/common";

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    Participants: []
  },
  getters: {
    Participants: state => {
      return state.Participants;
    }
  },
  mutations: {
    setParticipants: (state, payload) => {
      state.Participants = payload;
    }
  },
  actions: {
    setParticipants: ({ commit }, payload) => {
      commit("setParticipants", payload);
    }
  },
  modules: {
    commonStore
  }
});
