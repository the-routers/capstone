import React from "react";
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const Footer = () => {
	return (
		<>
			<footer className="page-footer text-muted py-2 py-md-4">
				<Container fluid="true">
					<Row>
						<Col sm="6" className="text-center text-sm-left small">
							Octo Meow 7.0 => A DDC React Demo.
						</Col>
						<Col sm="6" className="text-center text-sm-right small">
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Suggestion? Email US!</a>
						</Col>
						<Col sm="6" className="text-center text-sm-right small">
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Home</a>
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Find a Sign</a>
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Gallery</a>
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Post Your Photos </a>
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">About</a>
							<a href="#" className="text-muted" target="_blank" rel="noopener noreferrer">Contact Us</a>
							s
						</Col>
					</Row>
				</Container>
			</footer>
		</>
	)
};