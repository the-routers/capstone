import React from "react"

import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Image from 'react-bootstrap/Image'
import logo from '../images/66_Logo.png';
import map from '../images/map.png';
import {Footer} from "../shared/components/Footer";


export const Home = () => {
	return (
		<>
			<Jumbotron fluid id="header-image">
				<Container>
					<Row>
						<Col md={10}></Col>
						<Col md={2}><p>Sample Text</p></Col>

					</Row>
					<Row>
						<Col md={10}></Col>
						<Col md={2}><Image src={logo} fluid/></Col>
					</Row>
				</Container>
			</Jumbotron>


			<container>
				<Row>
					<Col md={6}><Image className="link" src={map} fluid/></Col>
					<Col md={6}><Image className="gallery" src={map} fluid/></Col>
				</Row>
			</container>

			<div className="container">
				<h3>About Signs on 66</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
					mollit anim id est laborum.</p>
			</div>

			<div className="container">
				<Footer/>
			</div>

		</>
	)
};