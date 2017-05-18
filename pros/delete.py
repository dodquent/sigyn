import os
import json
import boto3
dynamodb = boto3.resource('dynamodb')
 
def delete(event, context):
    table = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    table.delete_item(
        Key={
            'id': event['pathParameters']['id']
        }
    )

    response = {
        "statusCode": 200,
        "body": "User deleted"
    }

    return response
