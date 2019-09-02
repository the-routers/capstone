


//This logout work around found at https://github.com/aws-amplify/amplify-js/issues/630


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