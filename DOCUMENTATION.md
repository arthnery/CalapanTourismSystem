# Project Documentation: Calapan City Tourism Information and Booking Management System

## Title Page
- **Project Title:** Calapan City Tourism Information and Booking Management System
- **Course Title / Subject:** Laravel-Based Information System Development Project
- **Student Name:** [Your Name]
- **Year and Section:** [Your Year/Section]
- **Instructor Name:** [Instructor Name]
- **Month Completed:** May 2026

---

## Chapter 1 – The Project Overview

### 1.1 Introduction
The Calapan City Tourism Information and Booking Management System is a web-based platform designed to promote and manage tourism in Calapan City. It provides users with information about various tourism spots, categories, and allows for future booking capabilities.

### 1.2 Objective of the Project
#### 1.2.1 General Objective
To develop a functional web-based information system that centralizes tourism information for Calapan City and provides a management interface for administrators.

#### 1.2.2 Specific Objectives
- Provide a searchable and filterable catalog of tourism spots.
- Implement a secure authentication system for users and administrators.
- Enable full CRUD (Create, Read, Update, Delete) operations for tourism spot management.
- Provide a responsive and visually appealing user interface using Tailwind CSS.

### 1.3 Scope and Limitations of the Project
**Scope:**
- User registration and authentication.
- Searching and filtering of tourism spots by name or category.
- Detailed views for each tourism spot.
- Admin dashboard for managing tourism spots and categories.
- RESTful API for external data consumption.

**Limitations:**
- Actual payment processing is not implemented.
- Real-time chat support is not included.

### 1.4 Significance of the Project
This project serves as a practical application of Laravel MVC, database design, and frontend development. It helps local tourism offices digitize their information management.

### 1.5 Definition of Terms (Minimum of 10)
1. **Laravel:** A PHP web framework used for developing the system.
2. **MVC (Model-View-Controller):** Architectural pattern used to separate logic, data, and presentation.
3. **Blade:** Laravel's powerful templating engine.
4. **Eloquent ORM:** Laravel's database toolkit for interacting with data.
5. **Migration:** Version control for the database schema.
6. **Seeder:** Tool to populate the database with sample data.
7. **Middleware:** A mechanism for filtering HTTP requests entering the application.
8. **CRUD:** Stands for Create, Read, Update, and Delete.
9. **Tailwind CSS:** A utility-first CSS framework for styling.
10. **Vite:** A build tool that provides a fast development environment.

---

## Appendices
1. **Entity Relationship Diagram (ERD):**
   - Users (1) -> (*) Bookings
   - Users (1) -> (*) Reviews
   - Categories (1) -> (*) TourismSpots
   - TourismSpots (1) -> (*) Bookings
   - TourismSpots (1) -> (*) Reviews
2. **System Features:**
   - Responsive Homepage with Hero section.
   - Search and Category Filtering.
   - Admin CRUD for Spots.
   - Authentication via Laravel Breeze.
   - REST API Endpoint (`/api/tourism-spots`).
