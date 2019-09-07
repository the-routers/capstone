import React, {useState} from "react";
import ReactMapboxGl from "react-mapbox-gl";
import {ZoomControl} from "react-mapbox-gl";
import {Marker} from "react-mapbox-gl";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Header} from "../shared/components/header";
import {Footer} from "../shared/components/Footer";


export const MapComponent = () => {

	const [zoom, setZoom] = useState([11]);


	const [points, setPoints] = useState([
		{lat: 35.082202, lng: -106.630692},
	]);


	const Map = ReactMapboxGl({
		accessToken: "pk.eyJ1Ijoic2lnbnNvbjY2IiwiYSI6ImNrMDJ1N253NzJ5bGIzbW1sMmQycTY1NXgifQ.PfiX1yUH8Ximn1NRPsIGpw"
	});

	return (
		<>
			<Header />

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
				<ZoomControl />
				<Marker
					coordinates={points[0]}
					anchor="bottom">
					<FontAwesomeIcon icon="map-marker-alt" size="2x"/>
				</Marker>
			</Map>

			<div className="container">
				<Footer />
			</div>
		</>
	)
};
