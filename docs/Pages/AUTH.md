```text
Login
│
├── Email
├── Password
├── Remember Me
├── Login Button
│
├── Forgot Password
│
└── Don't have an account?
        ↓
      Register
```

**Actions :**

```text
Login
  ↓
Redirect based on User Role

Learner → Learner Dashboard
Creator → Creator Dashboard
Admin   → Admin Dashboard
```

---

```text
Register
│
├── Name
├── Email
├── Password
├── Confirm Password
│
└── Register Button
```

---

```text
Forgot Password
│
├── Email
└── Send Reset Link
```

**Flow :**

```text
Email
 ↓
Reset Link
 ↓
Reset Password
```

---

```text
Reset Password
│
├── New Password
├── Confirm Password
└── Reset Password

```

---

**OverAll Flow :**

```text
                Authentication
                      │
             ┌────────┴────────┐
             ↓                 ↓
           Login            Register
             │                 │
             │                 ↓
             │              Learner
             │
             ↓
       Identify Role
             │
       ┌─────┼─────┐
       ↓     ↓     ↓
    Learner Creator Admin
       │     │     │
       ↓     ↓     ↓
   Dashboard Dashboard Dashboard


* Password Recovery flow :

Forgot Password
       ↓
Enter Email
       ↓
Reset Link
       ↓
Reset Password
       ↓
Login
```
