import React, {useEffect} from "react";
import {Link, Route} from "react-router-dom";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {httpConfig} from "../utils/http-config";

export const Footer = () => {
	useEffect(() => {
		httpConfig.get("/apis/earl-grey/")
	});
	return (
		<>
			<div className="d-flex justify-content-center">
			<footer className="page-footer text-muted py-2 py-md-4">
				<Container fluid="true">
					<Row>
						<div className="d-flex justify-content-center ml-5 pl-5">
							<a href="mailto:signson66abq@gmail.com" className="text-center" target="_blank" rel="noopener noreferrer"> Suggestions? Email us!
							</a>
						</div>
					</Row>
					<Row>
						<div className="text-center">
							<Link to="/" className="text-center" rel="noopener noreferrer"> Home </Link>|
							<Link to="/map" className="text-center" rel="noopener noreferrer"> Find a Sign </Link>|
							<Link to="/gallery" className="text-center" rel="noopener noreferrer"> Gallery </Link>|
							<Link to="/photo-upload" className="text-center" rel="noopener noreferrer"> Post Your Photos </Link>
						</div>
					</Row>
				</Container>
			</footer>
			</div>
		</>
	)
};