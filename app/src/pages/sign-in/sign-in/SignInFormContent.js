import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
// import {FormDebugger} from "../../FormDebugger";
import React from "react";

export const SignInFormContent = (props) => {
	// const {
	// 	status,
	// 	values,
	// 	errors,
	// 	touched,
	// 	dirty,
	// 	isSubmitting,
	// 	handleChange,
	// 	handleBlur,
	// 	handleSubmit,
	// 	handleReset
	// } = props;
	return (
		<>
			<header/>
			<div className="container-fluid">
				<section className="background-pattern-1">
					<form>
						<h2 className="h2-center">Sign-in or sign-up to post content for a Route 66 Sign</h2>
						<h4 className="mt-5">Sign-in here</h4>
						{/*controlId must match what is passed to the initialValues prop*/}
						<div className="form-group">
							<label htmlFor="userEmail">Email Address</label>
							<div className="input-group">
								<div className="input-group-prepend">
									<div className="input-group-text">
										<FontAwesomeIcon icon="envelope"/>
									</div>
								</div>
								<input
									className="form-control"
									id="userEmail"
									type="email"
									placeholder="Enter your email"
								/>
							</div>
							<div className="alert alert-danger">
								<p>Email error</p>
							</div>
						</div>
						{/*controlId must match what is defined by the initialValues object*/}
						<div className="form-group">
							<label htmlFor="userPassword">Password</label>
							<div className="input-group">
								<div className="input-group-prepend">
									<div className="input-group-text">
										<FontAwesomeIcon icon="key"/>
									</div>
								</div>
								<input
									id="userPassword"
									className="form-control"
									type="password"
									placeholder="Enter your password"
								/>
							</div>
							<div className="alert alert-danger">
								<p> Password error</p>
							</div>
						</div>
						<div className="form-group">
							<button className="btn mb-2" type="submit">Submit</button>
							<button
								className="btn btn-danger mb-2"
							>Reset
							</button>
						</div>
						{/*<FormDebugger {...props} />*/}
					</form>
				</section>
			</div>
		</>
	)
};