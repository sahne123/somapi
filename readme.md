Simple REST-API to organize **Shadows of Brimstone** Characters and Parties. Build with [Laravel](https://github.com/laravel/laravel).

## Usage
Every request needs the paramater `api_token` with an valid token (see users table). The Response is JSON. If a Resource could not be found for updating or deleting the response will be HTTP-Status 204 (no text).

### Working with Resources
For each Resource there are 5 Methods.

HTTP-Verb | Url | Description | Params | Success `status_code`
--------- | --- | ----------- | ------ | ---------------------
GET | /api/v1/`resource` | Get all Resources | none | 200
GET | /api/v1/`resource`/`id` | Get Resource by Id | none | 200
POST | /api/v1/`resource` | Create Resources | all required attributes of the resource | 201
PUT | /api/v1/`resource`/`id` | Update Resource| all required attributes of the resource including the id | 200
DELETE | /api/v1/`resource`/`id` | Delete Resource | none | 200

Implemented Resources:
- Groups
- Characters

### Samples

#### `GET` api/v1/groups
##### Paramaters
none
##### Success-Response
```
{
    "groups": [
        {
            "id": 1,
            "name": "Die rechte und die linke Hand des Teufels"
        },
        {
            "id": 2,
            "name": " Vier Fäuste für ein Halleluja"
        }
    ],
    "status_code": 200,
    "error": false
}
```

#### `GET` api/v1/groups/`id`
Get group by id.

##### Paramaters
none
##### Success-Response
```
{
    "group": {
        "id": 1,
        "name": "Die rechte und die linke Hand des Teufels"
    },
    "status_code": 200,
    "error": false
}
```

#### `POST` api/v1/groups
Create group.

##### Paramaters
Parameter | Description
--------- | -----------
name      | Name of the Group
##### Success-Response
```
{
    "group": {
        "id": 1,
        "name": "Die rechte und die linke Hand des Teufels"
    },
    "status_code": 201,
    "error": false
}
```

#### `PUT` api/v1/groups/`id`
Update group.

##### Paramaters
Parameter | Description
--------- | -----------
id        | Id of the Group
name      | Name of the Group
##### Success-Response
```
{
    "group": {
        "id": 1,
        "name": "Die rechte und die linke Hand des Teufels"
    },
    "status_code": 200,
    "error": false
}
```

#### `DELETE` api/v1/groups/`id`
Delete group.

##### Paramaters
none
##### Success-Response
```
{
    "group": {
        "id": 1,
        "name": "Die rechte und die linke Hand des Teufels"
    },
    "status_code": 200,
    "error": false
}
```

### Error-Responses

##### Invalid or missing api_token
```
{
    "status_code": 401,
    "error": "Unauthorized."
}
```
##### Invalid URL
```
{
    "status_code": 400,
    "error": "Invalid url."
}
```
##### Invalid HTTP-Verb for given Url
```
{
    "status_code": 400,
    "error": "HTTP-Verb not allowed."
}
```
##### Id mismatch on update (checks id from the url against url in the data)
```
{
    "status_code": 400,
    "error": "Id mismatch."
}
```
##### Resource not found (sample)
```
{
    "status_code": 404,
    "error": "Group not found."
}
```
##### various Errors. E.g. Valiation Errors (sample)
```
{
    "status_code": 422,
    "error": "Validation failed. The name field is required."
}
```
