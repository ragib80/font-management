# Project Installation and Setup Instructions

## Step 1: Ensure Required PHP Version is Installed

1. **PHP:**

   - Ensure PHP 8.1.0 or higher is installed on your system.
   - If PHP is not installed or your version is lower than 8.1.0, please install or upgrade to PHP 8.1.0 or higher.

2. **Composer:**
   - Ensure Composer is installed on your system.

## Step 2: Clone or Download the Project

1. Clone the repository or download the project files and place them in your web server's root directory.
   - For example, in WAMP or XAMPP, it would be the `www` or `htdocs` folder, respectively.

## Step 3: Install Project Dependencies

1. Navigate to the project root directory.
2. Run the following command to install the necessary PHP dependencies using Composer:
   ```bash
   composer install
   ```
   N.B: There is no file or folder in .gitignore so you can skip this step 3.

## Step 4: Create the Database

1. Create a MySQL database and import the `font-management.sql` file.
2. Note your MySQL database credentials: host, username, password, and database name.

## Step 5: Set Up the Database Configuration

1. Open the `core/Database.php` file in a text editor.
2. Set your MySQL credentials in the following variables:
   ```php
   $host = 'localhost';    // Your MySQL host
   $username = 'root';     // Your MySQL username
   $password = '';         // Your MySQL password (default is null)
   $database = 'font-management';     // Your database name
   ```
   Replace the values with your own MySQL database credentials.

## Step 6: Test the Project

1. Start your web server (e.g., WAMP, XAMPP).
2. Open a web browser and navigate to the following URLs:

   - [http://localhost/dashboard](http://localhost/dashboard) - To view the Dashboard page.
   - [http://localhost/fonts/upload](http://localhost/fonts/upload) - To upload Font.
   - [http://localhost/fonts/list](http://localhost/fonts/list) - To view the Fonts list page.
   - [http://localhost/font-groups/create](http://localhost/font-groups/create) - To view the create Font Group page.
   - [http://localhost/font-groups/list](http://localhost/font-groups/list) - To view the Font Group list page.

3. For live testing, browse [http://font-group.rf.gd/](http://font-group.rf.gd/).

---

**Note:** Ensure all the steps are followed correctly to avoid any installation issues.
