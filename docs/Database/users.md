| Column     | Type      | Constraints      | Description               |
| ---------- | --------- | ---------------- | ------------------------- |
| id         | BIGINT    | PK               | User identifier           |
| name       | VARCHAR   | NOT NULL         | User name                 |
| email      | VARCHAR   | UNIQUE, NOT NULL | User email                |
| password   | VARCHAR   | NOT NULL         | Hashed password           |
| role       | ENUM      | NOT NULL         | learner / creator / admin |
| created_at | TIMESTAMP |                  | Creation time             |
| updated_at | TIMESTAMP |                  | Last update time          |

### Purpose

Stores the main information for all application users.

### Roles

- learner
- creator
- admin
