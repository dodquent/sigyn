import json
import time
import logging
import os

from todos import decimalencoder
import boto3
dynamodb = boto3.resource('dynamodb')

def update(event, context):
    data = json.loads(event['body'])
    
    timestamp = int(time.time() * 1000)

    item = {
        'id': event['pathParameters']['id']
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