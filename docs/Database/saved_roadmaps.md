| Column     | Type      | Constraints  | Description                   |
| ---------- | --------- | ------------ | ----------------------------- |
| id         | BIGINT    | PK           | Saved roadmap identifier      |
| user_id    | BIGINT    | FK, NOT NULL | Learner who saved the Roadmap |
| roadmap_id | BIGINT    | FK, NOT NULL | Saved Roadmap                 |
| created_at | TIMESTAMP |              | Save time                     |
| updated_at | TIMESTAMP |              | Last update time              |

### Purpose

Stores the Roadmaps that Learners have saved for later.

### Relationships

User → Saved Roadmaps
users 1 ─── N saved_roadmaps

Roadmap → Saved Records
roadmaps 1 ─── N saved_roadmaps

Foreign Keys:
saved_roadmaps.user_id → users.id
saved_roadmaps.roadmap_id → roadmaps.id

### Notes

- Each saved record belongs to exactly one Learner.
- Each saved record belongs to exactly one Roadmap.
- A Learner can save multiple Roadmaps.
- A Roadmap can be saved by multiple Learners.
- Saving a Roadmap is independent from starting/following it.

### Constraint

Unique:
(user_id, roadmap_id)
