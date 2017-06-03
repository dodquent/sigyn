import os 
import json 
import boto3
dynamodb = boto3.resource('dynamodb')
 
def login(event, context):
    data = json.loads(event['body'])
    users = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    user = users.get_item(
        Key={
            'email': data['email']
        }
    )

    if not user:
        statusCode = 400
        body = {
            "error": "Incorrect credentials",
        }
    else:
        statusCode = 200
        body = {
            "token": "123456789"
        }

    response = {
        "statusCode": statusCode,
        "body": json.dumps(body)
    }

    return response

    # Use this code if you don't use the http event with the LAMBDA-PROXY integration
    """
    return {
        "message": "Go Serverless v1.0! Your function executed successfully!",
        "event": event
    }
    """
