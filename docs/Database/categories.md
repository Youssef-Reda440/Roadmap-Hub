| Column      | Type      | Constraints      | Description          |
| ----------- | --------- | ---------------- | -------------------- |
| id          | BIGINT    | PK               | Category identifier  |
| name        | VARCHAR   | UNIQUE, NOT NULL | Category name        |
| description | TEXT      |                  | Category description |
| created_at  | TIMESTAMP |                  | Creation time        |
| updated_at  | TIMESTAMP |                  | Last update time     |

### Purpose

Stores the different fields available on the platform.

### Examples

- Frontend Development
- Backend Development
- AI
- UI/UX Design
- Graphic Design
- Marketing
- Mobile Development
