import React from "react";
import {SignInForm} from "./sign-in/SignInForm";
import {Footer} from "../../shared/components/Footer";
import {SignUpForm} from "./sign-up/SignUpForm";

export const SignIn =() => {
	return (
		<>
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



