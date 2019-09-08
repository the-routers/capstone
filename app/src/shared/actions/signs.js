import {httpConfig} from "../utils/http-config";

export const getAllSigns = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/tweet/");
	dispatch({type: "FETCH_TWEETS",payload : payload.data });
};


export const getSignBySignId = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/tweet/");
	dispatch({type: "FETCH_TWEETS",payload : payload.data });
};


export const getSignBySignName = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/tweet/");
	dispatch({type: "FETCH_TWEETS",payload : payload.data });
};

export const getSignBySignType = (test) => async (dispatch) => {
	const payload =  await httpConfig.get("/apis/tweet/");
	dispatch({type: "FETCH_TWEETS",payload : payload.data });
};

