import React, {useEffect} from "react"

import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Image from 'react-bootstrap/Image'
import blank1 from '../images/blank3.png';
import streetsign1 from '../images/streetsign1.png';
import {Link, Route} from "react-router-dom";
import abq from '../images/map1000x600.png';
import motel from '../images/motel1000x600.png';
import Button from 'react-bootstrap/Button'
import {Footer} from "../shared/components/Footer";
import {httpConfig} from "../shared/utils/http-config";


export const Home = () => {


	return (
		<>
			<Jumbotron fluid id="header-image">
				<Container>
					<Row>
						<Col md={5} className="mx-auto"><Image src={blank1}/></Col>
					</Row>
					<Row>
						<Col className="mx-auto margin-left text-right">
							<Link to="/sign-in"><Button variant="warning" className="p-3">Sign In or Sign Up</Button></Link>
						</Col>
						<Col className="mx-auto margin-right">
							<Link to="/map"><Button variant="warning" className="px-5 py-3">Find a Sign</Button></Link>
						</Col>
					</Row>
				</Container>
			</Jumbotron>

			<container className="box">
				<Row className="d-flex justify-content-center">
					<Col md={5}><Link to="/map"><Image className="map-link" src={abq} fluid/>
						<div className="overlay map-overlay">
							<div className="text">Map</div>
						</div>
					</Link></Col>
					<Col md={1}></Col>
					<Col md={5}><Link to="/gallery"><Image className="gallery" src={motel} fluid/>
						<div className="overlay gallery-overlay">
							<div className="text">Gallery</div>
						</div>
					</Link></Col>
				</Row>
			</container>

			<div className="container p-5">
				<h3>About Signs on 66</h3>
				<p>Signs on 66 is a website that allows users to discover historic neon signs on Route 66 in Albuquerque.
					Visitors can use our map to locate signs and post their own photos for other visitors to enjoy in
					our <Link to="/gallery">gallery</Link>. If you would like to add a sign that isn't already on the site,
					please send us an email at <a href="mailto:signson66abq@gmail.com">signson66abq@gmail.com</a>.</p>
			</div>

			<div className="container">
				<Footer/>
			</div>

		</>
	)
};