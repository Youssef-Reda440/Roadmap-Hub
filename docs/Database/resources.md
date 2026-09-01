| Column      | Type      | Constraints  | Description                                                  |
| ----------- | --------- | ------------ | ------------------------------------------------------------ |
| id          | BIGINT    | PK           | Resource identifier                                          |
| topic_id    | BIGINT    | FK, NOT NULL | Related Topic                                                |
| title       | VARCHAR   | NOT NULL     | Resource title                                               |
| url         | TEXT      | NOT NULL     | Resource URL                                                 |
| type        | ENUM      | NOT NULL     | youtube / documentation / article / course / website / other |
| description | TEXT      |              | Resource description                                         |
| created_at  | TIMESTAMP |              | Creation time                                                |
| updated_at  | TIMESTAMP |              | Last update time                                             |

### Purpose

Stores learning resources associated with Topics.

### Relationships

Topic → Resources
topics 1 ─── N resources

Foreign Key:
resources.topic_id → topics.id

### Notes

- Each Resource belongs to exactly one Topic.
- A Topic can contain multiple Resources.
- `type` identifies the kind of learning resource.
- `url` stores the external resource link.
