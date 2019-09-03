import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import {Jumbotron} from 'react-bootstrap/Jumbotron';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
import {Example} from "./pages/Example";
import {MapComponent} from "./shared/components/MapComponent";

import ReactMapGL from "react-map-gl"


import 'bootstrap/dist/css/bootstrap.css';
//import 'bootstrap/dist/js/bootstrap.bundle.min';
import "./index.css";


const Routing = () => (
	<>
		<BrowserRouter>
			<Switch>
				<Route exact path="/" component={Home}/>
				<Route exact path="/example" component={Example}/>
				<Route exact path="/map" component={MapComponent}/>
				<Route component={FourOhFour}/>
			</Switch>
		</BrowserRouter>

	</>
);
ReactDOM.render(<Routing/>, document.querySelector('#root'));