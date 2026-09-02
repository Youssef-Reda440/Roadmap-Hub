| Column      | Type      | Constraints  | Description                       |
| ----------- | --------- | ------------ | --------------------------------- |
| id          | BIGINT    | PK           | Stage identifier                  |
| roadmap_id  | BIGINT    | FK, NOT NULL | Related Roadmap                   |
| title       | VARCHAR   | NOT NULL     | Stage title                       |
| description | TEXT      |              | Stage description                 |
| position    | INT       | NOT NULL     | Stage position within the Roadmap |
| created_at  | TIMESTAMP |              | Creation time                     |
| updated_at  | TIMESTAMP |              | Last update time                  |

### Purpose

Stores the learning stages that belong to a Roadmap.

### Relationships

Roadmap → Stages
roadmaps 1 ─── N stages

Foreign Key:
stages.roadmap_id → roadmaps.id

### Notes

- Each Stage belongs to exactly one Roadmap.
- A Roadmap can contain multiple Stages.
- `order` determines the position of the Stage inside the Roadmap.
- Stages will contain Topics.
