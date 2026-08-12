# techzorinfo

#	Problem	Difficulty	What it tests
-	Distributed Job Queue	🔥🔥🔥🔥🔥	Concurrency, queues, retries, workers
-	Rate Limiter Service	🔥🔥🔥🔥	Algorithms, Redis, concurrency
-	URL Shortener at Scale	🔥🔥🔥	API design, DB, caching, scalability
-	Ticket Booking System	🔥🔥🔥🔥🔥	Transactions, concurrency, race conditions
-	Wallet / Payment Service	🔥🔥🔥🔥🔥	Transactions, idempotency, consistency
-	Notification Service	🔥🔥🔥🔥	Async processing, retries, architecture
-	Inventory Management System	🔥🔥🔥🔥	Concurrency, transactions, consistency
-	File Upload & Processing Service	🔥🔥🔥🔥	Async jobs, storage, APIs
-	Order Management System	🔥🔥🔥🔥	State machines, transactions, APIs
-	Real-Time Leaderboard	🔥🔥🔥🔥	Redis, ranking, performance

Node.js Backend Codethon — Question Summary
Build a REST API backend using Node.js + Express.js for a Smart Complaint, Service Request & Claim Ticketing System.
Database is not required. Use in-memory arrays/objects.
Core Requirements
Ticket Management
Create, view, update, search and filter tickets.
Generate a unique ticket number and initial status.
Validation
Validate ticket type, category and sub-category combinations.
Validate required fields and attachments.
Priority Calculation
Detect keywords such as urgent, fraud, legal, money debited, duplicate payment.
Calculate a numeric score.
Assign Low / Medium / High / Critical priority.
SLA Management
Working hours: Monday–Saturday, 9 AM–6 PM.
Skip Sundays.
Calculate SLA deadline and detect SLA breaches.
Escalation
1 day after breach → Team Lead
3 days → Manager
5 days → Senior Management
Assignment & Reassignment
Assign department/user based on ticket type/category.
Support reassignment.
Reassignment must require a reason.
Status Workflow
NEW → ASSIGNED → IN_PROGRESS
                  ↓
          PENDING_CUSTOMER
                  ↓
               RESOLVED
                  ↓
                CLOSED
Reject invalid status transitions.
Duplicate Detection
Detect duplicate tickets based on customer/ticket details.
Link duplicate tickets to the original ticket.
Reopen
Allow reopening within 3 calendar days after closure.
After 3 days, require a new linked ticket.
Comments & Notes
Customer/agent comments.
Internal notes visible only to authorized employees.
Audit Trail
Record creation, assignment, reassignment, status changes, escalation, resolution, closure and reopening.
Store old value, new value, user, timestamp and remarks.
Notifications
Maintain in-memory notification/event records for ticket and SLA events.
Actual SMS/email sending is not required.
Dashboard Provide API statistics for:
Total tickets
Open tickets
Closed tickets
Critical tickets
SLA-breached tickets
Counts by status, priority, department and ticket type.
Role-Based Access Support:
Customer
Agent
Team Lead
Manager
Admin
Attachment Validation
Maximum 5 files
PDF/JPG/PNG only
Maximum 2 MB per file
Technical Requirements
Node.js
Express.js
REST APIs
JavaScript
In-memory data only
Middleware
Validation
Error handling
Role-based authorization
Clean project structure
Main objective: Demonstrate backend business logic, not just CRUD. The evaluator should be able to test the complete flow:
Create Ticket → Validate → Calculate Priority → Assign → Calculate SLA → Manage Status → Escalate → Resolve → Close → Audit.
