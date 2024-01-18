# EAP: Architecture Specification and Prototype

At the heart of our project vision for Feupbook is the unwavering commitment to creating an innovative and vibrant social network tailored specifically for the students of the Faculty of Engineering at the University of Porto (FEUP). We envision Feupbook as a dynamic and inclusive online ecosystem, revolutionizing the way FEUP students connect, share, and engage within their academic community.

## A7: Web Resources Specification

This document presents the Web Resources Specification artifact, detailing the structure and functions of the web API we aim to develop. It provides clarity on the essential resources, their specific properties, and the anticipated JSON responses. Covering the full spectrum of operations, from creation and retrieval to updating and deletion, this specification ensures a clear and straightforward blueprint for the API's development.

### 1. Overview

| Modules             | Description                                                                                                                                    |
| ------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------- |
| M01: Authentication | Pertains to user login procedures, including sign-in/sign-out and new user registration.                                                       |
| M02: Users          | Centers on user-related functionalities such as accessing profiles, updating personal details, managing alerts, and chatting with other users. |
| M03: Posts          | Focuses on creating, updating, removing, and viewing posts.                                                                                    |
| M04: Search         | Encompasses tools for querying data, enabling users to find specific users.                                                                    |
| M05: Administration | Deals with site governance, from imposing community guidelines to moderating user activity and refining web content.                           |
| M06: Comments       | Dedicated to user feedback, facilitating the addition, modification, removal, and visualization of comments.                                   |

Table 39: Feupbook modules

### 2. Permissions

The following section elaborates on the roles and associated permissions identified in the prior segment (modules) that determine the user's capability to interact with resources.

| Identifier | Name          | Description                            |
| ---------- | ------------- | -------------------------------------- |
| VST        | Visitor       | An unauthenticated user.               |
| USR        | User          | An authenticated user.                 |
| OWN        | Owner         | The owner of a post, comment, profile. |
| ADM        | Administrator | Platform administrator.                |

Table 40: Feupbook permissions

### 3. OpenAPI Specification

