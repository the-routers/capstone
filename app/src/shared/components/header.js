import React from "react";
import {Link} from "react-router-dom";
import Image from 'react-bootstrap/Image'


import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {MainNav} from "./main-nav/MainNav";

export const Header = () => {
	return (
	<>
		<Jumbotron className="header" fluid> //style header img like marsha's using CSS id/className header-img
			<Container>
				<Row className="">
						<Col sm="6" className="float-left ml-1 ml-sm-2 ml-lg-3 mt-1 mt-sm-2 mt-lg-3">
							<Img className="logo" src="images/logo.jpg" alt="logo for Signs on 66">
						</Col>
						<Col sm="6" className="float-right mr-1 mr-sm-2 mr-lg-3 mt-1 mt-sm-2 mt-lg-3">
							<div>
								<MainNav/>
							</div>
						</Col>
				</Row>
			</Container>
		</Jumbotron>
	</>
)
};
