import React, {useEffect} from "react"
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import {Jumbotron} from 'react-bootstrap/Jumbotron';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {reducers} from "./shared/reducers/reducers";
import {Provider} from "react-redux";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
import {Example} from "./pages/Example";
import {Gallery} from "./pages/Gallery"
import {MapComponent} from "./pages/MapComponent";
import {PhotoUpload} from "./pages/PhotoUpload";
import {SignIn} from "./pages/sign-in/SignIn";
//import 'bootstrap/dist/js/bootstrap.bundle.min';
import "./index.css";
import { library } from '@fortawesome/fontawesome-svg-core'
import {
	faEnvelope,
	faKey,
	faMapMarkerAlt,
	faUser
} from "@fortawesome/free-solid-svg-icons";
import thunk from "redux-thunk";
import {applyMiddleware, createStore} from "redux";
import {httpConfig} from "./shared/utils/http-config";

library.add(faEnvelope, faKey, faMapMarkerAlt,faUser);


const store = createStore(reducers, applyMiddleware(thunk));


const Routing = (store) => {
	// useEffect(() => {
	// 	httpConfig.get("/apis/earl-grey/")
	// });

	return (
	<>
		<Provider store={store}>
		<BrowserRouter>
			<Switch>
				<Route exact path="/sign-in" component={SignIn}/>
				<Route exact path="/example" component={Example}/>
				<Route exact path="/gallery" component={Gallery}/>
				<Route exact path="/map" component={MapComponent}/>
				<Route exact path="/photo-upload" component={PhotoUpload}/>
				<Route exact path="/" component={Home}/>
				<Route component={FourOhFour}/>
			</Switch>
		</BrowserRouter>
		</Provider>
	</>
)};

ReactDOM.render(Routing(store), document.querySelector("#root"));