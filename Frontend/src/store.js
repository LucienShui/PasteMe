/*
@File    :   store.js
@Contact :   lucien@lucien.ink
@License :   (C)Copyright 2019, Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-05-31 23:41  Lucien     1.0         None
*/
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
