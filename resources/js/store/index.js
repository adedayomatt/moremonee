import Vue from 'vue';
import Vuex from 'vuex';
// modules
import commerce from '../../../domain/Commerce/store';
Vue.use(Vuex)
export default new Vuex.Store({
    state: {},
    actions: {},
    getters: {},
    mutations: {},
    modules: {
        commerce,
    },
})
