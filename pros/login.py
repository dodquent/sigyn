import os 
import json 
import boto3
dynamodb = boto3.resource('dynamodb')

def login(event, context):
    response = {
        "statusCode": statusCode,
        "body": json.dumps("c pas encore ca")
    }

    return response
