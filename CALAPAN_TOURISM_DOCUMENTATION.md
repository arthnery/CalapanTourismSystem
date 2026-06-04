# Calapan Tourism System: Mini-Capstone Documentation

## Chapter 1 – The Project Overview

### 1.1 Introduction
The **Calapan Tourism System** is a web-based application designed to digitalize and streamline the promotion and management of tourism destinations in Calapan City, Oriental Mindoro. In an era where digital presence is crucial for local economic growth, this system serves as a centralized platform for tourists to discover local attractions, view detailed information, and schedule visits. Built with the Laravel framework, the system provides a robust interface for both administrators to manage tourism assets and for users to interact with the city's tourism offerings.

### 1.2 Objective of the Project

#### 1.2.1 General Objective
The primary objective of this project is to develop a comprehensive tourism management system that facilitates the discovery and booking of tourism spots in Calapan City, enhancing the overall experience for visitors and the efficiency of administrative operations.

#### 1.2.2 Specific Objectives
1.  To design and implement a role-based authentication system for Administrators and regular Users.
2.  To create a management module for Administrators to add, update, archive (soft delete), and restore tourism spots and categories.
3.  To provide a user-friendly interface for visitors to search and filter tourism spots based on categories.
4.  To develop a booking management system that allows users to schedule visits and administrators to monitor tourism activity.
5.  To implement a review system that allows users to provide feedback on their visited locations.

### 1.3 Scope and Limitations of the Project

**Scope:**
*   **User Management:** Registration, login, and profile management for two roles: Admin and User.
*   **Tourism Spot Management:** Full CRUD operations for tourism spots, including location, pricing, and image uploads.
*   **Archiving System:** Implementation of Soft Deletes to allow administrators to archive and restore records without permanent data loss.
*   **Booking System:** A module for users to submit booking requests and view their booking history.
*   **Search and Filter:** Dynamic searching by spot name and filtering by tourism category (e.g., Beaches, Parks, Historical Sites).
*   **Responsive Design:** A mobile-friendly interface built with Tailwind CSS.

**Limitations:**
*   **Payment Processing:** The system does not currently support online payments or reservation fees.
*   **Real-time Communication:** There is no built-in chat system; communication is limited to status updates on bookings.
*   **Geographic Limit:** The system is exclusively focused on tourism spots within the jurisdiction of Calapan City.
*   **Offline Access:** The application requires an active internet connection to function as it is a web-based platform.

### 1.4 Significance of the Project
*   **For Tourists:** Provides a convenient, "one-stop-shop" platform to explore Calapan City's attractions with updated information and easy scheduling.
*   **For the Local Government/Administrators:** Offers a modern tool for tourism data management and promotion, helping to track popular destinations and manage visitor flow.
*   **For Local Businesses:** Increases visibility for local tourism spots, potentially boosting local economic activity.
*   **For Developers:** Demonstrates the application of modern web development patterns using Laravel, including Eloquent relationships, middleware, and soft deletion.

### 1.5 Definition of Terms
1.  **Laravel:** A modern PHP framework used for building web applications following the MVC pattern.
2.  **CRUD:** An acronym for Create, Read, Update, and Delete, representing the four basic functions of persistent storage.
3.  **Soft Deletes:** A database management feature where records are marked as "deleted" but remain in the database for possible restoration.
4.  **Middleware:** Code that acts as a bridge between a request and a response, often used for authentication and authorization.
5.  **Eloquent ORM:** Laravel's built-in Object-Relational Mapper that simplifies database interactions using PHP syntax.
6.  **MVC (Model-View-Controller):** An architectural pattern that separates an application into three main logical components.
7.  **Blade:** The powerful templating engine provided by Laravel for creating dynamic HTML views.
8.  **Migration:** A type of version control for the database schema, allowing for easy updates and sharing of the database structure.
9.  **Tailwind CSS:** A utility-first CSS framework used for rapid and consistent UI development.
10. **Authenticatable:** A trait in Laravel that allows a model (like User) to be used for the system's authentication process.

