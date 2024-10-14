# 🎓 Peer Review Platform

A web application built with Laravel that allows students to submit and share peer reviews for their courses and allows teachers to manage courses and students enrolled. This platform is designed to manage peer review assignments, display student feedback, and store review data securely.

## Features

- **User Authentication**: Secure login and registration for students and teachers.
- **Peer Review Submission**: Students can submit reviews and rate their peers. Reviewees can also rate their reviewers to encourage students to submit high-quality reviews and contributions to others.
- **Peer Review Groups**: Teachers can assign students into peer review groups randomly. Students can only review other students on the same group.
- **Review Display**: Students can view and filter their submitted and received reviews.
- **Course Management**: Manage courses, enrolled students, and peer review assignments.
- **Course Assessment**: Manage assessments, peer views and students' scores for each particular assessment.
- **Review Leaderboard**: Display top reviewers who contributue useful reviews to other students.

## Key Laravel Features Used

- **Controllers**: For handling the logic behind user interactions, such as review submission, course management, and group assignments.
- **Models**: Database interactions are managed through Laravel Eloquent models, including `User`, `PeerReview`, `Course`, `Assessment`, and `Feedback`.
- **ORM (Eloquent)**: Using Laravel’s ORM to easily define relationships like `hasMany` and `belongsTo` between models (e.g., a course has many reviews, a review belongs to a user), especially, it helps to handle many to many relationships such as a student might enroll in many courses and a course might have many students enrolling in.
- **Seeders**: Database seeders are used to populate the database with sample users (teachers and students), courses, and reviews for testing.
- **Migrations**: Manage database schema with migrations to define tables for `users`, `courses`, `assessments`, `reviews`, `enrolled_courses`, `score`, `feedback` and `assessment_group`.
- **Validator**: Implement server-side validation to ensure input data is accurate and secure.
- **View and Templating**: Use Blade templates for dynamic rendering of views, such as review forms and lists of courses.

## Usage

**Students**:
- Register and log in to the system
- View enrolling courses
- View assessments of a course
- Submit a peer review. If the assessment is student-selected, students can choose their reviewee from the drop-down menu and make a review; otherwise, it is a teacher-assigned assessment, teachers will form groups randomly and students only review their group members
- Rate their reviewer
- View made reviews and received reviews
- View top contributors (top reviewers)
  
**Teachers**:
- Log in to the system
- View teaching courses
- Create, edit and delete assessments of a course
- Enroll students to the course
- Assign students randomly into different groups if the assessment is teacher-assigned type
- Mark students based on their reviews
- View top contributors (top reviewers)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/NorahNguyen94/peer-review-website
    cd peer-review-webiste
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Run the development server:
    ```bash
    php artisan serve
    ```

## Credits

- Laravel Framework
- Bootstrap for styling
- Icons from Font Awesome

## Screenshots

![image](https://github.com/user-attachments/assets/99ad1201-4ba7-40ce-88a6-f90509ec869c)
![image](https://github.com/user-attachments/assets/5bfddfbe-f7db-4532-a493-e4a9397f1862)
![image](https://github.com/user-attachments/assets/95f841bb-0193-40b1-a2df-f17575ecb31e)
![image](https://github.com/user-attachments/assets/b9579492-0894-447f-a823-2d73a84cebba)
![image](https://github.com/user-attachments/assets/39544c78-6877-4b21-810d-c57968ecd0d7)
![image](https://github.com/user-attachments/assets/28990ff4-b389-4883-9937-9380872501d2)






