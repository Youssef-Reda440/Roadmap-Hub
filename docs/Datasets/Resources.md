```sql
INSERT INTO resources
(roadmap_id, title, url, type, description, created_at, updated_at)
VALUES
(
    1,
    'MDN HTML Guide',
    'https://developer.mozilla.org/en-US/docs/Web/HTML',
    'documentation',
    'مرجع أساسي لتعلم HTML.',
    NOW(),
    NOW()
),
(
    1,
    'JavaScript Tutorial',
    'https://javascript.info/',
    'link',
    'دليل شامل لتعلم JavaScript.',
    NOW(),
    NOW()
),
(
    1,
    'React Documentation',
    'https://react.dev/',
    'documentation',
    'التوثيق الرسمي لـ React.',
    NOW(),
    NOW()
),
(
    2,
    'Laravel Documentation',
    'https://laravel.com/docs',
    'documentation',
    'التوثيق الرسمي لـ Laravel.',
    NOW(),
    NOW()
),
(
    2,
    'PHP Manual',
    'https://www.php.net/docs.php',
    'documentation',
    'التوثيق الرسمي للغة PHP.',
    NOW(),
    NOW()
),
(
    3,
    'Python Documentation',
    'https://docs.python.org/3/',
    'documentation',
    'التوثيق الرسمي للغة Python.',
    NOW(),
    NOW()
),
(
    4,
    'OWASP Web Security Testing Guide',
    'https://owasp.org/www-project-web-security-testing-guide/',
    'documentation',
    'مرجع عملي لاختبار أمان تطبيقات الويب.',
    NOW(),
    NOW()
),
-- Frontend Development
(
    5,
    'HTML & CSS Fundamentals',
    'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Structuring_content',
    'documentation',
    'Learn the fundamentals of HTML and CSS for building modern web pages.',
    NOW(),
    NOW()
),
(
    5,
    'JavaScript Basics',
    'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting',
    'documentation',
    'Learn JavaScript fundamentals and browser scripting.',
    NOW(),
    NOW()
),
(
    5,
    'Responsive Web Design',
    'https://web.dev/learn/design/',
    'documentation',
    'Learn the principles of responsive and adaptive web design.',
    NOW(),
    NOW()
),

-- JavaScript Mastery
(
    6,
    'JavaScript Guide',
    'https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide',
    'documentation',
    'A comprehensive guide to the JavaScript language.',
    NOW(),
    NOW()
),
(
    6,
    'JavaScript.info',
    'https://javascript.info/',
    'article',
    'A detailed modern JavaScript tutorial.',
    NOW(),
    NOW()
),

-- Machine Learning
(
    7,
    'Machine Learning Crash Course',
    'https://developers.google.com/machine-learning/crash-course',
    'documentation',
    'A practical introduction to machine learning concepts.',
    NOW(),
    NOW()
),
(
    7,
    'Scikit-learn User Guide',
    'https://scikit-learn.org/stable/user_guide.html',
    'documentation',
    'Learn practical machine learning with Scikit-learn.',
    NOW(),
    NOW()
),

-- Mobile
(
    8,
    'Flutter Documentation',
    'https://docs.flutter.dev/',
    'documentation',
    'Official Flutter documentation for building cross-platform applications.',
    NOW(),
    NOW()
),
(
    8,
    'Flutter YouTube Tutorials',
    'https://www.youtube.com/results?search_query=flutter+tutorial',
    'video',
    'Video tutorials covering Flutter and mobile development.',
    NOW(),
    NOW()
),

-- DevOps
(
    9,
    'Docker Get Started',
    'https://docs.docker.com/get-started/',
    'documentation',
    'Learn the fundamentals of Docker containers.',
    NOW(),
    NOW()
),
(
    9,
    'GitHub Actions',
    'https://docs.github.com/en/actions',
    'documentation',
    'Learn how to automate workflows with GitHub Actions.',
    NOW(),
    NOW()
),

-- Web Security
(
    10,
    'OWASP Top 10',
    'https://owasp.org/www-project-top-ten/',
    'documentation',
    'Learn the most critical web application security risks.',
    NOW(),
    NOW()
),
(
    10,
    'PortSwigger Web Security Academy',
    'https://portswigger.net/web-security',
    'link',
    'Free practical labs for learning web application security.',
    NOW(),
    NOW()
);
```
