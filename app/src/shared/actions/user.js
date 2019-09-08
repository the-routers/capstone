import {httpConfig} from "../utils/http-config";

export const getUserByUserId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_USER",payload : payload.data });
};


export const getUserByUserName = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_USER",payload : payload.data });
};


export const getUserByUserEmail = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_USER",payload : payload.data });
};