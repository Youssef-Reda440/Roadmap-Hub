| Column          | Type      | Constraints  | Description                   |
| --------------- | --------- | ------------ | ----------------------------- |
| id              | BIGINT    | PK           | Report identifier             |
| user_id         | BIGINT    | FK, NOT NULL | User who submitted the Report |
| reportable_type | VARCHAR   | NOT NULL     | Type of reported content      |
| reportable_id   | BIGINT    | NOT NULL     | ID of the reported content    |
| reason          | TEXT      | NOT NULL     | Reason for the Report         |
| status          | ENUM      | NOT NULL     | pending / resolved            |
| created_at      | TIMESTAMP |              | Report creation time          |
| updated_at      | TIMESTAMP |              | Last update time              |

### Purpose

Stores Reports submitted by Users against content or Creators.

### Relationships

User → Reports
users 1 ─── N reports

Reported Content → Report
Polymorphic Relationship

reports.reportable_type
reports.reportable_id

### Notes

- Each Report belongs to exactly one User.
- A User can submit multiple Reports.
- A Report can target different types of content.
- Supported reportable types:
  - Roadmap
  - Resource
  - Review
  - Creator
- `status` tracks whether the Report is still pending or has been resolved.
- The Admin is responsible for reviewing and resolving Reports.
