| Column      | Type      | Constraints  | Description                     |
| ----------- | --------- | ------------ | ------------------------------- |
| id          | BIGINT    | PK           | Topic identifier                |
| stage_id    | BIGINT    | FK, NOT NULL | Related Stage                   |
| title       | VARCHAR   | NOT NULL     | Topic title                     |
| description | TEXT      |              | Topic description               |
| order       | INT       | NOT NULL     | Topic position within the Stage |
| created_at  | TIMESTAMP |              | Creation time                   |
| updated_at  | TIMESTAMP |              | Last update time                |

### Purpose

Stores the learning topics that belong to a Stage.

### Relationships

Stage → Topics
stages 1 ─── N topics

Foreign Key:
topics.stage_id → stages.id

### Notes

- Each Topic belongs to exactly one Stage.
- A Stage can contain multiple Topics.
- `order` determines the position of the Topic inside the Stage.
- Each Topic can have multiple Learning Resources.
- Topic completion for Learners will be tracked separately.
