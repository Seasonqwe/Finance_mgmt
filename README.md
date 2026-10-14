
# Finance Management System (FMS)

A web-based personal finance management application developed as a 6th-semester project for the Bachelor of Computer Application (BCA) program. This system helps users efficiently track daily transactions, monitor expenses, manage budgets, and visualize savings goals through an intuitive dashboard.


🚀 Features
* **User Authentication & Profile Management:** Secure registration and login system with session management.
* **Transaction Tracking:** Record, categorize, and manage income and expenses with detailed descriptions and timestamps.
* **Budget Management:** Set monthly or category-wise budgets to keep spending in check.
* **Savings Goal Tracker:** Define savings targets and track progress over time.
* **Visual Reports & Analytics:** Interactive graphical summaries of cash flow, spending patterns, and category-wise breakdowns.
* **Responsive UI:** Clean, modern interface optimized for seamless use across different devices.

---

🛠️ Tech Stack
* Frontend: HTML5, CSS3, JavaScript
* Backend: PHP
* Database:MySQL (managed via phpMyAdmin)
* Local Server: Docker

---

 📂 Project Structure


finance-management-system/
│
├── assets/             # CSS, JavaScript, and image files
├── database/           # SQL dump files and database schema
├── includes/           # Reusable components (header, footer, database connection)
├── pages/              # Core application modules (dashboard, transactions, budgets)
├── index.php           # Landing / Login page
└── README.md           # Project documentation

//test.php
use this file to test your database connection, xampp, docker anything can be used to build a connection but docker is highly recommended as it is more reliable and havent failed me yet 

⚙️ Installation & Setup

Follow these steps to run the project locally on your machine:

1. Clone the repository:
```bash
git clone https://github.com/your-username/finance-management-system.git

```


2. Move to XAMPP Directory:
Place the cloned project folder inside your XAMPP root directory (`htdocs/`).
3. **Start Local Server:**
Open **XAMPP Control Panel** and start **Apache** and **MySQL**.
4. **Import Database:**
* Open your browser and go to `http://localhost/phpmyadmin/`.
* Create a new database named `finance_db` (or the name specified in your config).
* Import the `.sql` file located in the `database/` folder of the repository.


5. **Run the Application:**
Open your browser and navigate to:
```text
http://localhost/finance-management-system/

```



---

📌 Future Enhancements

* Integration of eSewa / digital wallet payment gateways for automated expense logging.
* PDF/Excel export options for financial reports.
* Advanced predictive budgeting alerts.

---

📄 License

This project is developed for academic purposes as part of the BCA curriculum at Tribhuvan University.
