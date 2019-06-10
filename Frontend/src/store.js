import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        read_once: false,
        not_found: false,
        config: null
    },
    mutations: {
        updateMode(state, payload) {
            state.read_once = payload.read_once;
        },
        updateNotFound(state, payload) {
            state.not_found = payload.not_found;
        },
        init(state) {
            state.not_found = state.read_once = false;
        },
    }
});
