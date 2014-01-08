# MVC pattern within RESTful API proof of concept

This project is just a proof of concept about working with MVC and RESTful APIs

## Objects

There are a couple of objects available you can interact with:

	- Person: Object to store the information about persons
	- Team: Object to store the information about teams (teams are composed by persons)

## Methods

The available methods to access the objects are:

	- PUT: Creates a new instance of the object (No ID need since it will be returned)
	- GET: Retrieves information about the object
	- POST: Updates the information inside the object
	- DELETE: Deletes the object

## Queries' bodies

The body is only needed for PUT and POST methods and it depends on the object.

So for the Person object, the expected body is:

	{
		"name": <string>,
		"surname": <string>,
		"age": int
	}

And for the team object, the expected body is:

	{
		"name": <string>,
		"members": [<int>, <int>, <int>, ...]
	}

## Examples

The source code comes with two persons and one team preloaded

Create a new person:

	URL: http://<hostname>/personController/
	Method: PUT
	Body: {
		"name": "John",
		"surname": "Lennon",
		"age": 30
	}

Show person information:

	URL: http://<hostname>/personController/1388791496
	Method: GET
	Body: {}

Update a team:

	URL: http://<hostname>/teamController/1388791552
	Method: POST
	Body: {
		"members": [1388791496,1388791507]
	}

Delete a team:

	URL: http://<hostname>/teamController/1388791552
	Method: DELETE
	Body: {}

## Farewell

That's all, thanks for reading.
