import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
import {Example} from "./pages/Example";
import {Gallery} from "./pages/Gallery"
import {PhotoUpload} from "./pages/PhotoUpload";
import {SignIn} from "./pages/sign-in/SignIn";
import { library } from '@fortawesome/fontawesome-svg-core'

import {
	faEnvelope,
	faKey
} from "@fortawesome/free-solid-svg-icons";
library.add(faEnvelope, faKey)
const Routing = () => (
	<>
		<BrowserRouter>
			<Switch>
				<Route exact path="/sign-in" component={SignIn}/>
				<Route exact path="/example" component={Example}/>
				<Route exact path="/gallery" component={Gallery}/>
				<Route exact path="/photo-upload" component={PhotoUpload}/>
				<Route exact path="/" component={Home}/>
				<Route component={FourOhFour}/>
			</Switch>
		</BrowserRouter>
	</>
);
ReactDOM.render(<Routing/>, document.querySelector('#root'));