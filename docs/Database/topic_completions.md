| Column       | Type      | Constraints  | Description                     |
| ------------ | --------- | ------------ | ------------------------------- |
| id           | BIGINT    | PK           | Completion record identifier    |
| user_id      | BIGINT    | FK, NOT NULL | Learner who completed the Topic |
| topic_id     | BIGINT    | FK, NOT NULL | Completed Topic                 |
| completed_at | TIMESTAMP | NOT NULL     | Completion time                 |

### Purpose

Stores the completion status of Topics for Learners.

### Relationships

User → Topic Completions
users 1 ─── N topic_completions

Topic → Topic Completions
topics 1 ─── N topic_completions

Foreign Keys:
topic_completions.user_id → users.id
topic_completions.topic_id → topics.id

### Notes

- Each Completion belongs to exactly one Learner.
- Each Completion belongs to exactly one Topic.
- A Learner can complete many Topics.
- A Topic can be completed by many Learners.
- Progress is calculated automatically from completed Topics.
- The same Learner should not have multiple completion records for the same Topic.

### Constraint

Unique:
(user_id, topic_id)
