import React from "react";
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {MainNav} from "./main-nav/MainNav";

export const Header = () => {
	return (
	<>
	<Header className=""> //check for alignment or styling needed
		<Container fluid="true">
			<Row className="background-img w-100 fluid"> //complete linking/styling to background image
				<Col sm="6" className="float-left ml-1 ml-sm-2 ml-lg-3 mt-1 mt-sm-2 mt-lg-3">
					<a href="OUR LOGO" className=""></a> //complete linking to logo
				</Col>
				<Col sm="6" className="float-right mr-1 mr-sm-2 mr-lg-3 mt-1 mt-sm-2 mt-lg-3">
					<li>
						<MainNav/>
					</li>
				</Col>
			</Row>
		</Container>
	</Header>
	</>
)
};