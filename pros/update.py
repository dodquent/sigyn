import json
import os
import time
import uuid

import boto3
dynamodb = boto3.resource('dynamodb')

def update(event, context):
    data = json.loads(event['body'])
    
    timestamp = int(time.time() * 1000)

    table = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    if 'email' not in data or 'name' not in data or 'password' not in data or 'type' not in data:
        response = {
            "statusCode": 400,
            "body": "Missing parameters"
        }
        return response

    item = {
        'id': event['pathParameters']['id'],
        'email': data['email'],
        'name': data['name'],
        'password': data['password'],
        'type': data['type'],
        'createdAt': timestamp
    }

    table.put_item(Item=item)

    response = {
        "statusCode": 200,
        "body": json.dumps(item)
    }

    return response
