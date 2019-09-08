export default (state = [], action) => {
	switch(action.type) {
		case "GET_USER_BY_USERID":
			return action.payload;
		case "GET_USER_BY_USERNAME":
			return action.payload;
		case "GET_USER_BY_USEREMAIL":
			return action.payload;
		default:
			return state;
	}
}