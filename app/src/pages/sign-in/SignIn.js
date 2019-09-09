import React from "react";
import {SignInForm} from "./sign-in/SignInForm";
import {Footer} from "../../shared/components/Footer";
import {SignUpForm} from "./sign-up/SignUpForm";
import {Header} from "../../shared/components/header";

export const SignIn =() => {
	return (
		<>
			<Header />
			<div className="container">
			<SignInForm/>
			<SignUpForm/>
			</div>

			<div className="container">
				<Footer />
			</div>
		</>
	)

};



