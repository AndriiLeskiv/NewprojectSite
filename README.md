# README

## Overview
This is a web application built using **PHP**, **HTML**, **CSS**, and **MySQL**. The platform provides a content management system that allows users to interact with posts, comments, and categories. It features both a user-facing interface and an administrative section for managing site content and users.

---

## Features

### User Features:
1. **View Posts**
   - Users can view posts displayed on the main page.
2. **Add Comments**
   - Users can leave comments on posts.
   - Comments can be edited or deleted.
3. **Register Users**
   - Visitors can create an account to interact with the platform.

### Admin Features:
1. **Manage Posts**
   - Add, edit, and delete posts.
2. **Manage Comments**
   - Moderate comments, including approving or removing inappropriate ones.
3. **Manage Categories**
   - Create, edit, and delete categories for organizing posts.
4. **Manage Users**
   - View registered users.
   - Assign admin roles or manage user privileges.

---

## Technologies Used
1. **Frontend:**
   - HTML for structure.
   - CSS for styling.
2. **Backend:**
   - PHP for server-side logic.
3. **Database:**
   - MySQL for data storage.

---

## Database Structure
### Main Tables:
1. **Users**:
   - Stores user information including roles (admin or regular user).
2. **Posts**:
   - Contains all blog posts with fields for title, content, and category.
3. **Comments**:
   - Stores user comments linked to specific posts.
4. **Categories**:
   - Organizes posts into categories.

---

## Installation
1. Clone this repository:
   ```bash
   https://github.com/AndriiLeskiv/NewprojectSite.git
   ```
2. Set up a local server (e.g., XAMPP or WAMP).
3. Import the provided SQL file into your MySQL database to create the necessary tables.
4. Update the database connection settings in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'testing_web_site');
   ```
5. Start the server and navigate to the project directory in your browser.

---

## Usage
1. Register as a user or log in as an admin to access additional features.
2. Create and manage posts via the admin panel.
3. Interact with posts as a user (e.g., adding comments).
4. Use the category system to organize posts for better navigation.

---

## Future Enhancements
- Adding a search feature to locate posts and comments.
- Implementing user profiles with the ability to upload avatars.
- Enhancing security features (e.g., captcha, email verification).
- Adding pagination for posts and comments.

---

## License
This project is licensed under the MIT License.

