import {Component} from 'react';
import ReactMapGL from 'react-map-gl';

class Map extends Component {

	state = {
		viewport: {
			width: 400,
			height: 400,
			latitude: 35.0739388,
			longitude: -106.5477188,
			zoom: 8
		}
	};

	render() {
		return (
			<ReactMapGL
		{...this.state.viewport}
		onViewportChange={(viewport) => this.setState({viewport})}
		/>
	);
	}
}