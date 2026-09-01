| Column          | Type      | Constraints          | Description                |
| --------------- | --------- | -------------------- | -------------------------- |
| id              | BIGINT    | PK                   | Creator profile identifier |
| user_id         | BIGINT    | FK, UNIQUE, NOT NULL | Related user               |
| bio             | TEXT      |                      | Creator bio                |
| expertise       | VARCHAR   |                      | Main area of expertise     |
| specialization  | VARCHAR   |                      | Creator specialization     |
| profile_picture | VARCHAR   |                      | Profile picture path       |
| created_at      | TIMESTAMP |                      | Creation time              |
| updated_at      | TIMESTAMP |                      | Last update time           |

### Purpose

Stores additional information specific to users who are approved as Creators.

### Relationship

users 1 ─── 0..1 creator_profiles