This section includes the [Feupbook OpenAPI Specification](https://git.fe.up.pt/lbaw/lbaw2324/lbaw23141/-/blob/main/docs/a7_openapi.yaml).

```yaml
openapi: 3.0.0

info:
 version: '1.0'
 title: 'Feupbook Web API'
 description: 'Web Resources Specification (A7) for Feupbook'

servers:
- url: https://lbaw23141.lbaw.fe.up.pt
  description: Production server

externalDocs:
 description: Find more info here.
 url: https://git.fe.up.pt/lbaw/lbaw2324/lbaw23141/-/wikis/eap

tags:
 - name: 'M01: Authentication'
 - name: 'M02: Users'
 - name: 'M03: Posts'
 - name: 'M04: Search'
 - name: 'M05: Administration'
 - name: 'M06: Comments'

paths:

######### WELCOME #########

  /:

    get:
      operationId: R000
      summary: 'R000: Welcome page'
      description: 'Shows the welcome page. Access: VST'
      tags:
        - 'M01: Authentication'

      responses:
        '200':
          description: 'Ok. Show welcome UI.'

############################################ AUTENTICATION ############################################

######### LOGIN #########

  /login:

    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: VST'
      tags:
        - 'M01: Authentication'

      responses:
        '200':
          description: 'OK. Show log-in UI'

    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: VST'
      tags:
        - 'M01: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urllencoded:
            schema:
              properties:
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
              required:
                  - email
                  - password

      responses:
        '302':
          description: 'Redirect after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                homeRedirect:
                  description: 'Successful authentication. Redirect to home page.'
                  value: '/home'
                loginRedirect:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'

######### LOGOUT #########

  /logout:

    get:
      operationId: R103
      summary: 'R103 : Logout Action'
      description: 'Logout the current authenticated user. Access: USR, ADM'
      tags:
        - 'M01: Authentication'

      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                loginRedirect:
                  description: 'Successful logout. Redirect to login form.'
                  value: '/login'

######### REGISTER #########

  /register:

    get:
      operationId: R104
      summary: 'R104 : Register Form'
      description: 'Provide new user registration form. Access: VST'
      tags:
        - 'M01: Authentication'

      responses:
        '200':
          description: 'Ok. Show Sign-Up UI.'

    post:
      operationId: R105
      summary: 'R105 : Register Action'
      description: 'Processes the new user registration form submission. Access: VST'
      tags:
        - 'M01: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                name:
                  type: string
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
                confirm_password:
                  type: string
                  format: password
              required:
                - username
                - name
                - email
                - password
                - confirm_password;

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                  homeRedirect:
                    description: 'Successful registration. Redirect to home page.'
                    value: '/home'
                  registerRedirect:
                    description: 'Failed registration. Redirect to register form.'
                    value: '/register'

############################################ USERS ############################################

######### HOME PAGE #########

  /home:

    get:
      operationId: R201
      summary: 'R201: View user home page'
      description: 'Show user home page, Access: USR, ADM'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the home page for an individual user'
        '401':
          description: 'Unauthorized. The client must authenticate itself to get the requested response.'
          headers:
            Location:
              schema:
                type: string
              examples:
                  loginRedirect:
                    description: 'Redirect to the login page due to unauthorized access.'
                    value: '/login'
                  
######### FOR YOU HOME PAGE #########
  
  /home/forYou:

    get:
      operationId: R202
      summary: 'R202: View for you home page'
      description: 'Show for you home page, Access: USR, ADM'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the for you home page for an individual user'
        '401':
          description: 'Unauthorized. The client must authenticate itself to get the requested response.'
          headers:
            Location:
              schema:
                type: string
              examples:
                  loginRedirect:
                    description: 'Redirect to the login page due to unauthorized access.'
                    value: '/login'

######### PROFILE #########

  /user/{id}:

    get:
      operationId: R203
      summary: 'R203: View user profile'
      description: 'Show the individual user profile, Access: USR, OWN, ADM'
      tags:
        - 'M02: Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'OK. Show User profile UI.'
        '302':
          description: 'Redirect if user is not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                loginRedirect:
                  description: 'Redirect to the login page due to unauthorized access.'
                  value: '/login'
        '404':
          description: 'Not Found. The user does not exist.'
          
######### FOLLOW #########

  /user/{id}/follow:

    post:
      operationId: R204
      summary: 'R204: Follow a user.'
      description: 'Follows a user. Access: USR, ADM'
      tags:
        - 'M02: Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Ok. You followed a user.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Not Found'
          content:
            application/json:
              schema:
                type: object
                properties:
                  error_code:
                    type: string
                  message:
                    type: string
              examples:
                userNotFound:
                  value:
                    error_code: "UserNotFound"
                    message: "The user ID does not exist."
                alreadyAFollower:
                  value:
                    error_code: "AlreadyAFollower"
                    message: "The specified ID is already a follower of the user."

######### UNFOLLOW #########

  /user/{id}/unfollow:

    post:
      operationId: R205
      summary: 'R205: Unfollow a user.'
      description: 'Unfollows a user. Access: USR, ADM'
      tags:
        - 'M02: Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Ok. You unfollowed a user.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Not Found'
          content:
            application/json:
              schema:
                type: object
                properties:
                  error_code:
                    type: string
                  message:
                    type: string
              examples:
                userNotFound:
                  value:
                    error_code: "UserNotFound"
                    message: "The user ID does not exist."
                notAFollower:
                  value:
                    error_code: "NotAFollower"
                    message: "The specified ID is not a follower of the user."

######### ABOUT PAGE #########

  /about:

    get:
      operationId: R206
      summary: 'R206: About static page'
      description: 'Shows About Page. Access USR, ADM, VST'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the about page.'

######### HELP PAGE #########

  /help:

    get:
      operationId: R207
      summary: 'R207: Help static page'
      description: 'Shows Help Page. Access USR, ADM, VST'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the help page.'

######### FAQ PAGE #########

  /faq:

    get:
      operationId: R208
      summary: 'R208: FAQ static page'
      description: 'Shows FAQ Page. Access USR, ADM, VST'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the FAQ page.'

######### CONTACTS PAGE #########

  /contacts:

    get:
      operationId: R209
      summary: 'R209: Contacts static page'
      description: 'Shows Contacts Page. Access USR, ADM, VST'
      tags:
        - 'M02: Users'

      responses:
        '200':
          description: 'OK. Show the contacts page.'

############################################ POSTS ############################################

######### CREATE POST #########

  /post/create:

    get:
      operationId: R301
      summary: 'R301: Create post page'
      description: 'Shows the create post page. Access: USR'
      tags:
        - 'M03: Posts'

      responses:
        '200':
          description: 'Ok. Show create post UI.'

    post:
      operationId: R302
      summary: 'R302: Create post action'
      description: 'Creates a post. Access: USR'
      tags:
        - 'M03: Posts'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                content:
                  type: string
              required:
                - content

      responses:
        '302':
          description: 'Redirect once the new post information is processed.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Post created successfully. Redirect back.'
                302Failure:
                  description: 'Failed. Redirect back.'

######### POST PAGE #########

  /post/{id}:

    get:
      operationId: R303
      summary: 'R303: View post page'
      description: 'Shows the post page. Access: OWN, USR, ADM'
      tags:
        - 'M03: Posts'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Ok. Show post UI.'
        '404':
          description: 'Not Found. The post does not exist.'

######### EDIT POST #########

  /post/{id}/edit: 

    get:
      operationId: R304
      summary: 'R304: Edit post page'
      description: 'Shows the edit post page. Access: OWN, ADM'
      tags:
        - 'M03: Posts'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Ok. Show edit post UI.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Not Found'
          content:
            application/json:
              schema:
                type: object
                properties:
                  error_code:
                    type: string
                  message:
                    type: string
              examples:
                postNotFound:
                  value:
                    error_code: "PostNotFound"
                    message: "The post ID does not exist."
                postNotFromUser:
                  value:
                    error_code: "PostNotFromUser"
                    message: "The post does not belong to the user."

    post:
      operationId: R305
      summary: 'R305: Edit post action'
      description: 'Processes and saves the changes made by user. Access: OWN, ADM'
      tags:
        - 'M03: Posts'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                content:
                  type: string
              required:
                - content

      responses:
        '302':
          description: 'Redirect once the new post information is processed.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Post edited successfully. Redirect back.'
                302Failure:
                  description: 'Failed. Redirect back.'

######### DELETE POST #########

  /post/{id}/delete:

    post:
      operationId: R306
      summary: 'R306: Delete post action'
      description: 'Deletes a post. Access: OWN, ADM'
      tags:
        - 'M03: Posts'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '302':
          description: 'Redirect once the post is deleted.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Post deleted successfully. Redirect back.'
                302Failure:
                  description: 'Failed. Redirect back.'

############################################ SEARCH ############################################

######### SEARCH #########

  /search:

    get:
      operationId: R401
      summary: 'R401: Search page'
      description: 'Shows the search page. Access: USR, ADM'
      tags:
        - 'M04: Search'

      responses:
        '200':
          description: 'Ok. Show search UI.'
        '302':
          description: 'Redirect if user is not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                loginRedirect:
                  description: 'Redirect to the login page due to unauthorized access.'
                  value: '/login'

############################################ ADMINISTRATION ############################################

######### ADMIN USER EDIT PAGE #########

  /admin/user/{id}/edit:

    get:
      operationId: R501
      summary: 'R501: Admin edit user page'
      description: 'Shows the admin edit user page. Access: ADM'
      tags:
        - 'M05: Administration'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Ok. Show admin edit user UI.'
        '302':
          description: 'Redirect if user is not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                loginRedirect:
                  description: 'Redirect to the login page due to unauthorized access.'
                  value: '/login'
        '403':
          description: 'Forbidden. The user is not an administrator.'
          headers:
            Location:
              schema:
                type: string
              examples:
                loginRedirect:
                  description: 'Redirect to the home page due to unauthorized access.'
                  value: '/home'
        '404':
          description: 'Not Found. The user does not exist.'

    post:
      operationId: R502
      summary: 'R502: Admin edit user action'
      description: 'Processes and saves the changes made by admin. Access: ADM'
      tags:
        - 'M05: Administration'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                  username:
                    type: string
                  name:
                    type: string
                  email:
                    type: string
                    format: email
                  password:
                    type: string
                    format: password
                  confirm_password:
                    type: string
                    format: password
                  role:
                    type: string
                    enum: [USR, ADM]
                  bio:
                    type: string
              required:
                - username
                - name
                - email
                - password
                - confirm_password
                - role
                - bio

      responses:
        '302':
          description: 'Redirect once the new user information is processed.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'User edited successfully. Redirect to the user profile page.'
                  headers:
                    Location:
                      schema:
                        type: string
                      example: '/user/{id}'
                302Failure:
                  description: 'Failed. Redirect back.'

############################################ COMMENTS ##############################################

######### CREATE COMMENT #########

  /comment/create:

    post:
      operationId: R601
      summary: 'R601: Create comment action'
      description: 'Creates a comment. Access: USR, ADM'
      tags:
        - 'M06: Comments'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                content:
                  type: string
              required:
                - content

      responses:
        '302':
          description: 'Redirect once the new comment information is processed.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Comment created successfully. Redirect back.'
                302Failure:
                  description: 'Failed. Redirect back.'

######### DELETE COMMENT #########

  /comment/{id}/delete:

    post:
      operationId: R602
      summary: 'R602: Delete comment action'
      description: 'Deletes a comment. Access: OWN, ADM'
      tags:
        - 'M06: Comments'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '302':
          description: 'Redirect once the comment is deleted.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Comment deleted successfully. Redirect back.'
                302Failure:
                  description: 'Failed. Redirect back.'
```

---

## A8: Vertical prototype

The Vertical Prototype encompasses the development of features identified as essential in the general and theme-specific requirement documents. Utilizing this data, we have executed all the user stories marked with a high priority, as detailed in the following sections.<br>
The purpose of this artifact is to evaluate the feasibility of the proposed architecture and to familiarize ourselves with the technologies utilized in the project's development. The implementation is based on the code of the [Template Laravel repository](https://git.fe.up.pt/lbaw/template-laravel), which was provided by the course's instructors.<br>
The prototype includes the implementation of various features, such as:
- Viewing different pages (home, profile, admin, post, and search pages);
- Creating, editing, and deleting content (posts);
- Creating and deleting comments.

### 1. Implemented Features

#### 1.1. Implemented User Stories

The user stories that were implemented in the prototype are described in the following table.

| User Story reference | Name                    | Priority | Description                                                                                                                                             |
| -------------------- | ----------------------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------------- |
| US1                  | View Public Pages       | High     | As a user I want to be able to see public pages (About us, FAQ, Help, Contacts), so that I can be informed about the network.                           |
| US2                  | Account registration    | High     | As a visitor I want to be able to register an account whenever I want to do so.                                                                         |
| US3                  | Log in                  | High     | As a visitor I want to be able to log in in a fast, straightforward and secure way.                                                                     |
| US4                  | Sign-out                | High     | As an authenticated user I want to be able to sign-out at any time so I'm not logged in anymore.                                                        |
| US5                  | See Home Page           | High     | As an authenticated user, I want to be able to see the home page in order to navigate the site.                                                         |
| US6                  | View Personalized Feed  | High     | As an authenticated user I want to be able to see a personalized feed, where only posts that I have interest in are shown.                              |
| US7                  | Have Own Profile        | High     | As an authenticated user I want to have my own profile so that I can keep record of my interactions.                                                    |
| US8                  | View User Profiles      | High     | As an authenticated user I want to be able to see other users' profiles.                                                                                |
| US9                  | Create a Post           | High     | As an authenticated user, I want to be able to create posts , so that I am able to express my feelings and thoughts, thus interacting with the network. |
| US10                 | Send Follow Request     | High     | As an authenticated user, I want to be able to send a follow request, so that I show my intention to follow that user.                                                   |
| US11                 | Follow public profile   | High     | As an authenticated user I want to be able to follow someone with a public profile, so that their posts start appearing on my feed.                     |
| US12                 | Comment on posts        | High     | As an authenticated user I want to be able to comment on other peoples' posts, so that I can express my feelings regarding that post.                   |
| US13                 | Search for Users        | High     | As an authenticated user I want to be able to search for other users easily and efficiently, so that I can see what is relevant for me.                 |
| US50                 | Edit Post               | High     | As a post author I want to be able to edit my own post, so that I can correct it.                                                                       |
| US51                 | Delete Post             | High     | As a post author I want to be able to delete my own post, so that I can remove something I regret posting.                                              |
| US59                 | User account management | High     | As an administrator, I want to be able to manage user details, including password changing.                                                             |

Table 41: Vertical Prototype implemented user stories



#### 1.2. Implemented Web Resources

Module M01: Authentication

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form | GET [/login](https://lbaw23141.lbaw.fe.up.pt/login) |
| R102: Login Action | POST /login |
| R103: Logout Action | POST /logout |
| R104: Register Form | GET [/register](https://lbaw23141.lbaw.fe.up.pt/register) |
| R105: Register Action | POST /register |

Table 42: Authentication implementation

Module M02: Users

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: View home page | GET [/home](https://lbaw23141.lbaw.fe.up.pt/home) |
| R202: View for you home page | GET [/home/forYou](https://lbaw23141.lbaw.fe.up.pt/home/forYou) |
| R203: View user profile | GET [/user/{id}](https://lbaw23141.lbaw.fe.up.pt/user/4) |
| R204: Follow Action | POST /user/{id}/follow |
| R205: Unfollow Action | POST /user/{id}/unfollow |
| R206: View about page | GET [/about](https://lbaw23141.lbaw.fe.up.pt/about) |
| R207: View help page | GET [/help](https://lbaw23141.lbaw.fe.up.pt/help) |
| R208: View faq page | GET [/faq](https://lbaw23141.lbaw.fe.up.pt/faq) |
| R209: View contacts page | GET [/contacts](https://lbaw23141.lbaw.fe.up.pt/contacts) |

Table 43: Users implementation

Module M03: Posts

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R301: View create post page | GET [/post/create](https://lbaw23141.lbaw.fe.up.pt/post/create) |
| R302: Create post action | POST /post/create |
| R303: View post page | GET [/post/{id}](https://lbaw23141.lbaw.fe.up.pt/post/3) |
| R304: View edit post page | GET [/post/{id}/edit](https://lbaw23141.lbaw.fe.up.pt/post/3/edit) |
| R305: Edit post action | POST /post/{id}/edit |
| R306: Delete post action | POST /post/{id}/delete |

Table 44: Posts implementation

Module M04: Search

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R401: View search page | GET [/search](https://lbaw23141.lbaw.fe.up.pt/search) |
| R402: Search for user | GET [/api/user](https://lbaw23141.lbaw.fe.up.pt/api/user?query=admin1)|

Table 45: Search implementation

Module M05: Administration

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R501: View admin user edit page | GET [/admin/user/{id}/edit](https://lbaw23141.lbaw.fe.up.pt/admin/user/1/edit) |
| R502: Admin edit user action | POST /admin/user/{id}/edit |

Table 46: Administration implementation

Module M06: Comments

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R601: Create comment action | POST /comment/create |
| R602: Delete comment action | POST /comment/delete |

Table 47: Comments implementation



### 2. Prototype

The prototype can be accessed [here](https://lbaw23141.lbaw.fe.up.pt/).

Credentials for testing purposes:
- admin user: admin1@example.com | admin123
- normal user:  john.doe@example.com | password1

The code is available [here](https://git.fe.up.pt/lbaw/lbaw2324/lbaw23141/).

## Revision history

### Changes to database:
- Changed date column in both posts and comments tables to created_at with type timestamp;
- Added column updated_at with type timestamp to both posts and comments tables;

### Responsibilities and Contributions:

- Filipe Jacob De Jesus Ferreira
  - Contributed to the implementation of the following user stories:
    - US12: Comment on posts
    - US13: Search for Users

- Luís Miguel Lima Tavares
  - Contributed to the implementation of the following user stories:
    - US1: View Public Pages
    - US2: Account registration
    - US3: Log in
    - US4: Sign-out
    - US10: Send Follow Request
    - US11: Follow public profile
    - US13: Search for Users

- Miguel Martins Leitão
  - Contributed to the implementation of the following user stories:
    - US7: Have Own Profile
    - US8: View User Profiles
    - US10: Send Follow Request
    - US11: Follow public profile
    - US13: Search for Users
    - US59: User account management
  
- Rodrigo Campos Rodrigues
  - Contributed to the implementation of the following user stories:
    - US1: View Public Pages
    - US2: Account registration
    - US3: Log in
    - US4: Sign-out
    - US5: See Home Page
    - US6: View Personalized Feed
    - US9: Create a Post
    - US12: Comment on posts
    - US50: Edit Post
    - US51: Delete Post

---

GROUP141, 23/11/2023

- Group member 1 Filipe Jacob De Jesus Ferreira, up202102359@up.pt
- Group member 2 Luís Miguel Lima Tavares, up202108662@up.pt
- Group member 3 Miguel Martins Leitão, up202108851@up.pt
- Group member 4 Rodrigo Campos Rodrigues, up202108847@up.pt (editor)
