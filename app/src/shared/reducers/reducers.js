import {combineReducers} from "redux"
import signReducer from "./signReducer";

export const combinedReducers = combineReducers({
	signs: signReducer,
});