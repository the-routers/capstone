import React, {useState, useEffect} from "react";
import ReactMapboxGl from "react-mapbox-gl";
import {ZoomControl} from "react-mapbox-gl";
import {Marker} from "react-mapbox-gl";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Header} from "../shared/components/header";
import {Footer} from "../shared/components/Footer";
import Container from "react-bootstrap/Container";
import {useSelector, useDispatch} from "react-redux";
import {getAllSigns} from "../shared/actions/sign";
import {PointsComponent} from "../shared/components/points-component";




export const MapComponent = () => {

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

	const [zoom, setZoom] = useState([11]);




	const Map = ReactMapboxGl({
		accessToken: "pk.eyJ1Ijoic2lnbnNvbjY2IiwiYSI6ImNrMDJ1N253NzJ5bGIzbW1sMmQycTY1NXgifQ.PfiX1yUH8Ximn1NRPsIGpw"
	});

	return (
		<>

			<Header />
			<Container fluid>
			<Map
				style="mapbox://styles/signson66/ck05pmcef0kj11cob7zfe4c7r"
				containerStyle={
					{
						height: "100vh",
						width: "98vw"
					}
				}
				center={[-106.630692, 35.082202]}
				zoom={zoom}
			>
				{signs.map(sign => (<PointsComponent sign={sign}/>))};
				<ZoomControl />

			</Map>

			</Container>

			<div className="container">
				<Footer />
			</div>
		</>
	)
};

