| Column     | Type      | Constraints  | Description                       |
| ---------- | --------- | ------------ | --------------------------------- |
| id         | BIGINT    | PK           | Application identifier            |
| user_id    | BIGINT    | FK, NOT NULL | User applying to become a Creator |
| status     | ENUM      | NOT NULL     | pending / approved / rejected     |
| created_at | TIMESTAMP |              | Application creation time         |
| updated_at | TIMESTAMP |              | Last update time                  |

### Purpose

Stores applications submitted by Learners who want to become Creators.

### Relationship

users 1 ─── N creator_applications
