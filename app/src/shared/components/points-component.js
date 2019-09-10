import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Marker} from "react-mapbox-gl";
import React from "react";




export const  PointsComponent = ({sign}) => {
	console.log(sign.sign);
		return (

				<Marker
					key={sign.signId}
					coordinates={{lat: sign.signLat, lng: sign.signLong}}
					anchor="bottom">
					<FontAwesomeIcon icon="map-marker-alt" size="2x"/>
				</Marker>

		)
};
