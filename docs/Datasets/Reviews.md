```sql
INSERT INTO reviews
(user_id, roadmap_id, rating, comment, created_at, updated_at)
VALUES
(
    4,
    1,
    5,
    'مسار ممتاز ومنظم جدًا ومناسب كبداية.',
    NOW(),
    NOW()
),
(
    5,
    1,
    4,
    'المحتوى جيد والمصادر مفيدة جدًا.',
    NOW(),
    NOW()
),
(
    4,
    2,
    5,
    'شرح ممتاز خصوصًا في Laravel وBackend.',
    NOW(),
    NOW()
);
```

