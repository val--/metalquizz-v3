import { isLoggedIn } from "../utils";

export const updateLoggedUser = ({ commit}, value) => {
	if (isLoggedIn) {
		axios.get('/api/user').then((res)=>{
            commit('UPDATE_LOGGED_USER', res.data);
        })
	}
};

export const logOutUser = ({ commit}, value) => {
	commit('LOGOUT_USER');
};