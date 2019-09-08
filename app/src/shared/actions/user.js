import {httpConfig} from "../utils/http-config";

export const getUserByUserId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_GET_USER_BY_USERID",payload : payload.data });
};


export const getUserByUserName = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_GET_USER_BY_USERNAME",payload : payload.data });
};


export const getUserByUserEmail = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/user/");
	dispatch({type: "FETCH_GET_USER_BY_USEREMAIL",payload : payload.data });
};