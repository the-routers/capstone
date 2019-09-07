import React from "react";
import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import {MainNav} from "./main-nav/MainNav";
import Image from 'react-bootstrap/Image';
import logo from "../../images/66_Logo.png";
import {Link, Route} from "react-router-dom";


export const Header = () => {
	return (
	<>
		<Jumbotron fluid className="small-header-image">

				<Row className="p-0">
						<Col sm={1} className="mt-n3">
						</Col>
						<Col sm={9} className="p-0">
							<Link to="/"><Image className="logo" src={logo} fluid alt="logo for Signs on 66"/></Link>
						</Col>
						<Col sm={1} className="p-0">
							<MainNav />
						</Col>
				</Row>
		</Jumbotron>
	</>
)
};
