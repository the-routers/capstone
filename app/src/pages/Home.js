import React from "react"

import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";
import {Footer} from "../shared/components/Footer";



export const Home = () => {
	return (
		<>
			<Jumbotron fluid id="header-image">
				<Container>
					<div className="justify-content-end">
						<h1>Fluid jumbotron</h1>
						<p>
							This is a modified jumbotron that occupies the entire horizontal space of
							its parent.
						</p>
					</div>
				</Container>
			</Jumbotron>

			<div className="container my-5">
				<div className="row justify-content-center">
					<div className="col-6-md map">
						<img src="https://placekitten.com/500/300" alt=""/>
					</div>
					<div className="col-6-md gallery">
						<img src="https://placekitten.com/500/300" alt=""/>
					</div>
				</div>
			</div>

			<div className="container">
				<Footer />
			</div>

		</>
	)
};