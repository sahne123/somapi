Simple REST-API to organize **Shadows of Brimstone** Characters and Groups. Build with [Laravel](https://github.com/laravel/laravel).

## Usage
Every request needs the paramater `api_token` with an valid token (see users table). The Response is JSON.

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

### Working with Resource-Relations
HTTP-Verb | Url | Description | Params | Success `status_code`
--------- | --- | ----------- | ------ | ---------------------
GET | /api/v1/`resource1`/`id`/`resource2` | Get all Resources2 from the Resource1 with the given id | none | 200
POST | /api/v1/`resource1`/`id`/`resource2` | Assign a existing Resources2 to the Resource1 with the given id| id of Resource2 | 201
DELETE | /api/v1/`resource1`/`id1`/`resource2`/`id2` | Detach Resource2 with the id2 from Resource1 with the given id1 | none | 200

Implemented Resources:
- Groups/Characters

Note: There is always a leading Resource `groups/1/chracters` will work, `characters/5/groups` will not work.

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

#### `GET` api/v1/groups/`id`/characters
##### Paramaters
none
##### Success-Response
```
{
    "characters": [
        {
            "id": 1,
            "name": "Bud Spencer",
            "keywords": "actor, filmmaker, professional swimmer",
            "level": 99,
            "initiative": 4,
            "agility": 4,
            "cunning": 2,
            "spirit": 3,
            "strength": 10,
            "lore": 1,
            "luck": 8,
            "maxgrit": 2,
            "combat": 4,
            "range": 5,
            "melee": 3,
            "health": 16,
            "defense": 3,
            "sanity": 8,
            "willpower": 4,
            "pivot": {
                "group_id": 1,
                "character_id": 1
            }
        }
    ],
    "status_code": 200,
    "error": false
}
```

#### `POST` api/v1/groups/`id`/characters
##### Paramaters
Parameter | Description
--------- | -----------
id        | Id of the Character
##### Success-Response
```
{
    "status_code": 201,
    "error": false
}
```

#### `DELETE` api/v1/groups/`group_id`/characters/`character_id`
##### Paramaters
none
##### Success-Response
```
{
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
