export default {
	UPDATE_LOGGED_USER(state, value) {
		state.user = value;
		state.isLoggedIn = value ? true : false;
	},
	LOGOUT_USER(state, value) {
		state.user = {};
		state.isLoggedIn = false;
	}
}