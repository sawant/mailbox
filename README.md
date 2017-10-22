Mailbox API Test
=======

This is a simple Mailbox API that imports, lists, filters, archives and reads mailbox messages.

Developed in [Symfony](http://symfony.com/), running on [Docker](http://www.docker.com/) containers, using
[MySQL](https://www.mysql.com) as database.

### Introduction:
A local firm is building a small E-mail client to manage their internal messaging.
You have been asked to implement a basic mailbox API in which the provided messages are listed. Each message can be marked as read and you can archive single messages.

## Setup

- Clone this repository to your local system:

    git clone git@github.com:sawant/mailbox.git mailbox

- Go into the directory:

    cd mailbox

- Use Docker Compose to orchestrate the application:

    docker-compose up -d --build

- Install/update PHP/Symfony packages:

    docker exec -it mailbox_php_1 composer update
    
- Copy `messages_sample.json`, file that was provided in the email, to the root of the project:

    cp <PATH_TO_DIRECTORY>/messages_sample.json ./

- The API is running here (the homepage has not been changed from Symfony's default):

    http://localhost:8080
    
## Tasks

### Prerequisites

**For API demos, it's recommended to use a GUI tool like Postman or Insomnia.**

Since this is only a demo MVP for a programming test, thus the API is using HTTP Basic Auth for now. This should be
replaced by proper user management and authentication service before using this seriously. The following user is
configured for access:

    Username: appuser
    Password: wV[Ho6HEz6AFboY

In [Insomnia](https://insomnia.rest/), set `Auth` to `Basic` and provide the username/password given above.

**Saving/providing passwords in repository is not the right way. However, this has to be done in this test case,
as it's unavoidable in this task; it's required for demo and testing.** 
    
### Demos

- **Task 1**: Import messages from a JSON file (make sure `messages_sample.json` has been copied to the root
or provide with path). Using terminal, in project root, enter:

    docker exec -it mailbox_php_1 php bin/console app:import:messages messages_sample.json

**Only run the subsequent tasks after successfully finishing Task 1.**

- **Task 2 - List messages**: Retrieve a paginateable list of all messages. Show if messages were read already:

    GET http://localhost:8080/api/mailbox/
    
It is set to display 10 messages at a time.

***Assumption:** List only those messages that have not been archived.*

For pagination, use:

    GET http://localhost:8080/api/mailbox/?page=2

- **Task 3 - List archived messages**: Retrieve a paginateable list of all archived messages.
Show if messages were read already:

    GET http://localhost:8080/api/mailbox/?filter=archived
    
Displays archived messages, if any.

- **Task 4 - Show message**: Retrieve message by id, include read status and if message is archived:

    GET http://localhost:8080/api/mailbox/1
    
Displays message with `id = 1`.

- **Task 5 - Read message**: This action "reads" a message and marks it as read in database:

    PATCH http://localhost:8080/api/mailbox/2/read
    
Marks message with `id = 2` as read and returns the updated message.

- **Task 6 - Archive message**: This action sets a message to archived:

    PATCH http://localhost:8080/api/mailbox/3/archive
    
Marks message with `id = 3` as archived and returns the updated message.
    
## Tests

To run the tests:

    docker exec -it mailbox_php_1 vendor/bin/phpunit
