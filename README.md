# CSC3132 Appointment App

## Overview

The CSC3132 Appointment App is a web-based meeting scheduling application designed for university use. This application allows users to schedule and manage meetings efficiently within the university context.

## consider
**Note:**
I completed this project under the supervision of my instructor. I am now uploading a copy of it to this repository.

## Technologies Used

- HTML
- CSS
- Bootstrap 5
- JavaScript
- PHP
- MySQL
- Ajax

## Prerequisites

- Web server with PHP support
- MySQL database

## Installation

### Database Setup

1. Create a database named "tempdb".
2. Import the "tempdb_init.sql" file located inside the "templates" folder to create necessary tables.

## User Roles

- **User:** University students who can schedule and manage their own appointments.
- **Admin:** University staff with administrative privileges to manage appointments, users, and system settings.
- **Superadmin (Appmanager):** Highest level of access, overseeing the entire application, and managing user roles.

## Features

- **User Authentication:** Secure login and registration system for users, admins, and superadmins.
- **Meeting Scheduling:** Easily schedule and manage meetings based on user roles.
- **Role-Based Access Control (RBAC):** Different levels of access for users, admins, and superadmins.
- **Superadmin Functions:**
  - Create new Admin accounts.
  - Manage system settings.
  - Oversight of the entire application.
- **Admin Functions:**
  - View and manage appointments.
  - Take actions on appointments (approve, reject, reschedule, etc.).
  - Showcase available meeting times.
  - View and edit their profiles.
  - Change passwords.
- **User Functions:**
  - Schedule appointments with available admins.
  - View and edit their profiles.
  - Change passwords.

## Testing Superadmin Credentials

For testing purposes, you can use the following superadmin credentials:

- **Email:** admin@gmail.com
- **Password:** 123456789

Please note that these credentials are intended for testing only and should not be used in a production environment. In a real-world scenario, users should register with their own unique credentials.

To log in as a superadmin, use the provided email and password during the authentication process.

**Important:** After testing, change the password or remove the testing account to ensure security.

## Testing Admin Credentials

For testing purposes, you can use the following admin credentials:

1. **Email:** dean@fas.lk
   - **Password:** 123456789

2. **Email:** dean@fbs.lk
   - **Password:** 123456789

3. **Email:** dean@fts.lk
   - **Password:** 123456789

Please note that these credentials are intended for testing only and should not be used in a production environment. In a real-world scenario, users should register with their own unique credentials.

To log in as an admin, use the provided email and password during the authentication process.

**Important:** After testing, change the passwords or remove the testing accounts to ensure security.
## Creating a New User Account (For Testing)

1. Open the login page of the application.

2. Look for a "Sign Up" or "Create Account" button and click on it.

3. Fill in the necessary information for the new user account, such as:
   - **Email:** [new-user-email@example.com]
   - **Password:** [desired-password]
   - (Include any other required information)

4. Submit the form to create the new user account.

5. After successfully creating the new user account, use the provided email and password during the login process.

**Note:** This functionality is intended for testing purposes. In a real-world scenario, users would typically sign up with their own unique credentials.


## Creating a New Admin Account Using Superadmin Portal (For Testing)

1. Log in to the superadmin portal with the provided superadmin credentials:

   - **Email:** admin@gmail.com
   - **Password:** 123456789

2. Once logged in, navigate to the admin management section or a similar area where new admin accounts can be created.

3. Click on the "Admin signup" nav bar or a similar button to initiate the process.

4. Fill in the necessary information for the new admin account, such as:
   - **Email:** [new-admin-email@example.com]
   - **Password:** [desired-password]
   - (Include any other required information)

5. Submit the form to create the new admin account.

6. After successfully creating the new admin account, users can log in with the provided email and password during the authentication process.

**Note:** This functionality is intended for testing purposes. In a real-world scenario, admin accounts would typically be created through a more secure and controlled process.

## Differentiating User and Admin Login Pages

In this application, the login process varies for users and admins. A checkbox is used to specify the login type. Here's how you can differentiate between user and admin logins:

1. Open the login page of the application.

2. Look for a checkbox or a similar UI element that allows you to choose between user and admin login.

3. If the checkbox is labeled "Admin Login" or something similar, check it to indicate that you want to log in as an admin.

4. If the checkbox is not present or labeled differently, leave it unchecked for a regular user login.

5. Enter the appropriate email and password for the chosen login type.

6. Click the "Login" button to proceed.

**Note:** The checkbox functionality is implemented to distinguish between user and admin logins. Make sure to follow the provided instructions on the login page for a smooth authentication process.

## License



## Contributing



## Contact

For any inquiries, please contact [Diranujan](mailto:diranujan2000@gmail.com).
