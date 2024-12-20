
# 🗃️ Complete Explanation of the Database for the "Project Management" System

## 📄 Entities

### 1. **Client**
Represents the clients of the system who own projects and can leave testimonials.

| **Field**        | **Type**   | **Description**                            |
|------------------|------------|--------------------------------------------|
| `id`            | `int`      | Unique identifier for the client.          |
| `name`          | `string`   | Name of the client.                        |
| `email`         | `string`   | Email address of the client.               |
| `phone`         | `string`   | Phone number of the client.                |
| `created_at`    | `datetime` | Date when the client was created.          |

**Relationships:**
- **1:N with Project** → A client can have multiple projects.
- **1:N with Testimonial** → A client can leave multiple testimonials.

---

### 2. **Project**
Represents a project managed by a client and potentially by multiple users.

| **Field**        | **Type**   | **Description**                                |
|------------------|------------|------------------------------------------------|
| `id`            | `int`      | Unique identifier for the project.             |
| `name`          | `string`   | Name of the project.                           |
| `description`   | `text`     | Detailed description of the project.           |
| `start_date`    | `datetime` | Start date of the project.                     |
| `end_date`      | `datetime` | Expected end date of the project.              |

**Relationships:**
- **N:1 with Client** → A project belongs to a client.
- **1:N with Deliverable** → A project can have multiple deliverables.
- **1:N with Task** → A project can include multiple tasks.
- **N:M with User** → Multiple users can manage multiple projects (via `User_Project`).
- **N:M with Category** → A project can belong to multiple categories (via `Project_Category`).
- **1:N with Testimonial** → A project can receive multiple testimonials.

---

### 3. **Deliverable**
Represents the deliverables associated with a project.

| **Field**           | **Type**   | **Description**                                |
|---------------------|------------|------------------------------------------------|
| `id`               | `int`      | Unique identifier for the deliverable.         |
| `name`             | `string`   | Name of the deliverable.                       |
| `delivery_date`    | `datetime` | Expected delivery date of the deliverable.     |

**Relationships:**
- **N:1 with Project** → A deliverable belongs to a project.
- **1:N with Task** → A deliverable can be linked to multiple tasks.

---

### 4. **Testimonial**
Represents the feedback left by clients on projects.

| **Field**      | **Type**   | **Description**                            |
|----------------|------------|--------------------------------------------|
| `id`          | `int`      | Unique identifier for the testimonial.     |
| `content`     | `text`     | Content of the testimonial.                |
| `date`        | `datetime` | Date of the testimonial.                   |

**Relationships:**
- **N:1 with Client** → A testimonial is associated with a client.
- **N:1 with Project** → A testimonial concerns a specific project.

---

### 5. **User**
Represents the users who manage projects and perform tasks.

| **Field**      | **Type**   | **Description**                                |
|----------------|------------|------------------------------------------------|
| `id`          | `int`      | Unique identifier for the user.                |
| `name`        | `string`   | Name of the user.                              |
| `surname`     | `string`   | Surname of the user.                           |
| `email`       | `string`   | Email address of the user.                     |
| `password`    | `string`   | Password for the user account.                 |
| `role`        | `string`   | Role of the user (e.g., ADMIN, USER).          |

**Relationships:**
- **N:M with Project** → A user can manage multiple projects (via `User_Project`).
- **N:M with Task** → A user can be assigned to multiple tasks (via `User_Task`).

---

### 6. **Task**
Represents tasks associated with a project and assigned to users.

| **Field**           | **Type**   | **Description**                                |
|---------------------|------------|------------------------------------------------|
| `id`               | `int`      | Unique identifier for the task.                |
| `name`             | `string`   | Name of the task.                              |
| `description`      | `text`     | Detailed description of the task.              |
| `due_date`         | `datetime` | Due date of the task.                          |
| `status`           | `string`   | Status of the task (e.g., ongoing, completed). |

**Relationships:**
- **N:1 with Project** → A task belongs to a project.
- **N:M with User** → A task can be assigned to multiple users (via `User_Task`).
- **N:1 with Deliverable** → A task can be linked to a deliverable.

---

### 7. **Category**
Represents categories that projects can belong to.

| **Field**        | **Type**   | **Description**                            |
|------------------|------------|--------------------------------------------|
| `id`            | `int`      | Unique identifier for the category.        |
| `name`          | `string`   | Name of the category.                      |
| `description`   | `text`     | Description of the category.               |

**Relationships:**
- **N:M with Project** → A category can include multiple projects (via `Project_Category`).

---

## 🔗 Intermediate Tables for Many-to-Many Relationships

1. **`User_Project`**
    - **Fields** : `user_id`, `project_id`
    - **Description** : Links users and the projects they manage.

2. **`User_Task`**
    - **Fields** : `user_id`, `task_id`
    - **Description** : Links users to the tasks assigned to them.

3. **`Project_Category`**
    - **Fields** : `project_id`, `category_id`
    - **Description** : Links projects to the categories they belong to.

---

## 📊 Summary of Relationships

1. **One-to-Many (1:N)**
    - **Client** → **Project**
    - **Project** → **Deliverable**
    - **Project** → **Task**
    - **Client** → **Testimonial**
    - 

2. **Many-to-Many (N:M)**
    - **User** ↔ **Project** (via `User_Project`)
    - **User** ↔ **Task** (via `User_Task`)
    - **Project** ↔ **Category** (via `Project_Category`)

---

## ✅ Conclusion

This comprehensive schema effectively manages a project management application by modeling essential entities, their relationships, and complex interactions using intermediate tables for **Many-to-Many** relationships.
