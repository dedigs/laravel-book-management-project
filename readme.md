# Book Management System

This project is a simple web application for managing a list of books, built with Laravel. It allows you to add, delete, and edit books, as well as export data in CSV and XML formats.

## 🚀 Quick Start

1. Install [Docker Desktop](https://docs.docker.com/install).
2. Ensure Docker is running.

## 🛠 Project Setup

This project uses `Make` commands for easier setup. All commands can be found in the `Makefile` in the root folder.

1. **Clone the repository:**
   ```sh
   git clone git@github.com:dedigs/laravel-book-management-project.git
   cd laravel-book-management-project
   ```
2. **Set up the **`.env`** file:** Copy `.env.example` to `.env` and configure the environment variables.
3. **Set up the **`docker-compose.override.yml`** file:** Copy `docker-compose.override.yml.example` to `docker-compose.override.yml`. This file will add a persistent database to the project after starting the container. It will also add a testing database by running the `init.sql` script.
4. **Start the containers:**
   ```sh
   make up
   ```
5. **Install Composer dependencies:**
   ```sh
   make install
   ```
6. **Run migrations and seed the database:**
   ```sh
   make migrate
   make seed
   ```
7. **Access the application in your browser:** Open [http://localhost](http://localhost).

## 🧪 Running Tests

To run the tests, use the following command:

```sh
make test
```

Tests use a separate database (`laravel_testing`), which is created after running `make up` to avoid affecting real data.

## 🛠️ Technologies

- **Laravel 6** — PHP framework for web applications.
- **Docker** — Containerization for the application.
- **MySQL** — Database.
- **PHPUnit** — Testing.

## 📂 Project Structure

- **app/** — Core application logic.
- **database/** — Migrations and seeders.
- **tests/** — Tests.
- **routes/** — Routes.
- **resources/** — Blade templates and assets.

## 📝 Features

- **Add a book** — Form to add a new book.
- **Delete a book** — Remove a book from the list.
- **Edit an author** — Change the author's name.
- **Sorting** — Sort books by title or author.
- **Search** — Search for books by title or author.
- **Export data:**
  - List of books (title and author) in CSV and XML.
  - List of titles only in CSV and XML.
  - List of authors only in CSV and XML.

## 🚨 Error Handling

### Common Issues and Solutions

1. **"Permission denied" error:** If you encounter a "Permission denied" error when accessing the application, run the following command to fix storage permissions:

   ```sh
   docker-compose exec laravel chown -R www-data storage
   ```

2. **Database connection issues:** If the application cannot connect to the database:

   - Ensure the MySQL container is running:
     ```sh
     docker-compose ps
     ```
   - Check the logs for errors:
     ```sh
     docker-compose logs mysql
     ```

3. **Composer dependency issues:** If Composer fails to install dependencies:

   - Clear the Composer cache:
     ```sh
     docker-compose exec laravel composer clear-cache
     ```
   - Reinstall dependencies:
     ```sh
     make install
     ```

4. **Cached configuration or stale cache issues:** If the application behaves unexpectedly (e.g., changes in `.env` or configuration files are not reflected, or views/routes are not updating), clear the configuration and cache using:

   ```sh
   make clear
   ```

   This command runs the following:

   - **Clear configuration cache:** Removes cached configuration files (`config.php`).
   - **Clear application cache:** Removes cached data like views, routes, and other cached items.

   **When to use this command:**

   - After modifying `.env`.
   - When changes to views or routes are not reflected.
   - When the application behaves inconsistently due to stale cache data.

## 🙏 Acknowledgments

  **Laravel** — For the excellent framework.

  **Docker** — For the convenience of containerization.

## 📧 Contact
  If you have any questions or suggestions, feel free to reach out:

  📧 dedigsdan@gmail.com

  🌐 https://github.com/dedigs
