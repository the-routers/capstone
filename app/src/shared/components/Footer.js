import React from "react";
import {Link, Route} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const Footer = () => {
	return (
		<>
			<div className="d-flex justify-content-center">
			<footer className="page-footer text-muted py-2 py-md-4">
				<Container fluid="true">
					<Row>
						<div className="text-center">
							<a href="mailto:signson66abq@gmail.com" className="text-center" target="_blank" rel="noopener noreferrer"> Suggestion? Email US!
							</a>
						</div>
					</Row>
					<Row>
						<div className="text-center">
							<Link to="/" className="text-center" target="_blank" rel="noopener noreferrer">Home</Link>|
							<Link to="/map" className="text-center" target="_blank" rel="noopener noreferrer">Find a Sign</Link>|
							<Link to="/gallery" className="text-center" target="_blank" rel="noopener noreferrer">Gallery</Link>|
							<Link to="/photo-upload" className="text-center" target="_blank" rel="noopener noreferrer">Post Your Photos </Link>|
							<Link to="/about" className="text-center" target="_blank" rel="noopener noreferrer">About</Link>|
							<Link to="/contact-us" className= "text-center" target="_blank" rel="noopener noreferrer">Contact Us</Link>
						</div>
					</Row>
				</Container>
			</footer>
			</div>
		</>
	)
};