import json
import boto3
import os
import urllib.request

dynamodb = boto3.resource('dynamodb')

def createPro(event, context):
    param = json.loads(event['body'])
    username = param['username']
    password = param['password']

    table = dynamodb.Table(os.environ['DYNAMODB_TABLE'])

    item = {
        "name": username,
        "password": password
    }

    table.put_item(Item=item)

    response = {
        "statusCode": 200,
        "body": json.dumps(item)
    }
    return response

def createPatient(event, context):
    param = json.loads(event['body'])
    username = param['username']
    password = param['password']
    proname = param['proname']
    api = os.environ['API_URL'] + "patients"

    parameters = json.dumps({"username": username, "password": password, "proname": proname}).encode('utf8')

    req = urllib.request.Request(api, data=parameters, headers={'content-type': 'application/json'})
    res = urllib.request.urlopen(req)
    #need to check the response

    response = {
        "statusCode": 200,
        "body": json.dumps({"ok": "ok"})
    }
    
    return response

