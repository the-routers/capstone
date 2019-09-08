import {httpConfig} from "../utils/http-config";

export const getUserPhotoByUserPhotoId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOSID",payload : payload.data });
};


export const getAllUserPhotos = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_ALL_USERPHOTOS",payload : payload.data });
};


export const getUserPhotoByUserPhotoSignId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOSSIGNSID",payload : payload.data });
};

export const getUserPhotoByUserPhotoUserId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/userPhoto/");
	dispatch({type: "FETCH_GET_USERPHOTOS_BY_USERPHOTOUSERID",payload : payload.data });
};