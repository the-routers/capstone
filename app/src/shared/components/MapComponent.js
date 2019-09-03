import React, { useState } from 'react'
import {Component} from 'react';
import ReactMapGL from 'react-map-gl';


export const MapComponent = () => {
		const [viewport, setViewport] = useState({
			latitude: 35.0739388,
			longitude: -106.5477188,
			width: "90vw",
			height: "90vh",
			zoom: 10
		});

		return (
			<div>
				<ReactMapGL
					{...viewport}
					mapboxApiAccessToken={"pk.eyJ1Ijoic2lnbnNvbjY2IiwiYSI6ImNrMDJ1N253NzJ5bGIzbW1sMmQycTY1NXgifQ.PfiX1yUH8Ximn1NRPsIGpw"}
					onViewportChange={viewport => {
						setViewport(viewport);
					}}
				>
				Markers Here

				</ReactMapGL>

		</div>
	);
}
