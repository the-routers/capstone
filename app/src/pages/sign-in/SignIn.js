import React, {useEffect} from "react";
import {SignInForm} from "./sign-in/SignInForm";
import {Footer} from "../../shared/components/Footer";
import {SignUpForm} from "./sign-up/SignUpForm";
import {Header} from "../../shared/components/header";
import {httpConfig} from "../../shared/utils/http-config";


export const SignIn =() => {

	useEffect(() => {
		httpConfig.get("/apis/earl-grey/")
	});

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



