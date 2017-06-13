import json
import os
import time
import uuid

import boto3
cognito = boto3.client('cognito-idp', region_name='eu-west-1')

def confirm(event, context):
    data = json.loads(event['body'])

    if 'code' not in data or 'username' not in data:
        response = {
            "statusCode": 400,
            "body": "Missing parameters",
        }
        return response

    code = data['code']
    username = data['username']

    try:
        res = cognito.confirm_sign_up(
            ClientId=os.environ['COGNITO_ID'],
            Username=username,
            ConfirmationCode=code
        )
    except Exception as e:
        res = str(e)
    response = {
        "statusCode": 200,
        "body": json.dumps(res)
        }
    return response

