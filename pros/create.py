import json
import os
import time
import uuid

import boto3
cognito = boto3.client('cognito-idp', region_name='eu-west-1')

def create(event, context):
    data = json.loads(event['body'])

    if 'email' not in data or 'name' not in data:
        response = {
            "statusCode": 400,
            "body": "Missing parameters",
        }
        return response

    res = cognito.admin_create_user(
        UserPoolId='eu-west-1_QrzGaubhy',
        Username=data['name'],
        UserAttributes=[
            {
                'Name': 'email',
                'Value': data['email']
            }
        ]
    )

    response = {
        "statusCode": 200,
        "body": json.dumps(res)
    }

    return response

