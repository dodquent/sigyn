import os
import json
import boto3
dynamodb = boto3.resource('dynamodb')
 
def delete(event, context):
    table = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    table.delete_item(
        Key={
            'email': event['pathParameters']['id']
        }
    )

    item = {
        'id': str(uuid.uuid1())
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
