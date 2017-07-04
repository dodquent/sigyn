'use strict';
var AWSCognito = require('amazon-cognito-identity-js-node');

module.exports.signin = (event, context, callback) => {

    const data = JSON.parse(event.body);

    var authenticationData = {
        Username: data.name,
        Password: data.password
    };
    var authenticationDetails = new AWSCognito.AuthenticationDetails(authenticationData);

    var poolData = {
        UserPoolId: 'eu-west-1_QrzGaubhy',
        ClientId: '4l0luscskuf56rqkeh7er7lje6'
    };
    var userPool = new AWSCognito.CognitoUserPool(poolData);

    var userData = {
        Username: data.name,
        Pool: userPool
    };

    var cognitoUser = new AWSCognito.CognitoUser(userData);
    cognitoUser.authenticateUser(authenticationDetails, {
        onSuccess: function(result) {
            console.log('access token + ' + result.getAccessToken().getJwtToken());
            console.log('idToken + ' + result.idToken.jwtToken);
            const response = {
                statusCode: 200,
                body: JSON.stringify({
                    message: result.idToken.jwtToken,
                    input: event,
                })
            };
            callback(null, response);
        },

        onFailure: function(err) {
            console.log(err);
            const response = {
                statusCode: err.statusCode,
                body: JSON.stringify({
                    message: err,
                    input: event,
                })
            };
            callback(null, response);
        },
    });
};