import {httpConfig} from "../../../shared/utils/http-config";
import {Formik} from "formik/dist/index";
import * as Yup from "yup";
import {SignInFormContent} from "./SignInFormContent";
import React, {useState} from 'react';
import {Redirect} from "react-router";


export const SignInForm = () => {
	// // state variable to handle redirect to posts page on sign in
const [toPosts, setToPosts] = useState(null);

	const validator = Yup.object().shape({
		userEmail: Yup.string()
			.email("Email must be a valid email")
			.required('Email is required'),
		userPassword: Yup.string()
			.required("Password is required")
			.min(8, "Password must be at least eight characters")
	});


	//the initial values object defines what the request payload is.
	const signIn = {
		userEmail: "",
		userPassword: ""
	};

	const submitSignIn = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/sign-in/", values)
			.then(reply => {
				let {message, type} = reply;
				setStatus({message, type});
				if(reply.status === 200 && reply.headers["x-jwt-token"]) {
					window.localStorage.removeItem("jwt-token");
					window.localStorage.setItem("jwt-token", reply.headers["x-jwt-token"]);
					resetForm();
					 setTimeout(() => {
					// 	setToPosts(true);
						window.location = "/map";
					 }, 750);
				}

				setStatus({message, type});

			});
	};

	return (
		<>
			{/*redirect user to posts page on sign in*/}
			{toPosts ? <Redirect to="/map" /> : null}

			<Formik
				initialValues={signIn}
				onSubmit={submitSignIn}
				validationSchema={validator}
			>
				{SignInFormContent}
			</Formik>
		</>
	)
};
