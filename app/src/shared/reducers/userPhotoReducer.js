export default (state = [], action) => {
	switch(action.type) {
		case "GET_ALL_USERPHOTOS":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOSID":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOSSIGNSID":
			return action.payload;
		case "GET_USERPHOTOS_BY_USERPHOTOUSERID":
			return action.payload;
		default:
			return state;
	}
}