import React from "react";
import Dropdown from 'react-bootstrap/Dropdown';
import Navbar from 'react-bootstrap/Navbar'
import {LinkContainer} from "react-router-bootstrap"
import ButtonToolbar from "react-bootstrap/ButtonToolbar";
import DropdownButton from "react-bootstrap/DropdownButton";

export const MainNav = () => (

	<ButtonToolbar>
		{['left'].map(direction => (
			<DropdownButton
				drop={direction}
				variant="dark"
				title={` Menu `}
				id={`dropdown-button-drop-${direction}`}
				key={direction}
			>
				<LinkContainer exact to="/">
					<li className="nav-item">
						<a className="nav-link">Home</a>
					</li>
				</LinkContainer>
				<LinkContainer to="sign-in">
					<li className="nav-item">
						<a className="nav-link">Sign In/Sign Up</a>
					</li>
				</LinkContainer>
				<LinkContainer to="map">
					<li className="nav-item">
						<a className="nav-link">Map</a>
					</li>
				</LinkContainer>
				<LinkContainer to="gallery">
					<li className="nav-item">
						<a className="nav-link">Gallery</a>
					</li>
				</LinkContainer>
			</DropdownButton>
		))}
	</ButtonToolbar>

		// <Navbar collapseOnSelect expand="xs" bg="none" variant="dark">
		// <Navbar.Toggle aria-controls="responsive-navbar-nav" />
		// <Navbar.Collapse id="responsive-navbar-nav">
		// <ul className="navbar-nav">
		//
		// 			<LinkContainer exact to="/">
		// 				<li className="nav-item">
		// 					<a className="nav-link" href="/">Home</a>
		// 				</li>
		// 			</LinkContainer>
		// 			<LinkContainer to="sign-in">
		// 			<li className="nav-item">
		// 					<a className="nav-link" href="">Sign In/Sign Up</a>
		// 				</li>
		// 		</LinkContainer>
		// 			<LinkContainer to="map">
		// 				<li className="nav-item">
		// 				<a className="nav-link" href="">Map</a>
		// 			</li>
		// 			</LinkContainer>
		// 			<LinkContainer to="gallery">
		// 				<li className="nav-item">
		// 					<a className="nav-link" href="">Gallery</a>
		// 				</li>
		// 			</LinkContainer>
		// 		</ul>
		// 	</Navbar.Collapse>
		// </Navbar>

);
