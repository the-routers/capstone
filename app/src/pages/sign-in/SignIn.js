import React from "react";
import {SignInFormContent} from "./sign-in/SignInFormContent";
import {SignUpFormContent} from "./sign-up/SignUpFormContent";
import {Footer} from "../../shared/components/Footer";

export const SignIn =() => {
	return (
		<>
			<div className="container">
			<SignInFormContent/>
			</div>
			<div className="container">
			<SignUpFormContent/>
			</div>
			<div className="container">
				<Footer />
			</div>
		</>
	)

};



