export default (state = [], action) => {
	switch(action.type) {
		case "GET_ALL_USERPHOTOS":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOID":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOSIGNID":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOUSERID":
			return action.payload;
		default:
			return state;
	}
}