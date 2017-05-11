import json
import boto3
import os

dynamodb = boto3.resource('dynamodb')

def createPatient(event, context):
    param = json.loads(event['body'])
    username = param['username']
    password = param['password']
    proname = param['proname']

    table = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    item = {
        "name": username,
        "password": password,
        "proname": proname
    }

    table.put_item(Item=item)

    response = {
        "statusCode": 200,
        "body": json.dumps(item)
    }
    return response
