import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.css';
import {Footer} from "../shared/components/Footer";
import {Header} from "../shared/components/header";
import {useDispatch, useSelector} from "react-redux";
import {getAllSigns} from "../shared/actions/sign";
import {httpConfig} from "../shared/utils/http-config";
import {Typeahead} from "react-bootstrap-typeahead";


export const PhotoUpload = () => {
	const [imageUrl, setImageUrl] = useState("");
	const [signName, setSignName] = useState("");

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

	const uploadSignImage = (e) => {
		e.preventDefault();
		let foundSign = signs.find(function(sign) {
			return sign.signName === signName;
		});
		console.log(foundSign);
		httpConfig.post("/apis/image/", imageUrl)
			.then(reply => {
				let {message, type} = reply;
				//	setStatus({message, type});
				console.log(reply);
				if(reply.status === 200) {
					//		setStatus({message, type});
					console.log(message);
				}
			});
		// 	httpConfig.post("/apis/userPhoto/",imageUrl)
		// .then(reply => {
		// 			let {message, type} = reply;
		// 			//	setStatus({message, type});
		// 			console.log(message);
		// 			if(reply.status === 200) {
		// 				//		setStatus({message, type});
		// 				console.log(message);
		// 			}
		// 		})
	};
	const options = signs.map(sign => sign.signName);


	return (
		<>
			<Header/>
			<form className="upload">
				<div className="container text-center">
					<h2>Welcome to the photo upload page</h2>
					<div style={{width: 660, height: 20}}>
					</div>
					<div className="bg-transparent">
						<h4>Upload your sign photos</h4>
						<div>
							<input type="file" id="signImage" accept=".jpg, .jpeg, .svg, .png"
									 onChange={(e) => {
										 setImageUrl(e.target.files[0]);
									 }}
									 onClick={(event) => {
										 event.target.value = null
									 }}
							/>
						</div>
					</div>
				</div>
				<div style={{width: 660, height: 20}}>
				</div>

				<div className="container text-center">
					<div className="input-group" style={{height: 80}}>
						<div className="input-group-prepend">
							<span className="input-group-text">PhotoCaption</span>
						</div>
						<textarea className="form-control" aria-label="With textarea"/>
					</div>
				</div>
				<div style={{width: 660, height: 30}}>
				</div>
				<div style={{width: 660, height: 20}}>
				</div>

				<div className="container">
					<Typeahead
						labelKey="name"
						placeholder="Enter sign name..."
						options={options}
						onChange={(e) => setSignName(e[0])}
					/>

					<div style={{width: 660, height: 20}}>
					</div>

					<button type="submit" onClick={uploadSignImage} className="btn btn-warning">Upload Image</button>


				</div>
			</form>

			<Footer/>

		</>
	)
};



