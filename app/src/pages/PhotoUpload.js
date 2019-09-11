import React, {useEffect} from "react";
import 'bootstrap/dist/css/bootstrap.css';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {MyDropzone} from "../shared/components/main-nav/photoupload/MyDropzone";
import {backgroundPattern} from "mapbox-gl/src/shaders";
import {Footer} from "../shared/components/Footer";
import {Header} from "../shared/components/header";
import {Autocomplete} from "../shared/components/main-nav/photoupload/Autocomplete";
import {useDispatch, useSelector} from "react-redux";
import {getAllSigns} from "../shared/actions/sign";



export const PhotoUpload = () => {
	const signs = useSelector(state => state.signs ? state.signs : []);

	// assigns useDispatch reference to the dispatch variable for later use.
	const dispatch = useDispatch();


	// Define the side effects that will occur in the application.
	// E.G code that handles dispatches to redux, API requests, or timers.
	function sideEffects() {
		// The dispatch function takes actions as arguments to make changes to the store/redux.
		dispatch(getAllSigns())
	}

	// Declare any inputs that will be used by functions that are declared in sideEffects.
	const sideEffectInputs = [];

	/**
	 * Pass both sideEffects and sideEffectInputs to useEffect.
	 * useEffect is what handles rerendering of components when sideEffects resolve.
	 * E.g when a network request to an api has completed and there is new data to display on the dom.
	 */
	useEffect(sideEffects, sideEffectInputs);


	return(
<>
	<Header />
	<div className="background-pattern-1">
			<form>
		<div className="container text-center">
					<h4>To Upload Photo for sign drag and drop files below</h4>
					<div style={{ width: 660, height:20}}>
					</div>
					<div className="border border-dark bg-light ">
							<MyDropzone/>
					</div>
		</div>
			<div style={{ width: 660, height:20 }}>
			</div>

<div className="container text-center">
	<div className="input-group" style={{height:80 }}>
		<div className="input-group-prepend">
			<span className="input-group-text">PhotoCaption</span>
		</div>
		<textarea className="form-control" aria-label="With textarea"/>
	</div>
</div>
			<div style={{ width: 660, height:30 }}>
			</div>
	<div style={{ width: 660, height:20 }}>
	</div>

<div className="container">
	<Autocomplete signs={signs}/>
	<div style={{ width: 660, height:20 }}>
			</div>

		<button type="submit" className="btn b-uploadImage">UploadImage</button>


	</div>
		</form>
		<Footer/>

	</div>
</>
	)
};



