import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from '../FormDebugger';
import React from "react";

export const SignUpFormContent = (props) => {
	const {
		submitStatus,
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
	//console.log(values);
	return (
		<>
			<form onSubmit={handleSubmit} className="background-pattern-1">
				<h4 className="mt-5">Sign-up here</h4>

				<h1> Sign Up </h1>
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
							value={values.userEmail}
							placeholder="Enter your email"
							onChange={handleChange}
							onBlur={handleBlur}
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
							id="userPassword"
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
					<label htmlFor="userPasswordConfirm">Confirm your password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="key"/>
							</div>
						</div>
						<input
							className="form-control"
							type="password"
							id="userPasswordConfirm"
							placeholder="Password confirmed"
							value={values.userPasswordConfirm}
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.userPasswordConfirm && touched.userPasswordConfirm && (
						<div className="alert alert-danger">{errors.userPasswordConfirm}</div>
					)}
				</div>

				<div className="form-group">
					<label htmlFor="userName">Username</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="key"/>
							</div>
						</div>
						<input
							className="form-control"
							id="userName"
							type="text"
							value={values.userName}
							placeholder="Enter your username"
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{
						errors.userName && touched.userName && (
							<div className="alert alert-danger">
								{errors.userName}
							</div>
						)
					}
				</div>

				<div className="form-group">
					<button className="btn mb-2 b-submit-signin" type="submit">Submit</button>
					<button
						className="btn btn-danger mb-2"
						onClick={handleReset}
						disabled={!dirty || isSubmitting}
					>Reset
					</button>
				</div>
				<FormDebugger {...props} />

			</form>
			{console.log(
				submitStatus
			)}

			{
				submitStatus && (<div className={submitStatus.type}>{submitStatus.message}</div>)
			}
		</>


	)
};