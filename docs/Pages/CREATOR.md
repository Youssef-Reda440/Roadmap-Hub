```
Creator Dashboard
│
├── Total Roadmaps
├── Published Roadmaps
├── Pending Roadmaps
├── Total Learners
├── Average Rating
│
└── Recent Activity
```

**Actions :**

Create Roadmap
Manage Roadmaps
View Statistics
View Reviews

---

```text
My Roadmaps
│
├── Draft
├── Pending Review
├── Published
└── Rejected
```

**for each roadmap card :**

Title
Category
Status
Rating
Learners

**Actions :**

View
Edit
Delete
Submit for Review

**Actions for each status :**

```text

Draft
├── Edit
├── Delete
└── Submit

Pending
└── View

Published
├── View
└── Edit

Rejected
├── Edit
└── Resubmit
```

---

```text
Create / Edit Roadmap
│
├── Basic Information
│
├── Stages
│   │
│   ├── Stage
│   │   ├── Topic
│   │   │   └── Resources
│   │   └── Topic
│   │
│   └── Stage
│
└── Actions
    ├── Save Draft
    └── Submit for Review
```

**Basic Information :**

Title
Description
Category
Difficulty
Estimated Duration

**Stage Management :**

Add Stage
Edit Stage
Delete Stage
Reorder Stage

**Topic Management :**

Add Topic
Edit Topic
Delete Topic
Reorder Topic

**Resource Management :**

Add Resource
Edit Resource
Delete Resource

**Resource : **

Title
URL
Type
Description

---

```text

Roadmap Preview
│
├── Roadmap Information
├── Creator Information
├── Stages
│   └── Topics
│       └── Resources
└── Preview Actions
```

**Actions :**

Back to Edit
Submit for Review

---

```text
Statistics
│
├── Total Learners
├── Total Saves
├── Average Rating
├── Total Reviews
└── Completion Rate
```

---

```text
Reviews
│
├── Average Rating
├── Rating Summary
└── Reviews
    ├── Learner
    ├── Rating
    ├── Comment
    └── Roadmap
```

---

```text
Creator Profile
│
├── Profile Picture
├── Name
├── Bio
├── Expertise
├── Specialization
├── Rating
└── Roadmaps
```

---

**Creator Navigation :**

```text
Creator Navbar
│
├── Explore
├── Dashboard
├── My Roadmaps
├── Create Roadmap
├── Statistics
├── Reviews
│
└── Profile
    └── Logout
```

---

**Final Creator Flow :**

```text
Creator Dashboard
       │
       ├──────────────→ Statistics
       │
       ├──────────────→ Reviews
       │
       ↓
  My Roadmaps
       │
       ├── Create
       │      ↓
       │   Roadmap Builder
       │      ↓
       │   Save Draft
       │      ↓
       │   Preview
       │      ↓
       │   Submit
       │
       └── Existing Roadmap
                ↓
              Edit
                ↓
          Submit Again
```

---

**Roadmap Builder :**

```text
Basic Info
    ↓
Stages
    ↓
Topics
    ↓
Resources
    ↓
Organize
    ↓
Preview
    ↓
Submit for Review
```