---

## 1.6 Appendices

### 1. Entity Relationship Diagram (ERD)
**Relationships:**
*   **User (1) ---- (N) Booking:** A user can make multiple bookings.
*   **TourismSpot (1) ---- (N) Booking:** A tourism spot can be booked multiple times.
*   **Category (1) ---- (N) TourismSpot:** A category (e.g., "Parks") contains many tourism spots.
*   **User (1) ---- (N) Review:** A user can write multiple reviews.
*   **TourismSpot (1) ---- (N) Review:** A tourism spot can have multiple reviews.

### 2. Wireframe (Description)
*   **Home Page:** Hero section with a search bar, followed by a grid of tourism spot cards displaying images, names, and prices. A sidebar/dropdown for category filtering.
*   **Admin Dashboard:** A statistical overview (Total Spots, Total Bookings) and a sidebar for managing Spots and Bookings.
*   **Spot Management (Admin):** A table listing all spots with "Edit", "Archive", and "Restore" buttons.
*   **Booking Page (User):** A form with a date picker to select a visit date for a specific tourism spot.

### 3. Site Map
*   **Public Access:**
    *   Home (Browse Spots)
    *   Tourism Spot Details
    *   Login / Register
*   **User Access (Authenticated):**
    *   User Dashboard
    *   My Bookings
    *   Profile Management
*   **Admin Access (Authenticated):**
    *   Admin Dashboard
    *   Manage Tourism Spots (CRUD + Restore)
    *   Manage Bookings (View All)
    *   Profile Management

### 4. Data Dictionary

#### Table: `users`
| Column | Type | Description |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| name | varchar | Full name of the user |
| username | varchar | Unique username for login |
| email | varchar | Unique email address |
| password | varchar | Hashed password |
| role | varchar | User role (admin or user) |
| deleted_at | timestamp | Used for Soft Deletes |

#### Table: `categories`
| Column | Type | Description |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| name | varchar | Category name (e.g., Beaches) |
| description | text | Description of the category |
| deleted_at | timestamp | Used for Soft Deletes |

#### Table: `tourism_spots`
| Column | Type | Description |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| name | varchar | Name of the tourism spot |
| description | text | Detailed description |
| location | varchar | Physical address/location |
| price | decimal | Entrance fee or estimated cost |
| image_path | varchar | Path to the uploaded image file |
| category_id | bigint | Foreign Key (categories.id) |
| deleted_at | timestamp | Used for Soft Deletes |

#### Table: `bookings`
| Column | Type | Description |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| user_id | bigint | Foreign Key (users.id) |
| tourism_spot_id | bigint | Foreign Key (tourism_spots.id) |
| booking_date | date | Date of the scheduled visit |
| status | varchar | Status (pending, cancelled, etc.) |
| deleted_at | timestamp | Used for Soft Deletes |

### 5. System Features
*   **Role-Based Access Control (RBAC):** Restricts access to administrative pages based on user roles.
*   **Soft Deletion (Archiving):** Allows for safe removal of data that can be recovered by an administrator.
*   **Dynamic Image Uploads:** Supports uploading and managing images for tourism spots.
*   **Advanced Filtering:** Allows users to narrow down destinations by specific categories.
*   **Booking Status Management:** Tracks the lifecycle of a user's visit request.

### 6. Use Case
*   **Actor: Administrator**
    *   Manage Tourism Spots (Add/Edit/Archive/Restore).
    *   View all system bookings.
    *   Manage categories.
*   **Actor: Registered User**
    *   Search and filter tourism spots.
    *   Book a visit to a tourism spot.
    *   View and cancel their own bookings.
    *   Manage their personal profile.
*   **Actor: Guest/Visitor**
    *   Browse tourism spots.
    *   View tourism spot details.
    *   Register for an account.
