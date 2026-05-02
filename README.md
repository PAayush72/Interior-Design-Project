# Interior Design Management System

A web-based Interior Design Management System built with PHP and MySQL. This application allows clients to view design portfolios (Interior Design, Architecture, Installation Art), book appointments with experts, manage payments, and more.

## Features

* **User Authentication**: Registration, Login, Forgot Password functionality.
* **Portfolio Showcase**: View featured interior designs, architectures, and installation art.
* **Appointment Booking**: Book appointments with experts, track availability.
* **Admin Dashboard**: Manage slots, bookings, payments, and users.
* **Payment Integration**: Handle invoices and payments.
* **Chatbot Integration**: Basic chatbot for quick support.
* **PDF Generation**: Generate invoices using TCPDF.

## Technologies Used

* **Frontend**: HTML5, CSS3, JavaScript (Owl Carousel)
* **Backend**: PHP
* **Database**: MySQL
* **Libraries**: TCPDF, PHPMailer (SMTP)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/PAayush72/Interior-Design-Project.git
   ```
2. Move the project to your local web server's root directory (e.g., `htdocs` for XAMPP or `www` for WAMP).
3. Import the database (look for a `.sql` file in the project or set up tables based on the code).
4. Update the database configuration in `config.php` or `connect.php`.
5. Run the project in your browser:
   ```
   http://localhost/Interior-Design-Project
   ```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
