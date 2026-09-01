| Column      | Type      | Constraints  | Description                            |
| ----------- | --------- | ------------ | -------------------------------------- |
| id          | BIGINT    | PK           | Roadmap identifier                     |
| creator_id  | BIGINT    | FK, NOT NULL | Creator who owns the Roadmap           |
| category_id | BIGINT    | FK, NOT NULL | Roadmap category                       |
| title       | VARCHAR   | NOT NULL     | Roadmap title                          |
| description | TEXT      | NOT NULL     | Roadmap description                    |
| level       | ENUM      | NOT NULL     | beginner / intermediate / advanced     |
| duration    | VARCHAR   |              | Estimated learning duration            |
| status      | ENUM      | NOT NULL     | draft / pending / published / rejected |
| created_at  | TIMESTAMP |              | Creation time                          |
| updated_at  | TIMESTAMP |              | Last update time                       |

### Purpose

Stores the main information and status of all Roadmaps created by Creators.

### Relationships

creator:
users 1 ─── N roadmaps

category:
categories 1 ─── N roadmaps
