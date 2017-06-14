'use strict';
var AWSCognito = require('amazon-cognito-identity-js-node');

module.exports.signin = (event, context, callback) => {

	var authenticationData = {
		Username: 'thomas',
		Password: 'Toto1234@'
	};
	var authenticationDetails = new AWSCognito.AuthenticationDetails(authenticationData);

	var poolData = {
		UserPoolId: 'eu-west-1_QrzGaubhy',
		ClientId: '4l0luscskuf56rqkeh7er7lje6'
	};
	var userPool = new AWSCognito.CognitoUserPool(poolData);

	var userData = {
		Username: 'thomas',
		Pool: userPool
	};

	var cognitoUser = new AWSCognito.CognitoUser(userData);
	cognitoUser.authenticateUser(authenticationDetails, {
		onSuccess: function (result) {
			console.log('access token + ' + result.getAccessToken().getJwtToken());
			/*Use the idToken for Logins Map when Federating User Pools with Cognito Identity or when passing through an Authorization Header to an API Gateway Authorizer*/
			console.log('idToken + ' + result.idToken.jwtToken);
			const response = {
				statusCode: 200,
				body: JSON.stringify({
					message: result.idToken.jwtToken,
					input: event,
				}),
			};
			callback(null, response);
		},

		onFailure: function (err) {
			console.log(err);
		},

	});


	// Use this code if you don't use the http event with the LAMBDA-PROXY integration
	// callback(null, { message: 'Go Serverless v1.0! Your function executed successfully!', event });
};
