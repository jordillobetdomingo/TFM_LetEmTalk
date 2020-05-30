API actions can do.

Create user:

    URL: http://localhost:8000/user/
    method: POST
    Body json (example): 
    {
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
    
Login:
    
    URL: http://localhost:8000/login/
    methods: GET|POST

Create Room:

    URL: http://localhost:8000/room/
    method: POST
    Body json (example): 
    {
        "userId": 1
    }

Read Room with Issues:

    URL: http://localhost:8000/room/{roomId}/
    method: GET
    Return JSON
    
Delete Room:

    URL: http://localhost:8000/room/{roomId}/
    method: DELETE
    
Create Issue:

    URL: http://localhost:8000/issue/
    method: POST
    Body json (example): 
    {
        "roomId": 3,
        "title": "Tilte test issue",
        "text": "Text for the first pill for the test issue",
        "authorId": 4
    }
    
Read Issue with pills:

    URL: http://localhost:8000/{issueId}/
    method: GET
    Return JSON
    
Update Issue:

    URL: http://localhost:8000/issue/{issueId}/
    method: POST
    Body json (example): ("textFirstPill" is opcional)
    {
        "title": "Tilte modified test issue",
        "textFirstPill": "Text modified for the first pill for the test issue"
    }
    
Delete Issue:

    URL: http://localhost:8000/issue/{issueId}/
    method: DELETE
    
Create Pill:

    URL: http://localhost:8000/pill/
    method: POST
    Body json (example): 
    {
    	"issueId": 3,
    	"text": "This is a new pill",
    	"authorId": 4
    }
    
Update Pill:

    URL: http://localhost:8000/pill/{pillId}/
    method: POST
    Body json (example):
    {
    	"text": "Text modified" 
    }
    
Delete Pill:

    URL: http://localhost:8000/pill/{pillId}/
    method: DELETE
    
Read roles:

    URL: http://localhost:8000/roles/
    method: GET
    Return JSON
    
Create User To Room Permission

    URL: http://localhost:8000/permission/room/
    method: POST
    Body json (example):
    {
        "userId": 1,
        "roomId": 2,
        "roleId": 2 
    }
    
 Create User To Issue Permission
 
     URL: http://localhost:8000/permission/issue/
     method: POST
     Body json (example):
     {
         "userId": 1,
         "issueId": 2,
         "roleId": 2 
     }