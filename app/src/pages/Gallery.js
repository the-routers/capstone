import React, {useEffect} from "react";
import {Header} from "../shared/components/header";
import {Footer} from "../shared/components/Footer";
import clib from "../images/clib.jpeg";
import Kimo from "../images/Kimo.jpg";
import Nob2 from "../images/Nob2.jpg";
import wall from "../images/wall.jpg";
import Nobhill1 from "../images/Nobhill1.jpg";
import Lindy from "../images/Lindy.jpg";
import doghouse from "../images/doghouse.jpg";
import intersection from "../images/intersection.jpg";
import garcia from "../images/garcia.jpg";
import Premiere_Motel from "../images/Premiere_Motel.jpg";
import coffeeshop from "../images/coffee shop.jpeg";
import elvado from "../images/elvado.png";
import lodge from "../images/lodge.jpeg"
import elcamino from "../images/elcamino.jpg";
import {useDispatch, useSelector} from "react-redux";
import {getAllSigns} from "../shared/actions/sign";
import {getAllUserPhotos} from "../shared/actions/userPhoto";


export const Gallery =() => {

	const userPhotos = useSelector(state => state.userPhotos ? state.userPhotos : []);

	// assigns useDispatch reference to the dispatch variable for later use.
	const dispatch = useDispatch();


	// Define the side effects that will occur in the application.
	// E.G code that handles dispatches to redux, API requests, or timers.
	function sideEffects() {
		// The dispatch function takes actions as arguments to make changes to the store/redux.
		dispatch(getAllUserPhotos())
	}

	// Declare any inputs that will be used by functions that are declared in sideEffects.
	const sideEffectInputs = [];

	/**
	 * Pass both sideEffects and sideEffectInputs to useEffect.
	 * useEffect is what handles rerendering of components when sideEffects resolve.
	 * E.g when a network request to an api has completed and there is new data to display on the dom.
	 */
	useEffect(sideEffects, sideEffectInputs);
console.log(userPhotos);
	return (
		<>
			<Header/>

			<form className="upload">
				<div className="container">
					<h2>Gallery</h2>
					<div className="container">
						<div className="row">
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={Premiere_Motel}  className="img-fluid"/>*/}
						{/*			<div className="titleBox">Premiere Motel</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}

						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={Kimo} className="img-fluid" />*/}
						{/*			<div className="titleBox">Kimo Theater</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}

						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={Nob2} className="img-fluid" />*/}
						{/*			<div className="titleBox">Nob Hill Court</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*</div>*/}

						{/*<div className="row">*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={elcamino}  className="img-fluid"/>*/}
						{/*			<div className="titleBox">El Camino Motel</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}

						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={lodge} className="img-fluid"/>*/}
						{/*			<div className="titleBox">Luna Lodge</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}

						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={wall} className="img-fluid"/>*/}
						{/*			<div className="titleBox">Mural</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*</div>*/}

						{/*<div className="row">*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={elvado} className="img-fluid"/>*/}
						{/*			<div className="titleBox">El Vado Motel</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={Lindy} className="img-fluid" />*/}
						{/*			<div className="titleBox">Lindy's Dinner</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={coffeeshop} className="img-fluid" />*/}
						{/*			<div className="titleBox">Coffee Shop</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*</div>*/}

						{/*<div className="row">*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{ width: 320, height:320 }} src={intersection} className="img-fluid" />*/}
						{/*			<div className="titleBox">Street Sign</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
						{/*	<div className="box col-lg-4 col-sm-6 col-xs-8">*/}
						{/*		<div className="boxInner">*/}
						{/*			<img style={{width: 320, height: 320}}*/}
						{/*				  src={garcia} className="img-fluid"/>*/}
						{/*			<div className="titleBox">Garcia's Cafe</div>*/}
						{/*		</div>*/}
						{/*	</div>*/}
							{userPhotos.map(userPhoto => (
								<div className="box col-lg-4 col-sm-6 col-xs-8" key={userPhoto.userPhotoId}>
									<div className="boxInner">
										<img style={{width: 320, height: 320}}
											  className="img-fluid" src={userPhoto.userPhotoUrl}/>
										<div className="titleBox">{userPhoto.userPhotoCaption}</div>
									</div>
								</div>
							))}

						</div>
					</div>
				</div>
			</form>
			<div className="container">
				<Footer />
			</div>
		</>
	)
};