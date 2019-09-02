import React, {useState} from 'react'
import {Component} from 'react';
import ReactMapGL from 'react-map-gl';


	export default function app() {
		const [viewport, setViewport] = useState({
			width: "60vw",
			height: "60vh",
			latitude: 35.0739388,
			longitude: -106.5477188,
			zoom: 8
		})

		return (
			<div>
				<ReactMapGL {...viewport} mapboxApiAccessToken={process.env.REACT_APP_MAPBOX_TOKEN}>
				Markers Here

				</ReactMapGL>

		</div>;
	);
}
