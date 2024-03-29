import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from '../FormDebugger';
import React from "react";
export const SignInFormContent = (props) => {
	const {
		status,
		values,
		errors,
		touched,
		dirty,
		isSubmitting,
		handleChange,
		handleBlur,
		handleSubmit,
		handleReset
	} = props;

	console.log(values);
	return (
		<>
			<header/>
			<form onSubmit={handleSubmit} className="background-pattern-1">
				<h2 className="h2-center">Sign-in or sign-up to post content for a Route 66 sign</h2>
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
									name="userEmail"
									type="email"
									value={values.userEmail}
									onChange={handleChange}
									onBlur={handleBlur}
									placeholder="Enter your email"
								/>
							</div>
						{
							errors.userEmail && touched.userEmail && (
								<div className="alert alert-danger">
									{errors.userEmail}
								</div>
							)

						}
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
									name="userPassword"
									className="form-control"
									type="password"
									placeholder="Enter your password"
									value={values.userPassword}
									onChange={handleChange}
									onBlur={handleBlur}
								/>
							</div>
							{errors.userPassword && touched.userPassword && (
								<div className="alert alert-danger">{errors.userPassword}</div>
							)}
						</div>
						<div className="form-group">
							<button className="btn mb-2 b-submit-signin" type="submit">Submit</button>
							<button className="btn b-submit-reset "
									  onClick={handleReset}
									  //disabled={!dirty || isSubmitting}
							>Reset
							</button>
						</div>
						{/*<FormDebugger {...props} />*/}
					</form>
			{status && (<div className={status.type}>{status.message}</div>)}
			</>
	)
};