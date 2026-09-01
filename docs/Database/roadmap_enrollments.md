| Column     | Type      | Constraints  | Description                     |
| ---------- | --------- | ------------ | ------------------------------- |
| id         | BIGINT    | PK           | Enrollment identifier           |
| user_id    | BIGINT    | FK, NOT NULL | Learner who started the Roadmap |
| roadmap_id | BIGINT    | FK, NOT NULL | Roadmap being followed          |
| created_at | TIMESTAMP |              | Enrollment time                 |
| updated_at | TIMESTAMP |              | Last update time                |

### Purpose

Stores the Roadmaps that Learners have started and are currently following.

### Relationships

User → Roadmap Enrollments
users 1 ─── N roadmap_enrollments

Roadmap → Enrollments
roadmaps 1 ─── N roadmap_enrollments

Foreign Keys:
roadmap_enrollments.user_id → users.id
roadmap_enrollments.roadmap_id → roadmaps.id

### Notes

- Each Enrollment belongs to exactly one Learner.
- Each Enrollment belongs to exactly one Roadmap.
- A Learner can follow multiple Roadmaps.
- A Roadmap can be followed by multiple Learners.
- `roadmap_enrollments` represents the Many-to-Many relationship between Users and Roadmaps.
- We should prevent the same Learner from enrolling in the same Roadmap more than once.
