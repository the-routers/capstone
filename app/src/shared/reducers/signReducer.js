export default (state = [], action) => {
	switch(action.type) {
		case "GET_ALL_SIGNS":
			return action.payload;
		default:
			return state;
	}
}