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
							<a href="/app/src/pages/Home.js" className="text-center" target="_blank" rel="noopener noreferrer">Home</a>|
							<a href="/app/src/pages/" className="text-center" target="_blank" rel="noopener noreferrer">Find a Sign</a>|
							<a href="/app/src/pages/Gallery.js" className="text-center" target="_blank" rel="noopener noreferrer">Gallery</a>|
							<a href="/app/src/pages/PhotoUpload.js" className="text-center" target="_blank" rel="noopener noreferrer">Post Your Photos </a>|
							<a href="#" className="text-center" target="_blank" rel="noopener noreferrer">About</a>|
							<a href="#" className= "text-center" target="_blank" rel="noopener noreferrer">Contact Us</a>
						</div>
					</Row>
				</Container>
			</footer>
			</div>
		</>
	)
};