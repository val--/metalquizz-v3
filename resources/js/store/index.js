import Vue from 'vue';
import Vuex from 'vuex';
import * as actions from './actions';
import mutations from './mutations';
import { isLoggedIn } from "../utils";

Vue.use(Vuex);

const state = {
	isLoggedIn : false,
	user : {}
}

export default new Vuex.Store({
	state,
	actions,
	mutations
});