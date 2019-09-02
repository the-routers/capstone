//This logout work around found at https://github.com/aws-amplify/amplify-js/issues/630. Here is a simple signout button. https://github.com/aws-amplify/amplify-js/pull/1000.
//Per Paul, wait until upload component page is working before we commit to completing a sign out button.
//Sign out may automatically occur after some time passes for the user.


class App extends React.Component {
	render() {
		return (
			<button onClick={this.handleLogout}>Logout</button>
		);
	}

	handleLogout = () => {
		const {authState, authData} = this.props;
		const greetings = new Greetings({
			authState,
			authData,
			onStateChange: this.handleAuthStateChange,
		});
		greetings.signOut();
	}
}