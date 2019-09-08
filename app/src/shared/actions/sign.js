import {httpConfig} from "../utils/http-config";

export const getAllSigns = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/sign/");
	dispatch({type: "FETCH_GET_ALL_SIGNS",payload : payload.data });
};


export const getSignBySignId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/sign/");
	dispatch({type: "FETCH_GET_SIGN_BY_SIGNSID",payload : payload.data });
};


export const getSignBySignName = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/sign/");
	dispatch({type: "FETCH_GET_SIGNS_BY_SIGNNAME",payload : payload.data });
};

export const getSignBySignType = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/sign/");
	dispatch({type: "FETCH_GET_SIGNS_BY_SIGNTYPE",payload : payload.data });
};

