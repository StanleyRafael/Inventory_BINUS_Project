# Inventory Monitoring System (BINUS University)

A web-based inventory monitoring system developed during an internship at **BINUS University**.  
This application was designed to help the **Building Management team** monitor and store inventory-related data used in daily operational activities.

The system has been **implemented on-site** in BINUS University's fire monitoring room and supports **role-based access control** to ensure proper data management and security.

---

## Features

- Inventory management (add, edit, delete inventory records)
- Role-based authentication and authorization
  - Different access levels based on user roles
  - Restricted access to sensitive operations
- Centralized inventory data storage
- Simple local deployment without complex networking requirements

---

## Tech Stack

- **Backend:** Python (Flask)
- **Frontend:** HTML, JavaScript, Vue.js
- **Database:** MySQL
- **Authentication:** Role-based access control
- **Other Tools:** XAMPP, Flask-Migrate

---

## Project Background

This project was developed as part of an **internal internship program at BINUS University**.  
The application was deployed in the **fire monitoring room**, where the Building Management team required a simple, reliable system to record and monitor inventory data.

Due to the controlled environment, the system was designed as a **local web application** without the need for complex networking or external integrations.

The primary goal was to improve data organization, reduce manual record-keeping, and ensure secure access through role-based authentication.

---

## Installation & Setup

### Prerequisites

- Git
- Python (make sure to check **"Add Python to PATH"** during installation)
- XAMPP or another MySQL database server

### Steps

1. Clone the repository:
   ```bash
   git clone <repository-url>
2. Update database credentials in app.py.

3. Run the batch file to set up the virtual environment and install dependencies.

4. Run database migrations:

    flask db upgrade


5. Start the application.

## Usage
- Access the application via a web browser after starting the server.
- Log in using an account with the appropriate role.
- Manage and monitor inventory data according to access permissions.

## Limitations and Future Improvements
- Currently designed for local deployment only
- Limited reporting and analytics features
- Potential improvements:
    - Enhanced reporting and export functionality
    - Improved UI/UX
    - Integration with other internal systems

##Author
Developed by Stanley Rafael during an internship at BINUS University.
