export default (state = [], action) => {
	switch(action.type) {
		case "GET_ALL_SIGNS":
			return action.payload;
		case "GET_SIGNS_BY_SIGNID":
			return action.payload;
		case "GET_SIGNS_BY_SIGNNAME":
			return action.payload;
		case "GET_SIGNS_BY_SIGNTYPE":
			return action.payload;
		default:
			return state;
	}
}