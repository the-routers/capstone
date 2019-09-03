import React, { useState } from 'react'
import {Component} from 'react';
import ReactMapGL from 'react-map-gl';


export const MapComponent = () => {
		const [viewport, setViewport] = useState({
			width: "60vw",
			height: "60vh",
			latitude: 35.0739388,
			longitude: -106.5477188,
			zoom: 6
		});

		return (
			<div>
				<ReactMapGL {...viewport} mapboxApiAccessToken={"pk.eyJ1Ijoic2lnbnNvbjY2IiwiYSI6ImNrMDJ1N253NzJ5bGIzbW1sMmQycTY1NXgifQ.PfiX1yUH8Ximn1NRPsIGpw"}>
				Markers Here

				</ReactMapGL>

		</div>
	);
}
