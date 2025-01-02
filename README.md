# Wordpress Preloved Car Listing Project

A WordPress-based platform for listing and managing preloved car listings.

## Quick Start

1. Build and run containers:
```bash
docker-compose up -d
```

2. Access the site:
- URL: `localhost:8080`
- Admin credentials:
  ```
  Username: admin
  Password: admin123
  ```

3. PHPMyAdmin:
- URL: `localhost:8081`

## Requirements

- Docker
- Docker Compose

## Database Import

If no data is present, import the SQL dump:
```
./db_dump/wordpress.sql
```
You may import this using [PHPMyAdmin](http://localhost:8081)

## Requirements

- Docker
- Docker Compose

## License

MIT License
