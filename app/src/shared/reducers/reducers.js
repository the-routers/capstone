import {combineReducers} from "redux"
import signReducer from "./signReducer";
import userReducer from "./userReducer";
import userPhotoReducer from "./userPhotoReducer";

export const reducers = combineReducers({
	signs: signReducer,
	users: userReducer,
	userPhotos: userPhotoReducer,
});