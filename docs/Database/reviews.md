| Column     | Type      | Constraints  | Description                  |
| ---------- | --------- | ------------ | ---------------------------- |
| id         | BIGINT    | PK           | Review identifier            |
| user_id    | BIGINT    | FK, NOT NULL | Learner who wrote the review |
| roadmap_id | BIGINT    | FK, NOT NULL | Reviewed Roadmap             |
| rating     | TINYINT   | NOT NULL     | Rating value from 1 to 5     |
| comment    | TEXT      | NOT NULL     | Review content               |
| created_at | TIMESTAMP |              | Review creation time         |
| updated_at | TIMESTAMP |              | Last update time             |

### Purpose

Stores Learner ratings and reviews for Roadmaps.

### Relationships

User → Reviews
users 1 ─── N reviews

Roadmap → Reviews
roadmaps 1 ─── N reviews

Foreign Keys:
reviews.user_id → users.id
reviews.roadmap_id → roadmaps.id

### Notes

- Each Review belongs to exactly one Learner.
- Each Review belongs to exactly one Roadmap.
- A Learner must have started the Roadmap before submitting a Review.
- A Learner can submit multiple Reviews for the same Roadmap.
- `rating` should be between 1 and 5.
