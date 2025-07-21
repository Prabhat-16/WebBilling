# WebBilling

WebBilling is a web-based billing and accounting management system designed for businesses to manage sales, purchases, inventory, parties (customers/suppliers), cash memos, income, expenses, and financial reporting. The system features a secure admin panel, user management, and comprehensive reporting tools.

## Features

- **Dashboard**: Overview of products, suppliers, customers, sales, revenue, and recent orders.
- **Party Management**: Add, edit, and manage customers and suppliers.
- **Item/Product Management**: Manage inventory items, including categories, sizes, GSM, GST slabs, and product images.
- **Sales Invoices**: Create, edit, and manage sales invoices; generate PDF invoices; view sales reports.
- **Purchase Invoices**: Create, edit, and manage purchase invoices; generate PDF invoices; view purchase reports.
- **Cash Memo**: Issue and manage cash memos, including PDF generation and reporting.
- **Income & Expense Management**: Record, categorize, and report on income and expenses, including file uploads for proofs.
- **Financial Year Management**: Define and manage financial years for accurate accounting.
- **Party Ledger**: Track party-wise transactions and balances.
- **Company Profile**: Manage company details, logo, and signature.
- **User Management**: Manage users, profiles, and change passwords.
- **Reports**: Generate and filter reports for sales, purchases, cash memos, income, and expenses.
- **Authentication**: Secure login system for admin panel access.

## Technology Stack

- **Backend**: PHP (MySQLi)
- **Frontend**: HTML5, CSS3, Bootstrap 4, JavaScript, jQuery
- **Database**: MySQL
- **PDF Generation**: FPDF library

## Directory Structure

- `admin/` - Main admin panel source code
  - `css/` - Stylesheets
  - `js/` - JavaScript files
  - `img/` - Images and logos
  - `fpdf/` - FPDF library for PDF generation
  - `vendor/` - Third-party JS/CSS libraries
- `images/` - Uploaded images (company, items, users, etc.)
- `DBScript/` - Database SQL scripts
- `connection.php` - Database connection configuration

## Setup Instructions

1. **Clone the repository** to your web server directory (e.g., `www` for WAMP/XAMPP).
2. **Database Setup**:
   - Import the SQL file from `DBScript/` (e.g., `kraftpaperonline_01_03_2024.sql`) into your MySQL server.
   - Update `connection.php` with your MySQL credentials and database name if needed.
3. **File Permissions**:
   - Ensure the `images/` directory and its subfolders are writable for file uploads.
4. **Access the Application**:
   - Open your browser and navigate to `http://localhost/WebBilling/admin/`.
   - Login with your admin credentials.

## Usage

- Use the admin panel to manage all aspects of billing, inventory, parties, and reporting.
- Generate and download PDF invoices and reports as needed.
- Update company profile and user settings from the respective sections.

## Dependencies

- PHP 7.x or higher
- MySQL 5.7 or higher
- Web server (Apache recommended)
- [FPDF](http://www.fpdf.org/) (included in `admin/fpdf/`)
- Bootstrap 4, jQuery (included in `admin/vendor/`)
