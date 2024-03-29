import {httpConfig} from "../utils/http-config";

export const getUserPhotoByUserPhotoId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOID",payload : payload.data });
};
export const postUserPhotoByUserPhotoSignId = (test) => async (dispatch) => {
	const payload =  await httpConfig.post("/apis/userPhoto/");
	dispatch({type: "POST_USERPHOTO_BY_USERPHOTOSIGNID",payload : payload.data });
};


export const getAllUserPhotos = () => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_ALL_USERPHOTOS",payload : payload.data });
};


export const getUserPhotoByUserPhotoSignId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOSIGNID",payload : payload.data });
};

export const getUserPhotoByUserPhotoUserId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOUSERID",payload : payload.data });
};