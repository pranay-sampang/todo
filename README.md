
# Welcome to Laravel Todo Application 👋
![Todo App Screenshot](/public/assets/images/screenshots/hero.png)

## Getting Started

To run this project locally, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/pranay-sampang/todo.git
   ```

2. Navigate to the project directory:

   ```bash
   cd todo-app-laravel
   ```

3. Install dependencies:

   ```bash
   composer install
   npm install
   ```

4. Copy the `.env.example` file and create a new `.env` file:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the database connection in the `.env` file:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

7. Run database migrations:

   ```bash
   php artisan migrate
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

9. Open your browser and visit `http://localhost:8000` to explore the application.

## Tech Stack

- **Laravel:** A PHP web application framework for building efficient and secure web applications.
- **jQuery:** jQuery is a powerful tool for simplifying common JavaScript tasks, making it easier to create dynamic, interactive web applications.
- **Bootstrap:** A utility-first CSS framework for building custom designs quickly and easily.

## Features

- [x] Create Todo: Users can add new todo and add tasks.
- [x] Edit Todo: Users can edit the created todo.
- [x] Mark Todo Task: Users can mark the todo task as complete by just checking the checkbox.
- [x] Delete Todo: Users can delete the created todo.
- [x] Search Todo: Users can search their todo by typing the todo title in the search field.
- [x] User Registration: Users can register to the application to start creating the todo application.
- [x] User Login: Users can login to the application to access their todo lists.
  
## Author

👤 **Pranay Sampang**

* LinkedIn: [@pranay-sampang](https://www.linkedin.com/in/pranay-sampang-283449208)
* Instagram: [@pranay_sampang](https://www.instagram.com/pranay_sampang)
