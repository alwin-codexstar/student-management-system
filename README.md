# Student Management System

A web-based Student Management System built using **PHP, HTML, CSS, MySQL/SQL, and Python** to manage student records, attendance, academic marks, and performance reports.

## 🚀 Features

- **Dashboard** – View and manage student information.
- **Student Management (CRUD)** – Add, edit, search, and delete student records.
- **Attendance Management** – Maintain student attendance details.
- **Academic Marks Management** – Manage student marks and calculate percentages.
- **Student Performance Analytics** – Generate student performance reports using Python.
- **Responsive Interface** – Access the application through a user-friendly interface.

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS
- **Backend:** PHP, Python
- **Database:** MySQL / SQL
- **Local Server:** XAMPP
- **Analytics:** Python

## ⚙️ Installation and Setup

### Prerequisites

- XAMPP
- Python
- pip
- Web browser

### Step 1: Clone the Repository

```bash
git clone https://github.com/alwin-codexstar/student-management-system.git
```

### Step 2: Configure XAMPP

1. Copy the `php` folder into:

   `C:\xampp\htdocs\student_management`

2. Open XAMPP Control Panel.
3. Start **Apache** and **MySQL**.

### Step 3: Set Up the Database

1. Open phpMyAdmin at `http://localhost/phpmyadmin/`.
2. Import the SQL file:

   `database/student_management.sql`

### Step 4: Run the Application

Open your browser and visit:

`http://localhost/student_management/`

### Step 5: Run the Python Performance Report

Install the required Python dependencies:

```bash
pip install -r python/requirements.txt
```

Run the analytics script:

```bash
python python/analytics.py
```

**Note:** Update the MySQL credentials in `python/analytics.py` if your local database configuration requires it.

## 🎯 Project Objective

The main objective of this project is to simplify student record management, organize attendance and academic marks, calculate student percentages, and generate performance reports using Python.

## 🔮 Future Enhancements

- Admin authentication and role-based access.
- Student profile management enhancements.
- Attendance and academic performance charts.
- PDF and Excel report exports.
- Improved database security and validation.

## 👨‍💻 Developer

**Alwin Codexstar**

GitHub: [@alwin-codexstar](https://github.com/alwin-codexstar)

## 📄 License

Add a suitable open-source license to your repository if you intend to allow others to reuse or distribute the project.

---

⭐ If you find this project useful, consider giving the repository a star!
