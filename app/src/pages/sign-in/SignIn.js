import React from "react";
import {SignInFormContent} from "./sign-in/SignInFormContent";
import {SignUpFormContent} from "./sign-up/SignUpFormContent";

export const SignIn =() => {
	return (
		<>
			<div className="container">
			<SignInFormContent/>
			</div>
			<div className="container">
			<SignUpFormContent/>
			</div>
		</>
	)
}