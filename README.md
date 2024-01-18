# Feupbook

At the heart of our project vision for Feupbook is the unwavering commitment to creating an innovative and vibrant social network tailored specifically for the students of the Faculty of Engineering at the University of Porto (FEUP). We envision Feupbook as a dynamic and inclusive online ecosystem, revolutionizing the way FEUP students connect, share, and engage within their academic community.

## Project Components

- [ER: Requirements Specification](./Wiki/er.md)
- [EBD: Database Specification](./Wiki/ebd.md)
- [EAP: Architecture Specification and Prototype](./Wiki/eap.md)
- [PA: Product and Presentation](./Wiki/pa.md)

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
