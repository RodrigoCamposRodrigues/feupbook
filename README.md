# Feupbook

At the heart of our project vision for Feupbook is the unwavering commitment to creating an innovative and vibrant social network tailored specifically for the students of the Faculty of Engineering at the University of Porto (FEUP). We envision Feupbook as a dynamic and inclusive online ecosystem, revolutionizing the way FEUP students connect, share, and engage within their academic community.

## Project Components

- [ER: Requirements Specification](./Wiki/er.md)
- [EBD: Database Specification](./Wiki/ebd.md)
- [EAP: Architecture Specification and Prototype](./Wiki/eap.md)
- [PA: Product and Presentation](./Wiki/pa.md)

## Installing the software dependencies

To prepare you computer for development you need to install PHP >=v8.1 and Composer >=v2.2.

We recommend using an __Ubuntu__ distribution that ships with these versions (e.g Ubuntu 22.04 or newer). You may install the required software with:

```bash
sudo apt update
sudo apt install git composer php8.1 php8.1-mbstring php8.1-xml php8.1-pgsql php8.1-curl
```

On MacOS, you can install them using [Homebrew](https://brew.sh/) and:
```bash
brew install php@8.1 composer
```

If you use [Windows WSL](https://learn.microsoft.com/en-us/windows/wsl/install), please ensure you are also using Ubuntu 22.04 inside. Previous versions do not provide the requirements needed for this template, and then follow the Ubuntu instructions above.

## Setting up the database

We've created a _docker compose_ file that sets up __PostgreSQL__ and __pgAdmin4__ to run as local Docker containers.

From the project root issue the following command:

```bash
docker compose up -d
```

This will start your containers in detached mode. To stop them use:

```bash
docker compose down
```

### Run

To start the development server from the project's root run:

```bash
# Seed database from the SQL file.
# Needed on first run and every time the database script changes.
php artisan db:seed

# Start the development server
php artisan serve
```

Access `http://localhost:8000` to access the app.

To stop the server just hit Ctrl-C.

## Usage

#### Administration Credentials

| Email | Password |
| -------- | -------- |
| gcostell0@simplemachines.org | admin123 |

#### User Credentials

| Type          | Username  | Password |
| ------------- | --------- | -------- |
| basic account | alice.smith@example.com | password2 |

## Docker command

Full Docker command to launch the image available in the group's GitLab Container Registry using the production database:
```
docker run -it -p 8000:80 --name=lbaw23141 -e DB_DATABASE="lbaw23141" -e DB_SCHEMA="lbaw23141" -e DB_USERNAME="lbaw23141" -e DB_PASSWORD="kJrVHWaX" git.fe.up.pt:5050/lbaw/lbaw2324/lbaw23141
```

## URL

URL to the product: http://lbaw23141.lbaw.fe.up.pt (not available anymore)

## Team

- Group member 1 Felipe Jacob De Jesus Ferreira, up202102359@up.pt
- Group member 2 Luís Miguel Lima Tavares, up202108662@up.pt
- Group member 3 Miguel Martins Leitão, up202108851@up.pt
- Group member 4 Rodrigo Campos Rodrigues, up202108847@up.pt

---
