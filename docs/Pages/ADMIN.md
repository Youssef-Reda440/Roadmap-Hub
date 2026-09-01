```text
Admin Dashboard
│
├── Total Users
├── Total Creators
├── Total Roadmaps
├── Pending Roadmaps
├── Pending Creator Applications
├── Reports
│
└── Recent Activity
```

**Actions :**

Manage Users
Review Creator Applications
Review Roadmaps
Manage Categories
View Reports

---

```text
Users Managemnt
│
├── Search
├── Filter
│
└── Users Table
      │
      └── Select User
             ↓
         User Details
             ↓
      Manage Account
```

**User Details :**

Name
Email
Role
Status
Joined Date
Activity

**Actions :**

Activate
Deactivate
Change Role

---

```text
Creator Applications
│
├── Pending Applications
├── Approved
└── Rejected
```

**Application Details :**

Applicant
Bio
Expertise
Specialization
Application Status

**Actions :**

Approve
Reject

**Flow :**

```text
Application
     ↓
Review
     ↓
Approve / Reject
```

---

```text
Roadmap Reviews
│
├── Pending Roadmaps
├── Roadmap Information
├── Creator Information
├── Stages
│   └── Topics
│       └── Resources
│
└── Review Action
```

**Actions :**

Approve
Reject
Request Changes

**Flow :**

```text
Pending
   ↓
Review
   ├── Approve → Published
   ├── Reject → Creator
   └── Request Changes → Creator
```

---

```text
Categories
│
├── Category List
│
└── Add / Edit Category
```

**Actions :**

Create
Edit
Delete

---

```text
Reports
│
├── Pending Reports
├── Resolved Reports
│
└── Report Details
    ├── Reporter
    ├── Reported Content
    ├── Reason
    └── Status
```

**Actions :**

Review
No Action
Remove Content
Suspend User
Resolve

---

```text
Admin Profile
│
├── Name
├── Email
├── Profile Picture
└── Password
```

**Actions :**

Edit Profile
Change Password
Logout

---

**Admin Navigation :**

```text
Admin
│
├── Dashboard
├── Users
├── Creator Applications
├── Roadmap Reviews
├── Categories
├── Reports
│
└── Profile
```

---

**Admin Flow :**

```text
                   Admin Dashboard
                          │
         ┌────────────────┼────────────────┐
         ↓                ↓                ↓
       Users           Creators         Roadmaps
         │                │                │
      Manage          Applications      Review
         │                │                │
         ↓                ↓                ↓
      Account        Approve/Reject   Approve/Reject
                                            │
                                            ↓
                                         Publish

                          │
                          ↓
                       Reports
                          │
                          ↓
                      Take Action
```
