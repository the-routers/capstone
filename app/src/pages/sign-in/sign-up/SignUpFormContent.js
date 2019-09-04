import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
// import {FormDebugger} from "../../FormDebugger";
import React from "react";

export const SignUpFormContent = (props) => {
	// const {
	// 	submitStatus,
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
			<form>
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
						/>
					</div>
							<div className="alert alert-danger">
								<p> </p>
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
							<p>Enter Password</p>
						</div>
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
						/>
					</div>
						<div className="alert alert-danger">
						<p>
							Confirm your password
						</p>
						</div>
				</div>


				<div className="form-group">
					<label htmlFor="userName">Username</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="user"/>
							</div>
						</div>
						<input
							className="form-control"
							id="userName"
							type="text"
						/>
					</div>

							<div className="alert alert-danger">
								<p>User name is must</p>
							</div>
				</div>

				<div className="form-group">
					<button className="btn btn-primary mb-2" type="submit">Submit</button>
					<button
						className="btn btn-danger mb-2"
					>Reset
					</button>
				</div>


			</form>

		</>


	)
};