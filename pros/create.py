import json
import os
import time
import uuid

import boto3
from botocore.exceptions import ClientError
cognito = boto3.client('cognito-idp', region_name='eu-west-1')

def create(event, context):
    data = json.loads(event['body'])

    if 'email' not in data or 'name' not in data:
        response = {
            "statusCode": 400,
            "body": "Missing parameters",
        }
        return response

    try:
        res = cognito.sign_up(
            ClientId=os.environ['COGNITO_ID'],
            Username=data['name'],
            Password=data['password'],
            UserAttributes=[
                {
                    'Name': 'email',
                    'Value': data['email']
                },
                {
                    'Name': 'family_name',
                    'Value': data['family_name']
                },
                {
                    'Name': 'name',
                    'Value': data['name']
                },
            ]
        )
    except Exception as e:
        res = str(e)
    response = {
        "statusCode": 200,
        "body": json.dumps(res)
    }

    return response

