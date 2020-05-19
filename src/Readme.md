API actions can do.

Create user:

    URL: http://localhost:8000/user/
    method: POST
    Body json (example): {
        "id":1,
        "first_name":"Joan",
        "last_name":"Garcia",
        "email","example@example.com"   
    }
    
Read users:

    URL: http://localhost:8000/users/
    method: GET
    Return JSON
    
Delete user:

    URL: http://localhost:8000/user/{id}/
    method: DELETE
