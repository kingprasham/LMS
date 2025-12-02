# Complete LMS Roadmap & Development Guide
## Based on Udemy-Style Workflow with SAS-AI Branding

---

## Table of Contents
1. [Executive Summary](#executive-summary)
2. [User Roles & Complete Feature Matrix](#user-roles--complete-feature-matrix)
3. [Public Homepage Features](#public-homepage-features)
4. [Complete Page Structure](#complete-page-structure)
5. [Database Schema Extensions](#database-schema-extensions)
6. [Development Phases](#development-phases)
7. [V0 Prompts Collection](#v0-prompts-collection)

---

## Executive Summary

This LMS platform follows Udemy's proven workflow while implementing SAS-AI's professional branding. The system supports 4 user roles with distinct capabilities:

- **Public Users**: Browse courses, view previews, purchase access
- **Students**: Full course access after payment, progress tracking, certificates
- **Trainers/Instructors**: Create courses, manage content, grade assignments, analytics
- **Super Admin**: Platform management, user oversight, content approval, system analytics

**Key Innovation**: Preview-then-Purchase Model
- Public users can watch FIRST video of any course for free
- After purchase, unlock ALL videos in that course series
- Maintains engagement while protecting premium content

---

## User Roles & Complete Feature Matrix

### 1. PUBLIC USER (Non-Authenticated)
**Access**: Homepage, Course Catalog, Course Preview Pages

| Feature | Description | Priority |
|---------|-------------|----------|
| **Homepage** | Hero section, featured courses, categories, testimonials | MVP |
| **Course Catalog** | Browse all courses with filters (category, price, rating) | MVP |
| **Search Functionality** | Search courses by title, instructor, topic | MVP |
| **Course Detail Page** | Full course information, curriculum overview, instructor bio | MVP |
| **Preview Video** | Watch FIRST video of any course (no login required) | MVP |
| **User Registration** | Sign up as Student or Instructor | MVP |
| **Login System** | Secure authentication | MVP |
| **Pricing Display** | View course prices, discounts, bundles | MVP |
| **Testimonials/Reviews** | Read student reviews and ratings | MVP |
| **FAQ Section** | Common questions about platform | Phase 2 |
| **Blog/Resources** | Educational content, platform updates | Phase 2 |

---

### 2. STUDENT (Enrolled Learner)
**Access**: All student features after authentication

#### Dashboard & Navigation
| Feature | Description | Priority |
|---------|-------------|----------|
| **Student Dashboard** | Overview of enrolled courses, progress, upcoming deadlines | MVP |
| **My Courses** | Grid/list view of all purchased courses with progress bars | MVP |
| **Course Recommendations** | Suggested courses based on interests/completed courses | Phase 2 |
| **Learning Path Tracker** | Visual progress through course curriculum | MVP |
| **Notifications Center** | Alerts for new content, grades, announcements | MVP |
| **Wishlist** | Save courses for later purchase | Phase 2 |

#### Course Learning Experience
| Feature | Description | Priority |
|---------|-------------|----------|
| **Video Player** | Custom player with speed control, quality settings, fullscreen | MVP |
| **Course Curriculum Sidebar** | Collapsible lesson list with completion checkmarks | MVP |
| **Video Progress Tracking** | Auto-save video position, mark as complete | MVP |
| **Reading Materials** | Text-based lessons with rich formatting | MVP |
| **Downloadable Resources** | PDFs, code files, supplementary materials | MVP |
| **Code Sandbox** | Interactive coding environment (for programming courses) | Phase 2 |
| **Notes Feature** | Take timestamped notes during video playback | Phase 2 |
| **Bookmarks** | Save specific video timestamps | Phase 2 |
| **Keyboard Shortcuts** | Quick navigation (space=play/pause, arrow keys, etc.) | MVP |

#### Assessments & Practice
| Feature | Description | Priority |
|---------|-------------|----------|
| **Quizzes** | Multiple choice, true/false, short answer | MVP |
| **Quiz Timer** | Timed assessments with countdown | MVP |
| **Instant Quiz Results** | Auto-grading with explanations | MVP |
| **Practice Tests** | Unlimited retakes for skill building | MVP |
| **Assignments** | File upload for instructor review | MVP |
| **Assignment Submissions** | Upload files with due date tracking | MVP |
| **Grade View** | See all quiz scores and assignment grades | MVP |
| **Gradebook** | Complete transcript of performance | MVP |

#### Interaction & Engagement
| Feature | Description | Priority |
|---------|-------------|----------|
| **Q&A Section** | Ask questions on specific lectures | MVP |
| **Search Q&A** | Find existing answers before asking | MVP |
| **Direct Messaging** | Message instructors (if enabled) | Phase 2 |
| **Discussion Forum** | Course-specific discussion boards | Phase 2 |
| **Peer Reviews** | Review classmate assignments (if enabled) | Phase 2 |
| **Course Reviews** | Rate and review completed courses | MVP |
| **Announcements** | Receive instructor announcements | MVP |

#### Progress & Achievement
| Feature | Description | Priority |
|---------|-------------|----------|
| **Progress Dashboard** | Visual completion percentage per course | MVP |
| **Certificates** | Auto-generated upon course completion | MVP |
| **Certificate Download** | PDF download with unique ID | MVP |
| **Certificate Verification** | Public verification page | Phase 2 |
| **Learning Streaks** | Track daily learning consistency | Phase 2 |
| **Achievements/Badges** | Gamification elements | Phase 2 |

#### Account Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **Profile Settings** | Edit name, photo, bio, social links | MVP |
| **Purchase History** | View all course purchases and invoices | MVP |
| **Payment Methods** | Manage saved payment options | MVP |
| **Email Preferences** | Control notification settings | MVP |
| **Privacy Settings** | Control profile visibility | MVP |
| **Support Tickets** | Submit help requests | MVP |
| **Calendar Integration** | Sync course deadlines to personal calendar | Phase 2 |

---

### 3. INSTRUCTOR/TRAINER
**Access**: All student features + instructor tools

#### Instructor Dashboard
| Feature | Description | Priority |
|---------|-------------|----------|
| **Instructor Home** | Overview of courses, students, revenue, analytics | MVP |
| **Course Performance** | Enrollment trends, completion rates, revenue | MVP |
| **Student Roster** | View all enrolled students across courses | MVP |
| **Revenue Dashboard** | Earnings, payouts, sales analytics | MVP |
| **Analytics & Insights** | Detailed metrics (watch time, drop-off points, engagement) | MVP |
| **Marketplace Insights** | Trending topics, demand analysis | Phase 2 |

#### Course Creation & Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **Course Manager** | Create, edit, publish, unpublish courses | MVP |
| **Curriculum Builder** | Drag-and-drop section and lecture organization | MVP |
| **Video Upload** | Upload videos with transcoding options | MVP |
| **YouTube Integration** | Paste YouTube (unlisted) video IDs | MVP |
| **Reading/Article Creator** | Rich text editor for text-based lessons | MVP |
| **Quiz Builder** | Create MCQ, true/false, short answer questions | MVP |
| **Assignment Builder** | Create assignments with rubrics, due dates | MVP |
| **Resource Upload** | Attach files to lectures (PDFs, code, etc.) | MVP |
| **Course Pricing** | Set price, create discounts, promotional pricing | MVP |
| **Course Image** | Upload thumbnail image | MVP |
| **Course Landing Page** | Design course sales page with description | MVP |
| **Preview Settings** | Select which video is free preview | MVP |
| **Drip Content** | Schedule lesson release dates | Phase 2 |

#### Content Library
| Feature | Description | Priority |
|---------|-------------|----------|
| **Content Library** | Store reusable videos, resources, quizzes | MVP |
| **Bulk Upload** | Upload multiple files at once | Phase 2 |
| **Version Control** | Replace videos without changing URLs | Phase 2 |
| **Caption Management** | Upload SRT files for accessibility | Phase 2 |

#### Student Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **Student Roster** | View enrolled students per course | MVP |
| **Student Progress Tracking** | See individual student completion rates | MVP |
| **Grade Assignments** | Review submissions, provide feedback, assign grades | MVP |
| **Bulk Grading** | Grade multiple submissions efficiently | Phase 2 |
| **Q&A Dashboard** | Answer student questions, mark top answers | MVP |
| **Q&A Insights** | AI-powered analysis of common questions | Phase 2 |
| **Direct Messaging** | Message individual students | Phase 2 |
| **Announcements** | Send course-wide announcements | MVP |
| **Email Students** | Send targeted emails to enrolled students | MVP |

#### Engagement Tools
| Feature | Description | Priority |
|---------|-------------|----------|
| **Welcome Message** | Auto-send message on enrollment | MVP |
| **Congratulations Message** | Auto-send on course completion | MVP |
| **Discussion Moderation** | Moderate forum posts, Q&A | Phase 2 |
| **Office Hours** | Schedule live Q&A sessions | Phase 2 |
| **Live Sessions** | Host live webinars/classes | Phase 2 |

#### Certification & Reviews
| Feature | Description | Priority |
|---------|-------------|----------|
| **Certificate Designer** | Customize certificate template per course | MVP |
| **Review Management** | View and respond to course reviews | MVP |
| **Course Reviews Dashboard** | Analyze rating trends | MVP |

#### E-commerce Tools
| Feature | Description | Priority |
|---------|-------------|----------|
| **Coupon Creation** | Create discount codes (percentage/fixed amount) | MVP |
| **Referral Links** | Generate trackable promotional links | MVP |
| **Promotional Tools** | Create bundles, flash sales | Phase 2 |

#### Instructor Profile
| Feature | Description | Priority |
|---------|-------------|----------|
| **Public Profile** | Instructor bio, photo, social links, courses | MVP |
| **Profile Customization** | Branded instructor page | MVP |
| **Profile Analytics** | Profile views, click-through rates | Phase 2 |

---

### 4. EMPLOYEE (Support & Operations)
**Access**: Platform operations and student support

| Feature | Description | Priority |
|---------|-------------|----------|
| **Support Dashboard** | View all open support tickets | MVP |
| **Ticket Management** | Assign, prioritize, resolve tickets | MVP |
| **Student Account Management** | View/edit student accounts (permissions) | MVP |
| **Course Access Control** | Grant/revoke course access | MVP |
| **Refund Processing** | Process refund requests | MVP |
| **Content Moderation** | Flag inappropriate content | MVP |
| **User Reports** | Generate user activity reports | MVP |
| **Payment Disputes** | Handle payment issues | MVP |
| **Live Chat Support** | Real-time chat with users | Phase 2 |
| **Email Templates** | Manage automated email templates | Phase 2 |
| **FAQ Management** | Update help center articles | Phase 2 |

---

### 5. SUPER ADMIN (Platform Administrator)
**Access**: Complete system control

#### User Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **User Directory** | View/search all users (students, instructors, employees) | MVP |
| **User Creation** | Manually create user accounts | MVP |
| **Role Assignment** | Assign/modify user roles | MVP |
| **User Suspension** | Suspend/ban user accounts | MVP |
| **Bulk User Import** | CSV import for bulk registration | Phase 2 |
| **User Activity Logs** | Track user actions for security | Phase 2 |

#### Course Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **Course Approval** | Approve/reject instructor course submissions | MVP |
| **Course Quality Review** | Review course content before publishing | MVP |
| **Course Categories** | Create/manage course categories | MVP |
| **Featured Courses** | Mark courses as featured on homepage | MVP |
| **Course Removal** | Delete/archive courses | MVP |
| **Instructor Verification** | Approve new instructor accounts | MVP |

#### Platform Analytics
| Feature | Description | Priority |
|---------|-------------|----------|
| **Admin Dashboard** | System-wide KPIs and metrics | MVP |
| **Revenue Analytics** | Total revenue, trends, forecasts | MVP |
| **User Analytics** | Registration trends, active users, retention | MVP |
| **Course Analytics** | Most popular courses, completion rates | MVP |
| **Traffic Analytics** | Page views, bounce rates, conversion rates | MVP |
| **Geographic Analytics** | User distribution by location | Phase 2 |
| **Custom Reports** | Generate ad-hoc reports | Phase 2 |

#### System Settings
| Feature | Description | Priority |
|---------|-------------|----------|
| **Platform Settings** | Site name, logo, tagline, contact info | MVP |
| **Payment Gateway Config** | Configure Stripe/PayPal/Razorpay | MVP |
| **Email Configuration** | SMTP settings, email templates | MVP |
| **Security Settings** | Password policies, 2FA enforcement | MVP |
| **Backup Management** | Schedule automated backups | MVP |
| **System Maintenance** | Enable maintenance mode | MVP |
| **Tax Settings** | Configure tax rates by region | Phase 2 |
| **Currency Settings** | Multi-currency support | Phase 2 |

#### Content Moderation
| Feature | Description | Priority |
|---------|-------------|----------|
| **Review Queue** | New courses awaiting approval | MVP |
| **Flagged Content** | User-reported content review | MVP |
| **Comment Moderation** | Review flagged comments/Q&A | MVP |
| **Automated Filters** | Content filtering rules | Phase 2 |

#### Financial Management
| Feature | Description | Priority |
|---------|-------------|----------|
| **Payout Management** | Manage instructor payouts | MVP |
| **Transaction Logs** | All payment transactions | MVP |
| **Refund Management** | Process platform-wide refunds | MVP |
| **Commission Settings** | Configure revenue split with instructors | MVP |
| **Financial Reports** | Detailed financial analytics | MVP |

#### Marketing & Promotion
| Feature | Description | Priority |
|---------|-------------|----------|
| **Email Campaigns** | Send marketing emails to user segments | Phase 2 |
| **Banner Management** | Create promotional banners | Phase 2 |
| **Coupon Management** | Platform-wide discount codes | Phase 2 |
| **Affiliate Program** | Manage affiliate partnerships | Phase 2 |

#### Integrations
| Feature | Description | Priority |
|---------|-------------|----------|
| **Zoom Integration** | For live sessions | Phase 2 |
| **Google Analytics** | Track platform metrics | Phase 2 |
| **Zapier Integration** | Automate workflows | Phase 2 |
| **API Management** | Manage third-party API access | Phase 2 |

---

## Public Homepage Features

### Homepage Structure
```
┌─────────────────────────────────────────────┐
│           NAVIGATION BAR                     │
│  Logo | Browse | Search | Login | Sign Up   │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│           HERO SECTION                       │
│  Headline + Subheadline + CTA Button        │
│  Background: Gradient or Video              │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│     FEATURED COURSES (Carousel)             │
│  ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐          │
│  │Card │ │Card │ │Card │ │Card │          │
│  └─────┘ └─────┘ └─────┘ └─────┘          │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│         COURSE CATEGORIES                    │
│  Tech | Business | Design | Marketing       │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│         HOW IT WORKS                         │
│  1. Browse  2. Purchase  3. Learn           │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│     INSTRUCTOR SPOTLIGHT                     │
│  Meet our expert instructors                │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│         TESTIMONIALS                         │
│  Student success stories                    │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│              FOOTER                          │
│  Links | Social Media | Contact | Copyright │
└─────────────────────────────────────────────┘
```

---

## Complete Page Structure

### Public Pages
1. **Homepage** - Landing page with hero, featured courses
2. **Course Catalog** - Browse all courses with filters
3. **Course Detail** - Individual course sales page
4. **Instructor Profile** - Public instructor bio page
5. **About Us** - Platform information
6. **Contact** - Contact form
7. **Login** - User authentication
8. **Register** - User registration (Student/Instructor choice)
9. **Forgot Password** - Password reset
10. **Privacy Policy** - Legal information
11. **Terms of Service** - User agreement
12. **FAQ** - Frequently asked questions

### Student Pages
1. **Student Dashboard** - Overview of learning activity
2. **My Courses** - Grid of enrolled courses
3. **Course Player** - Video lesson viewer
4. **Assignment Submission** - Upload assignment files
5. **Quiz Taking** - Take assessments
6. **Grades & Transcript** - View all grades
7. **Certificates** - Download certificates
8. **Profile Settings** - Edit account details
9. **Purchase History** - Transaction history
10. **Support Center** - Submit tickets
11. **Q&A Page** - Course-specific questions
12. **Messages** - Inbox for direct messages
13. **Calendar** - Upcoming deadlines
14. **Wishlist** - Saved courses

### Instructor Pages
1. **Instructor Dashboard** - Overview of teaching activity
2. **Course Manager** - List of created courses
3. **Course Builder** - Create/edit course curriculum
4. **Video Upload** - Upload/manage videos
5. **Quiz Builder** - Create assessments
6. **Assignment Manager** - Create assignments
7. **Grading Dashboard** - Grade student submissions
8. **Student Roster** - View enrolled students
9. **Q&A Dashboard** - Answer student questions
10. **Analytics** - Course performance metrics
11. **Revenue Report** - Earnings dashboard
12. **Announcements** - Send course announcements
13. **Coupon Manager** - Create discount codes
14. **Profile Settings** - Edit instructor profile
15. **Payout Settings** - Bank details for payments

### Admin Pages
1. **Admin Dashboard** - System overview
2. **User Management** - Manage all users
3. **Course Approval** - Review pending courses
4. **Platform Settings** - System configuration
5. **Payment Settings** - Gateway configuration
6. **Analytics Dashboard** - Platform metrics
7. **Support Tickets** - Manage all tickets
8. **Email Management** - Email templates
9. **Category Management** - Course categories
10. **Featured Courses** - Homepage curation
11. **Transaction Logs** - All payments
12. **Backup Manager** - System backups

---

## Database Schema Extensions

### Additional Tables Beyond Base Schema

```sql
-- Public access tracking
CREATE TABLE video_previews (
    preview_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    video_id INT,
    ip_address VARCHAR(45),
    viewed_at DATETIME,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (video_id) REFERENCES lesson_video(video_id)
);

-- Wishlist
CREATE TABLE wishlist (
    wishlist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    course_id INT,
    added_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Course reviews
CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    course_id INT,
    rating DECIMAL(2,1),
    review_text TEXT,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Coupons
CREATE TABLE coupons (
    coupon_id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) UNIQUE,
    discount_type ENUM('percentage', 'fixed'),
    discount_value DECIMAL(10,2),
    course_id INT,
    valid_from DATETIME,
    valid_until DATETIME,
    usage_limit INT,
    times_used INT DEFAULT 0,
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Announcements
CREATE TABLE announcements (
    announcement_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    trainer_id INT,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (trainer_id) REFERENCES users(user_id)
);

-- Q&A
CREATE TABLE questions (
    question_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lesson_id INT,
    question_text TEXT,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id)
);

CREATE TABLE answers (
    answer_id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT,
    user_id INT,
    answer_text TEXT,
    is_top_answer TINYINT(1) DEFAULT 0,
    created_at DATETIME,
    FOREIGN KEY (question_id) REFERENCES questions(question_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Notifications
CREATE TABLE notifications (
    notification_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    type VARCHAR(50),
    message TEXT,
    is_read TINYINT(1) DEFAULT 0,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
```

---

## Development Phases

### Phase 1: MVP (2-3 months)
**Goal**: Launch functional platform with core features

**Deliverables**:
- Public homepage with course browsing
- User authentication (Student, Instructor, Admin)
- Course preview (1 free video per course)
- Payment integration (Stripe/Razorpay)
- Course player with video playback
- Basic instructor course creation
- Student enrollment and progress tracking
- Admin dashboard with user management
- Quiz and assignment functionality
- Certificate generation

### Phase 2: Enhanced Features (1-2 months)
**Goal**: Add engagement and advanced features

**Deliverables**:
- Discussion forums
- Direct messaging
- Live sessions integration
- Advanced analytics
- Email campaigns
- Coupon system
- Q&A with AI insights
- Notes and bookmarks
- Calendar integration
- Mobile responsive enhancements

### Phase 3: Optimization (1 month)
**Goal**: Performance, security, and scalability

**Deliverables**:
- CDN integration
- Redis caching
- Database optimization
- Security audit
- Load testing
- SEO optimization
- API documentation
- Third-party integrations (Zoom, Google Analytics)

---

## V0 Prompts Collection

### IMPORTANT: Use These Exact Animation Prompts

When building components, ALWAYS include these animation components in your prompts:

**Text Shimmer Loading (from document 2)**
```
Include the TextShimmer component for loading states using:
'use client';
import React, { useMemo, type JSX } from 'react';
import { motion } from 'framer-motion';
import { cn } from '@/lib/utils';

Use TextShimmer for any loading text with:
<TextShimmer className='font-mono text-sm' duration={1}>
  Generating code...
</TextShimmer>
```

**Animated Sidebar (from document 2)**
```
Use the sidebar component from document 2 with hover expand/collapse animation.
Include icons from lucide-react: LayoutDashboard, UserCog, Settings, LogOut
```

### V0 Prompt Template Structure

Every v0 prompt should follow this structure:

```
Create a [PAGE NAME] for an LMS platform.

DESIGN SYSTEM:
- Primary Background: #0a0a23 (deep navy)
- Primary Accent: #007bff (tech blue)
- Highlight: #00e5ff (bright cyan)
- Text on Dark: #f8f9fa (light grey)
- Secondary Text: #6c757d (muted grey)
- Card Background: #343a40 (dark grey)
- Success: #28a745
- Danger: #dc3545
- Warning: #ffc107

- Font: Poppins for headings, Roboto for body
- Professional, modern, tech-focused aesthetic like sas-ai.in

ANIMATIONS:
- Include smooth transitions and hover effects
- Use framer-motion for animations
- Include the TextShimmer loading component
- Use the animated sidebar for navigation pages

LAYOUT:
[Describe specific layout requirements]

COMPONENTS:
[List specific UI elements needed]

FUNCTIONALITY:
[Describe interactions and behaviors]

Make it responsive, professional, and use modern UI patterns from 21st.dev components.
```

---

### 1. PUBLIC HOMEPAGE

```
Create a modern LMS homepage for a professional learning platform.

DESIGN SYSTEM (SAS-AI Theme):
- Primary Background: #0a0a23 (deep navy/black)
- Primary Accent: #007bff (tech blue)
- Highlight: #00e5ff (bright cyan)
- Light Text: #f8f9fa on dark backgrounds
- Muted Text: #6c757d
- Card Background: #343a40 (dark grey)
- Success: #28a745, Danger: #dc3545, Warning: #ffc107

Typography:
- Headings: Poppins (bold, modern)
- Body: Roboto (readable)

ANIMATIONS:
- Include smooth scroll animations
- Hero section should have gradient animation
- Course cards should have hover lift effects
- Use TextShimmer for "Featured" badges
- Include parallax effects on scroll

LAYOUT:

1. NAVIGATION BAR (sticky):
   - Logo (left): "SAS-AI LMS" with icon
   - Center: Browse Courses dropdown, About, Contact
   - Right: Search bar, Login button (outlined), Sign Up button (solid blue)
   - Dark navy background #0a0a23

2. HERO SECTION:
   - Full-screen height
   - Animated gradient background (navy to dark blue)
   - Center-aligned content:
     * Main headline (white, 48px): "Master Skills That Matter"
     * Subheadline (light grey, 20px): "Learn from industry experts. Earn certificates. Advance your career."
     * CTA button (cyan accent #00e5ff): "Explore Courses" (large, rounded)
     * Secondary text: "Watch your first video FREE on any course"
   - Floating geometric shapes animation in background

3. FEATURED COURSES (carousel):
   - Section title: "Featured Courses"
   - Horizontal scroll carousel with 4-5 course cards
   - Each card:
     * Course thumbnail image (16:9 ratio)
     * Dark card background #343a40
     * Course title (white, bold)
     * Instructor name (muted grey)
     * Rating stars + review count
     * Price (cyan accent) with "FREE PREVIEW" badge
     * Hover: Lift effect, glow border
   - "View All" button at end

4. CATEGORY GRID:
   - Title: "Popular Categories"
   - 6 category cards in grid (2 rows x 3 columns)
   - Each card:
     * Icon (tech blue)
     * Category name
     * Course count
     * Hover: Scale slightly, change icon color to cyan

5. HOW IT WORKS:
   - Title: "Start Learning in 3 Steps"
   - 3 columns with icons:
     * Browse Courses icon
     * Purchase Access icon  
     * Learn & Earn Certificate icon
   - Each step numbered with cyan accent

6. INSTRUCTOR SPOTLIGHT:
   - Title: "Learn from the Best"
   - 3 instructor cards with:
     * Circular photo
     * Name and title
     * Brief bio (2 lines)
     * "View Courses" link
   - Light grey background section

7. TESTIMONIALS:
   - Title: "What Our Students Say"
   - Carousel of testimonial cards:
     * Student photo
     * Name and course
     * Star rating
     * Testimonial text (3-4 lines)
     * Card with subtle shadow

8. STATS SECTION:
   - Dark navy background
   - 4 stat counters in row:
     * Students Enrolled
     * Courses Available
     * Expert Instructors
     * Certificates Issued
   - Animated counting effect
   - Cyan accent numbers

9. FINAL CTA:
   - Full-width section
   - Gradient background
   - "Ready to Start Learning?"
   - Sign Up button (large, cyan)

10. FOOTER:
    - 4 columns:
      * About (logo, tagline)
      * Quick Links (Courses, Instructors, Blog)
      * Support (FAQ, Contact, Help)
      * Social Media icons
    - Bottom bar: "A product of [Company], a proud subsidiary of SAS-AI Gateway"
    - Dark background #0a0a23

Make everything fully responsive with mobile-first approach. Include smooth animations using framer-motion. Professional, modern, trust-building design. Use components from 21st.dev for enhanced UI.
```

---

### 2. COURSE CATALOG PAGE

```
Create a course catalog/marketplace page for an LMS platform.

DESIGN SYSTEM (SAS-AI Theme):
- Background: #0a0a23 (dark navy)
- Cards: #343a40 (dark grey)
- Primary Accent: #007bff (blue)
- Highlight: #00e5ff (cyan)
- Text: #f8f9fa (light) / #6c757d (muted)
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Skeleton loading cards with shimmer effect
- Filter sidebar slide-in animation
- Card hover with lift and glow
- Smooth transitions on all interactions

LAYOUT:

1. HEADER:
   - Page title: "All Courses"
   - Breadcrumb: Home > Courses
   - View toggle: Grid/List icons

2. SEARCH & FILTER BAR:
   - Search input (full width): "Search courses..."
   - Filter button (mobile): Opens sidebar
   - Sort dropdown: "Most Popular", "Newest", "Highest Rated", "Price: Low to High"

3. LEFT SIDEBAR (collapsible on mobile):
   - "FILTERS" heading
   - Category checkboxes:
     * Technology
     * Business
     * Design
     * Marketing
     * Personal Development
   - Price range slider:
     * Free
     * Under $50
     * $50-$100
     * $100+
   - Rating filter (stars)
   - Level checkboxes:
     * Beginner
     * Intermediate
     * Advanced
   - "Clear All" button at bottom

4. COURSE GRID (main area):
   - Responsive grid: 3 columns desktop, 2 tablet, 1 mobile
   - Course card structure:
     * Thumbnail image with "FREE PREVIEW" badge overlay
     * Category tag (top-left, small, cyan)
     * Title (white, bold, 2 lines max)
     * Instructor name (grey, small)
     * Star rating + "(X reviews)"
     * Duration + lesson count icons
     * Price (cyan, large) with strikethrough original if discounted
     * Hover effects:
       - Lift card slightly
       - Show cyan glow border
       - "View Details" button fades in
     * "Add to Wishlist" heart icon (top-right)

5. PAGINATION:
   - Bottom center
   - Page numbers with prev/next arrows
   - Cyan accent for active page

6. LOADING STATE:
   - Show skeleton cards with TextShimmer
   - Pulse animation on placeholder cards

7. EMPTY STATE:
   - If no results: illustration + "No courses found" + "Clear filters" button

Make responsive. Include smooth filtering animations. Professional marketplace feel like Udemy. Use 21st.dev components for polish.
```

---

### 3. COURSE DETAIL PAGE (Sales Page)

```
Create a course detail/sales page for an LMS showing course information before purchase.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Video preview autoplays on hover (muted)
- Sticky sidebar on scroll
- Smooth section transitions
- Tab switching animation

LAYOUT:

1. HERO SECTION:
   - Breadcrumb: Home > Category > Course Name
   - Left side (60%):
     * Course title (large, white)
     * Short tagline (grey)
     * Star rating + review count
     * Instructor name with photo (small, circular)
     * Last updated date + language
     * "FREE PREVIEW AVAILABLE" badge (cyan)
   - Right side (40%):
     * Preview video player (16:9)
     * "Watch First Video Free" overlay
     * Play icon
     * On hover: autoplay preview (muted)

2. STICKY SIDEBAR (right, desktop only):
   - Course price (large, cyan)
   - Discount badge if applicable
   - "Buy Now" button (large, solid cyan)
   - "Add to Cart" button (outlined)
   - "Save to Wishlist" (heart icon)
   - Course includes:
     * X hours video
     * X downloadable resources
     * Full lifetime access
     * Certificate of completion
   - Share buttons (social icons)

3. TAB NAVIGATION:
   - Overview | Curriculum | Instructor | Reviews
   - Active tab: cyan underline
   - Smooth content switching

4. OVERVIEW TAB:
   - "What you'll learn" section:
     * Grid of checkmarks with learning outcomes
     * 2 columns
   - "Requirements" section:
     * Bullet list
   - "Description" section:
     * Rich text content
     * "Show more" if long
   - "Who this course is for":
     * Bullet list of target audience

5. CURRICULUM TAB:
   - Expandable sections (accordion)
   - Each section shows:
     * Section title
     * X lectures, XX min total
   - Each lecture:
     * Video icon or document icon
     * Lecture title
     * Duration
     * FIRST video: "FREE PREVIEW" green badge + "Play" button
     * Other videos: Lock icon (greyed)
   - "X sections • XX lectures • XXh XXm total length"

6. INSTRUCTOR TAB:
   - Instructor card:
     * Large photo
     * Name and title
     * Star rating as instructor
     * # students taught
     * # courses created
   - Bio text
   - "View all courses by instructor" button
   - Other courses by instructor (horizontal scroll)

7. REVIEWS TAB:
   - Overall rating (large):
     * Average stars
     * Total # of ratings
   - Rating breakdown bar chart:
     * 5 stars: XX%
     * 4 stars: XX%
     * etc.
   - Individual review cards:
     * Student name + photo
     * Star rating
     * Date
     * Review text
     * "Helpful" thumbs up counter
   - Pagination
   - "Sort by" dropdown (Most Recent, Highest Rated, etc.)

8. RELATED COURSES:
   - "Students also bought"
   - Horizontal carousel of 4 course cards
   - Same card design as catalog

9. FAQ ACCORDION:
   - Common questions about purchasing, refunds, access

Make responsive. Video preview should be engaging. Strong call-to-action. Professional sales page like Udemy. Use 21st.dev components.
```

---

### 4. STUDENT DASHBOARD

```
Create a student dashboard for an LMS showing learning overview and progress.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Sidebar: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Use animated sidebar component from document 2 (hover expand/collapse)
- Progress bars animate on load
- Card hover effects
- Notification badge pulse

LAYOUT:

1. ANIMATED SIDEBAR (from document 2):
   - Logo at top
   - Navigation items with icons from lucide-react:
     * Dashboard (LayoutDashboard icon)
     * My Courses (BookOpen icon)
     * Calendar (Calendar icon)
     * Messages (Mail icon)
     * Certificates (Award icon)
     * Support (HelpCircle icon)
     * Settings (Settings icon)
   - User profile at bottom (name + photo)
   - Sidebar expands on hover showing labels
   - Collapsed: shows only icons (60px wide)
   - Expanded: shows icons + labels (300px wide)

2. TOP BAR:
   - Welcome message: "Welcome back, [Student Name]!"
   - Search bar (center)
   - Notification bell icon (with badge count)
   - User avatar dropdown (right)

3. MAIN CONTENT AREA:

   A. STATS ROW (4 cards):
      - Card 1: "Courses in Progress" (number + icon)
      - Card 2: "Completed Courses" (number + icon)
      - Card 3: "Certificates Earned" (number + icon)
      - Card 4: "Learning Streak" (days + fire icon)
      - Each card: dark background, cyan accent numbers, icon
      - Hover: slight lift effect

   B. CONTINUE LEARNING SECTION:
      - "Continue Where You Left Off" heading
      - 2-3 course cards horizontally:
        * Course thumbnail
        * Title
        * Progress bar (animated)
        * "XX% complete"
        * "Continue" button (cyan)
      - If empty: "No courses in progress. Browse courses to get started."

   C. UPCOMING SECTION:
      - "Upcoming This Week" heading
      - Timeline layout:
        * Assignment due dates
        * Quiz deadlines
        * Live session times
      - Each item: date dot, title, course name
      - Color-coded by type (assignments=warning, quizzes=info, sessions=success)

   D. RECOMMENDED COURSES:
      - "Recommended For You" heading
      - 3 course cards (small):
        * Thumbnail
        * Title
        * Instructor
        * Rating
        * Price with "Preview Free" badge
      - Based on completed courses/interests

   E. RECENT ACTIVITY FEED:
      - "Recent Activity" (right sidebar or bottom section)
      - List of recent actions:
        * "Completed lesson X in Course Y"
        * "Earned certificate for Course Z"
        * "Submitted assignment for Course W"
      - Timestamp for each
      - Icons for each activity type

4. QUICK ACTIONS (floating or top-right):
   - "Browse Courses" button
   - "View All Courses" button
   - "Get Help" button

Include loading skeletons with TextShimmer. Make responsive (sidebar collapses to hamburger on mobile). Professional, motivating design. Use 21st.dev components.
```

---

### 5. COURSE PLAYER PAGE

```
Create a video course player page for an LMS where students watch lessons.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Video player: black background
- Sidebar: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Sidebar slide in/out animation
- Progress checkmark animation
- Smooth tab switching
- Video controls fade in/out on hover

LAYOUT:

1. HEADER BAR (thin, sticky):
   - Back button (left): "← Back to Course"
   - Course title (center, truncated)
   - User avatar (right, small)

2. MAIN VIDEO PLAYER (60% width, left):
   - Video player (16:9 aspect ratio):
     * Custom controls bar at bottom:
       - Play/Pause button
       - Video timestamp (00:00 / 00:00)
       - Progress bar (seekable, cyan accent)
       - Volume control
       - Speed control (0.5x, 1x, 1.5x, 2x)
       - Quality settings (Auto, 720p, 1080p)
       - Fullscreen button
     * "Mark as Complete" button overlays bottom-right when near end
   - Below video:
     * Lesson title (large, white)
     * Description (expandable)
     * "Resources" section (downloadable files with icons)
     * Tab navigation: Notes | Q&A | Announcements

3. NOTES TAB:
   - "Add a note" text area
   - Save button
   - List of saved notes with timestamps
   - Click timestamp to jump to that point in video

4. Q&A TAB:
   - "Ask a question" button (opens modal)
   - Search existing questions
   - List of questions:
     * Question text
     * Asker name + date
     * "Top Answer" badge if marked
     * Answer count
     * Upvote button
   - Click to expand and see answers

5. ANNOUNCEMENTS TAB:
   - List of instructor announcements
   - Date + title + content
   - Newest first

6. CURRICULUM SIDEBAR (40% width, right):
   - "Course Content" heading
   - Progress bar: "XX% Complete"
   - Section accordion:
     * Section title + total duration
     * Expand to show lessons
   - Each lesson:
     * Icon (video/reading/quiz/assignment)
     * Lesson title
     * Duration
     * Checkmark icon if completed (green)
     * Lock icon if not yet accessible
     * ACTIVE lesson: highlighted with cyan border
   - Click any unlocked lesson to navigate
   - Collapse/expand button for sidebar (mobile)

7. BOTTOM NAV BAR:
   - "Previous Lesson" button (left, disabled if first)
   - "Next Lesson" button (right, cyan, auto-enabled after completing current)
   - Keyboard shortcut hints on hover

8. KEYBOARD SHORTCUTS:
   - Space: Play/Pause
   - Arrow Left: -10 seconds
   - Arrow Right: +10 seconds
   - F: Fullscreen
   - M: Mute
   - Show shortcuts modal on pressing "?"

Make fully responsive. Sidebar collapses to bottom drawer on mobile. Video player uses native HTML5 with custom styling. Professional, distraction-free learning interface. Include progress auto-save. Use 21st.dev components for tabs and modals.
```

---

### 6. INSTRUCTOR DASHBOARD

```
Create an instructor dashboard for an LMS showing teaching overview and analytics.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Charts: Cyan/blue gradients
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Animated sidebar (use document 2 component)
- Chart animations (reveal on scroll)
- Card hover effects
- Number counter animations

LAYOUT:

1. ANIMATED SIDEBAR:
   - Logo at top
   - Navigation with lucide-react icons:
     * Dashboard (LayoutDashboard)
     * My Courses (BookOpen)
     * Students (Users)
     * Analytics (BarChart)
     * Revenue (DollarSign)
     * Q&A (MessageSquare)
     * Tools (Wrench)
     * Settings (Settings)
   - "Switch to Student View" button at bottom
   - User profile below

2. TOP BAR:
   - "Welcome back, [Instructor Name]" (left)
   - Quick actions dropdown (center):
     * "Create New Course"
     * "Upload Video"
     * "Create Announcement"
   - Notification bell + avatar (right)

3. MAIN CONTENT:

   A. KEY METRICS ROW (4 cards):
      - Total Students (animated counter)
      - Total Revenue ($ with animated counter)
      - Course Rating (stars + average)
      - Total Enrollments (animated counter)
      - Each card: icon, number (large, cyan), label, change % (green/red arrow)

   B. PERFORMANCE CHART:
      - "Course Performance" heading
      - Time range selector: 7 days, 30 days, 90 days, All time
      - Line chart showing:
        * Enrollments over time (cyan line)
        * Revenue over time (blue line)
      - Gradient fill under lines
      - Animated on load
      - Hover tooltips with exact values

   C. COURSES TABLE:
      - "My Courses" heading with "View All" link
      - Table columns:
        * Course name (with thumbnail)
        * Status (Published/Draft badge)
        * Students enrolled
        * Rating (stars)
        * Revenue
        * Actions (Edit / Analytics / Preview icons)
      - Show top 5 courses
      - Alternating row colors
      - Hover: highlight row

   D. RECENT ACTIVITY FEED:
      - "Recent Activity" heading
      - List:
        * "New enrollment in Course X"
        * "New review (4 stars) on Course Y"
        * "Question asked in Course Z"
      - Timestamp for each
      - Icons for activity types
      - "View All Activity" link

   E. STUDENT PROGRESS:
      - "Student Progress" heading
      - Donut chart showing:
        * % Completed courses (green)
        * % In progress (cyan)
        * % Not started (grey)
      - Legend with counts

   F. TOP PERFORMING COURSES (right sidebar or bottom):
      - "Top 3 Courses by Revenue"
      - Cards with:
        * Course name
        * Revenue this month
        * Growth % (green arrow up)
      - Mini bar chart

   G. Q&A SUMMARY:
      - "Unanswered Questions" alert card
      - Number of pending questions
      - "Go to Q&A" button
      - Alert red color if > 10

   H. QUICK STATS:
      - "This Month" heading
      - Grid of mini stats:
        * New students
        * New reviews
        * Hours watched
        * Average completion rate
      - Each with icon

4. CALL-TO-ACTION CARDS:
   - "Create Your Next Course" (if < 3 courses)
   - "Boost Your Revenue" (promotion tips)
   - "Improve Course Quality" (links to resources)

Make responsive. Charts should be interactive. Professional instructor-focused dashboard. Include data visualization. Use 21st.dev components for charts and cards.
```

---

### 7. COURSE BUILDER (Instructor)

```
Create a course builder/editor page for instructors to create and manage course content.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Drag and drop animations
- Section expand/collapse
- Sidebar slide
- Save confirmation toast
- Loading shimmer on uploads

LAYOUT:

1. HEADER:
   - "Course Builder: [Course Name]" (left)
   - Status badge: "Draft" or "Published"
   - Actions (right):
     * "Preview" button (outlined)
     * "Save Draft" button (grey)
     * "Publish" button (cyan, solid)
   - Autosave indicator: "Last saved: X min ago"

2. PROGRESS TABS (horizontal):
   - Course Details
   - Curriculum
   - Pricing
   - Settings
   - Active tab: cyan underline

3. TAB: COURSE DETAILS
   - Form layout:
     * Course Title (text input, required)
     * Subtitle (text input)
     * Description (rich text editor with toolbar)
     * Category (dropdown)
     * Level (radio buttons: Beginner/Intermediate/Advanced)
     * Language (dropdown)
   - Thumbnail upload:
     * Drag and drop area
     * "Upload Image" button
     * Preview thumbnail
     * Recommended size text
   - "What students will learn" (bullet list):
     * Add/remove learning outcomes
     * Each outcome in editable text field
   - "Requirements" (bullet list)
   - "Target audience" (bullet list)

4. TAB: CURRICULUM (Main focus)
   
   LEFT PANEL (30%):
   - "Curriculum Structure" heading
   - Drag-and-drop interface:
     * Sections (expandable accordion)
     * Each section:
       - Section title (editable inline)
       - Duration counter (auto-calculated)
       - "+ Add Lecture" button
       - Drag handle icon (left)
       - Delete icon (right)
     * Lectures nested under sections:
       - Lecture title
       - Type icon (video/reading/quiz/assignment)
       - Duration
       - Drag handle
       - Edit/Delete icons
   - "+ Add Section" button at bottom
   - Visual feedback when dragging (ghost element)

   RIGHT PANEL (70%):
   - "Lecture Editor" heading
   - Shows when lecture selected from left panel
   - Forms based on lecture type:

   VIDEO LECTURE:
   - Lecture title (text input)
   - Video upload options (tabs):
     * Upload Video (drag-drop or browse)
     * YouTube Link (paste unlisted video URL)
   - Video preview player
   - Description (rich text)
   - Resources section:
     * "Add Resource" button
     * List uploaded files (PDFs, code, etc.)
   - "Is Preview" checkbox: "Allow free preview"
   - "Save Lecture" button (cyan)

   READING LECTURE:
   - Lecture title
   - Rich text editor (full WYSIWYG)
   - "Add images" button
   - "Save Lecture" button

   QUIZ LECTURE:
   - Quiz title
   - Time limit (minutes)
   - Pass percentage
   - "+ Add Question" button
   - Question editor:
     * Question text (textarea)
     * Question type (radio: MCQ / True-False / Short Answer)
     * For MCQ:
       - Add multiple answer options
       - Mark correct answer (radio button)
     * For True-False:
       - Radio buttons for correct answer
     * For Short Answer:
       - Model answer (textarea)
     * Points value (number input)
   - Drag to reorder questions
   - "Save Quiz" button

   ASSIGNMENT LECTURE:
   - Assignment title
   - Instructions (rich text)
   - Due date (date picker)
   - Max file size (number input)
   - Allowed file types (checkboxes: PDF, DOCX, ZIP, etc.)
   - Points value
   - "Save Assignment" button

5. TAB: PRICING
   - Price input (currency dropdown + amount)
   - Discount settings:
     * Enable discount (toggle)
     * Discount percentage
     * Valid dates
   - "Free course" toggle
   - "Create coupon" button (opens modal)
   - Coupon list table

6. TAB: SETTINGS
   - Course URL/slug (auto-generated, editable)
   - Course visibility:
     * Public (listed)
     * Private (unlisted)
     * Password protected
   - Enrollment settings:
     * Open enrollment
     * Limited seats
     * Enrollment deadline
   - Certificate settings:
     * Enable certificates
     * Completion percentage required
   - Course message templates:
     * Welcome message (text editor)
     * Completion message (text editor)

7. FLOATING SAVE BAR (bottom):
   - Appears when unsaved changes
   - "You have unsaved changes"
   - "Save Draft" button
   - "Discard" button

8. MODALS:
   - Delete confirmation
   - Publish confirmation (checklist of requirements)
   - File upload progress
   - Video processing status

Make fully responsive. Drag-and-drop should be intuitive. Real-time validation. Professional course creation interface like Udemy/Teachable. Use 21st.dev components for rich interactions.
```

---

### 8. ADMIN DASHBOARD

```
Create a super admin dashboard for LMS platform management with system-wide analytics.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Charts: Multiple color gradients
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Animated sidebar (document 2)
- Real-time data updates
- Chart animations
- Notification popups

LAYOUT:

1. ANIMATED SIDEBAR:
   - Logo at top
   - Navigation with lucide-react icons:
     * Dashboard (LayoutDashboard)
     * Users (Users)
     * Courses (BookOpen)
     * Revenue (DollarSign)
     * Analytics (TrendingUp)
     * Support (MessageCircle)
     * Settings (Settings)
   - User profile at bottom

2. TOP BAR:
   - "Admin Dashboard" heading
   - Date range selector: Today, Week, Month, Year, Custom
   - Real-time indicator: "Live data" (pulsing dot)
   - Notification bell (with count badge)
   - Admin avatar dropdown

3. MAIN CONTENT:

   A. HERO STATS (4 cards):
      - Total Users (with growth % and chart sparkline)
      - Total Revenue ($ with growth % and chart sparkline)
      - Active Courses (number + change)
      - Platform Health (percentage + status dot: green/yellow/red)
      - Each card: large number (cyan), icon, mini trend chart below

   B. REVENUE CHART (full width):
      - "Revenue Overview" heading
      - Large area chart:
        * Revenue over time (gradient fill, cyan to transparent)
        * Multiple lines if showing course categories
        * Interactive tooltips on hover
        * Zoom controls
      - Toggle buttons: Revenue / Enrollments / Traffic
      - Export button (CSV/PDF)

   C. USER ANALYTICS (left column, 60%):
      - "User Growth" heading
      - Line chart: New users over time
      - Below chart:
        * User breakdown table:
          - Students: X (percentage)
          - Instructors: Y (percentage)
          - Active last 7 days: Z
        * "View All Users" button

   D. COURSE ANALYTICS (right column, 40%):
      - "Course Performance" heading
      - Bar chart: Top 10 courses by enrollment
      - Horizontal bars (cyan)
      - Course thumbnails + names on left
      - Numbers on right

   E. PENDING ACTIONS (alert cards):
      - "Courses Awaiting Approval" (orange badge with count)
      - "Unresolved Support Tickets" (red badge)
      - "Payment Issues" (yellow badge)
      - Click to navigate to respective pages

   F. GEOGRAPHIC MAP:
      - "User Distribution" heading
      - World map with heat map overlay
      - Darker cyan = more users
      - Hover to see country name + user count
      - Top 5 countries list below

   G. RECENT ACTIVITY TABLE:
      - "System Activity" heading
      - Real-time feed:
        * User registrations
        * Course purchases
        * Course publications
        * Support tickets
      - Columns: Timestamp, User, Action, Status
      - Color-coded status badges
      - Auto-refreshes every 30 sec
      - "View All Activity" link

   H. REVENUE BREAKDOWN (donut chart):
      - "Revenue by Category" heading
      - Donut chart with segments:
        * Technology courses
        * Business courses
        * Design courses
        * etc.
      - Legend with percentages
      - Animated on load

   I. SYSTEM HEALTH PANEL:
      - "Server Status" heading
      - Metrics cards:
        * Server Uptime (99.9%, green)
        * Database Performance (ms, status dot)
        * CDN Status (green/red)
        * Backup Status (last backup time)
      - "View System Logs" button

   J. QUICK ACTIONS (floating buttons or top bar):
      - "Create Announcement" (send platform-wide)
      - "Generate Report" (custom reports)
      - "System Settings"
      - "View Logs"

4. ALERTS/NOTIFICATIONS:
   - Toast notifications for real-time events:
     * New user registration
     * Course published
     * Payment received
     * Support ticket created
   - Slide in from top-right
   - Auto-dismiss after 5 seconds
   - Click to view details

5. EXPORT OPTIONS:
   - "Export Dashboard" button
   - Options: PDF Report, CSV Data, Email Report

Make highly responsive. Include real-time data where possible. Professional admin interface with data-rich visualizations. Use 21st.dev components for advanced charts and interactions.
```

---

### 9. USER MANAGEMENT (Admin)

```
Create a user management page for admin to view, search, edit, and manage all platform users.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Table: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Table row hover effects
- Modal slide-in animations
- Filter sidebar animation
- Search results fade-in
- Loading skeletons with TextShimmer

LAYOUT:

1. HEADER:
   - "User Management" heading
   - Breadcrumb: Admin > Users
   - "Add New User" button (cyan, right)

2. FILTER & SEARCH BAR:
   - Search input: "Search by name, email, or ID..."
   - Filter dropdowns:
     * Role filter: All / Student / Instructor / Employee / Admin
     * Status filter: All / Active / Suspended / Pending
     * Date registered: All time / Last 7 days / Last 30 days / Custom range
   - "Apply Filters" button
   - "Clear Filters" link
   - Export button: "Export to CSV"

3. STATS CARDS (above table):
   - Total Users (count)
   - Active Users (count, green)
   - Suspended Users (count, red)
   - New This Month (count, cyan)

4. USER TABLE:
   - Columns:
     * Checkbox (bulk select)
     * User ID (sortable)
     * Avatar (thumbnail)
     * Name (sortable, clickable)
     * Email
     * Role (badge: Student=blue, Instructor=purple, Admin=red)
     * Status (badge: Active=green, Suspended=red, Pending=yellow)
     * Registered Date (sortable)
     * Last Active (sortable)
     * Actions (dropdown)
   
   - Row hover: Highlight with cyan border
   
   - Actions dropdown per row:
     * View Profile
     * Edit User
     * View Activity Log
     * Send Email
     * Suspend/Unsuspend
     * Delete User
   
   - Bulk actions (when rows selected):
     * Top bar appears: "X users selected"
     * "Suspend" button
     * "Delete" button
     * "Send Email" button
     * "Clear selection"

   - Table features:
     * Sortable columns (click header)
     * Pagination (bottom)
     * Rows per page selector (10, 25, 50, 100)
     * Total results count

5. FILTER SIDEBAR (collapsible, left or modal):
   - "Advanced Filters" heading
   - Form fields:
     * Name search
     * Email search
     * Role checkboxes
     * Status checkboxes
     * Registration date range
     * Last active date range
     * Courses enrolled (min-max)
     * Spent amount (min-max)
   - "Apply" button (cyan)
   - "Reset" button

6. USER DETAIL MODAL (opens on "View Profile"):
   - Modal with tabs:
     * Overview
     * Courses (if student)
     * Activity Log
     * Billing
   
   OVERVIEW TAB:
   - User avatar (large)
   - Name + email
   - Role badge
   - Status badge
   - Registration date
   - Last login
   - Edit buttons: "Edit Profile" | "Change Role" | "Suspend"
   - Quick stats:
     * Courses enrolled (students)
     * Courses created (instructors)
     * Revenue contributed (instructors)
     * Support tickets

   COURSES TAB:
   - List of enrolled courses (students) or created courses (instructors)
   - Course name, progress, enrollment date
   - "View Course" links

   ACTIVITY LOG TAB:
   - Chronological list of user actions:
     * Login/logout
     * Course enrollments
     * Content uploads
     * Payment transactions
   - Timestamp for each
   - Pagination
   - "Export Log" button

   BILLING TAB:
   - Payment history table
   - Refund requests
   - Total spent/earned
   - "Issue Refund" button

7. EDIT USER MODAL (opens on "Edit User"):
   - Form fields:
     * Name (text input)
     * Email (text input)
     * Role (dropdown)
     * Status (dropdown)
     * Profile picture upload
     * Password reset button
   - "Save Changes" button (cyan)
   - "Cancel" button

8. ADD USER MODAL (opens on "Add New User"):
   - Form:
     * Name
     * Email
     * Password
     * Role
     * Send welcome email (checkbox)
   - "Create User" button

9. BULK OPERATIONS MODAL:
   - When bulk action clicked
   - Confirmation: "Are you sure you want to [action] X users?"
   - List affected users
   - "Confirm" button (red for destructive actions)
   - "Cancel" button

10. LOADING & EMPTY STATES:
    - Loading: Table skeleton with shimmer
    - No results: Illustration + "No users found" + "Clear filters"

Make responsive (table scrolls horizontally on mobile or converts to cards). Include robust search and filtering. Professional user management interface. Use 21st.dev components for table and modals.
```

---

### 10. LOGIN PAGE

```
Create a modern login page for an LMS platform.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23 (dark navy)
- Card: #343a40 (dark grey)
- Accent: #007bff (tech blue)
- Highlight: #00e5ff (bright cyan)
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Card slide-in from bottom on page load
- Input focus glow effect
- Button ripple effect on click
- Error shake animation
- Loading spinner on submit

LAYOUT:

FULL PAGE:
- Split screen (desktop):
  * Left side (50%): Branding/illustration
  * Right side (50%): Login form

LEFT SIDE (branding):
- Background: Gradient (navy #0a0a23 to dark blue #1a1a3a)
- Content (centered):
  * Logo (large, white)
  * Platform name: "SAS-AI LMS" (white, Poppins, bold)
  * Tagline: "Master Skills That Matter" (grey, Roboto)
  * Animated geometric shapes floating in background
  * Illustration: Student learning with laptop (subtle, minimalist)
  * Testimonial carousel (optional):
    - Rotating student quotes
    - Profile photo + name + star rating

RIGHT SIDE (form):
- Background: #0a0a23
- Centered card (#343a40, rounded corners, shadow):
  
  * "Welcome Back" heading (white, large)
  * "Login to continue your learning" (grey, small)
  
  * Email input:
    - Label: "Email Address"
    - Icon: Email icon (left inside input)
    - Placeholder: "your@email.com"
    - Focus: Cyan glow border
  
  * Password input:
    - Label: "Password"
    - Icon: Lock icon (left inside input)
    - Show/hide password toggle (eye icon, right)
    - Placeholder: "••••••••"
    - Focus: Cyan glow border
  
  * "Remember me" checkbox (left)
  * "Forgot Password?" link (right, cyan, underline on hover)
  
  * "Login" button:
    - Full width
    - Solid cyan (#00e5ff)
    - White text
    - Hover: Slightly darker cyan + lift effect
    - Loading state: Spinner replaces text
  
  * Divider: "OR" (centered, grey lines)
  
  * Social login buttons (optional):
    - "Continue with Google" (white button, Google icon)
    - "Continue with GitHub" (dark button, GitHub icon)
  
  * "Don't have an account?" (grey)
  * "Sign Up" link (cyan, bold)

ERROR STATE:
- Red border on invalid input
- Error message below input (red text)
- Shake animation on failed login

MOBILE LAYOUT:
- Single column
- Logo at top (small)
- Form below
- Branding/illustration hidden or reduced

LOADING STATE:
- Overlay with spinner
- "Signing you in..." text with TextShimmer

Make responsive. Smooth animations. Professional, trustworthy design. Include client-side validation. Use 21st.dev components for polished inputs and buttons.
```

---

### 11. REGISTRATION PAGE

```
Create a modern registration page for an LMS platform with role selection.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Multi-step form transitions
- Role card selection animation
- Progress bar animation
- Input focus effects
- Success confetti on completion

LAYOUT:

FULL PAGE:
- Centered card layout
- Background: Dark gradient with animated geometric shapes

REGISTRATION CARD:
- White/dark card (#343a40), centered
- "Create Your Account" heading
- "Join thousands of learners" subheading

STEP INDICATOR (top of card):
- Progress bar or steps:
  * Step 1: Choose Role
  * Step 2: Account Details
  * Step 3: Verification
- Active step: Cyan highlight
- Completed steps: Green checkmark

---

STEP 1: ROLE SELECTION
- "I want to..." heading
- Two large role cards (side-by-side):

  STUDENT CARD:
  - Book icon (large, cyan)
  - "Join as Student" heading
  - "Access courses and learn new skills"
  - Checkmarks with benefits:
    * Watch unlimited courses
    * Earn certificates
    * Track your progress
  - Radio button (selected = cyan border glow)
  - Hover: Lift effect

  INSTRUCTOR CARD:
  - Graduation cap icon (large, blue)
  - "Join as Instructor" heading
  - "Share your knowledge and earn"
  - Checkmarks with benefits:
    * Create and sell courses
    * Earn revenue
    * Build your brand
  - Radio button
  - Hover: Lift effect

- "Continue" button (cyan, large, bottom)

---

STEP 2: ACCOUNT DETAILS
- Form fields (stacked):
  
  * First Name (text input)
  * Last Name (text input)
  * Email Address (email input with validation)
    - Real-time validation: "Email already exists" error
  * Password (password input)
    - Strength indicator bar (weak=red, medium=yellow, strong=green)
    - Show/hide toggle
    - Requirements checklist:
      ✓ At least 8 characters
      ✓ One uppercase letter
      ✓ One number
      ✓ One special character
  * Confirm Password (password input)
    - Real-time match validation

- If INSTRUCTOR selected:
  * Additional fields:
    - Professional Title (text input)
    - Short Bio (textarea, 200 chars)
    - Website/LinkedIn (optional, URL input)

- Terms checkbox:
  * "I agree to the Terms of Service and Privacy Policy" (required)
  * Links open in modal

- "Create Account" button (cyan, full width)
- "Already have an account? Login" link

---

STEP 3: VERIFICATION (optional)
- "Verify Your Email" heading
- Email icon
- Text: "We've sent a verification code to [email]"
- 6-digit code input (large boxes, auto-focus)
- "Verify" button
- "Resend Code" link (countdown timer)

OR

- "Account Created Successfully!" heading
- Success icon (checkmark animation)
- "Welcome to SAS-AI LMS" message
- "Continue to Dashboard" button (cyan)

---

VALIDATION & ERRORS:
- Real-time validation on blur
- Error messages below inputs (red)
- Success checkmarks (green) on valid inputs
- Disabled "Continue" button until valid

MOBILE LAYOUT:
- Single column
- Role cards stacked vertically
- Form fields full width

LOADING STATE:
- Loading spinner on "Create Account" click
- "Creating your account..." with TextShimmer

Make responsive. Include robust validation. Professional, welcoming design. Smooth step transitions. Use 21st.dev components for enhanced inputs and animations.
```

---

### 12. SUPPORT TICKET PAGE (Student)

```
Create a support ticket system for students to submit and track help requests.

DESIGN SYSTEM (SAS-AI):
- Background: #0a0a23
- Cards: #343a40
- Accent: #007bff / #00e5ff
- Text: #f8f9fa / #6c757d
- Fonts: Poppins headings, Roboto body

ANIMATIONS:
- Ticket cards fade in
- Status badge pulse (for "Open" tickets)
- Modal slide animations
- Message send animation

LAYOUT:

1. HEADER:
   - "Support Center" heading
   - "How can we help you?" subheading
   - "Create New Ticket" button (cyan, right)

2. SEARCH & FILTER BAR:
   - Search input: "Search your tickets..."
   - Filter dropdown: All / Open / In Progress / Closed
   - Sort: Newest First / Oldest First

3. TICKET LIST:
   - Ticket cards (list view):
     
     Each card:
     * Left side:
       - Ticket ID: #12345
       - Subject (bold, large)
       - Category badge (Technical / Billing / Course / Other)
       - Date created: "2 days ago"
       - Last updated: "1 hour ago"
     
     * Right side:
       - Status badge:
         * Open (red, pulsing)
         * In Progress (yellow)
         * Closed (green)
       - "View Details" button (outlined)
       - Message count badge: "3 replies"
     
     * Hover: Lift effect, cyan border

   - Empty state: "No tickets found. Create your first ticket to get help."

4. CREATE TICKET MODAL:
   - Opens on "Create New Ticket" click
   - Form:
     * Subject (text input, required)
     * Category (dropdown):
       - Technical Issue
       - Billing Question
       - Course Content
       - Account Issue
       - Other
     * Priority (dropdown):
       - Low
       - Medium
       - High
       - Urgent
     * Description (rich textarea, required)
     * Attachment (file upload, optional)
       - Drag-drop area
       - Supported: PDF, images, ZIP
   - "Submit Ticket" button (cyan)
   - "Cancel" button

5. TICKET DETAIL VIEW:
   - Opens when "View Details" clicked
   - Full-page or modal view

   TOP SECTION:
   - Back button: "← Back to Tickets"
   - Ticket ID + Subject (heading)
   - Status badge (large)
   - Created date + Last updated
   - "Close Ticket" button (if open)

   MESSAGE THREAD:
   - Chronological conversation view
   - Each message:
     * Avatar (student or support agent)
     * Name + role badge
     * Timestamp
     * Message text
     * Attachment download link (if any)
     * Student messages: Right-aligned, cyan background
     * Support messages: Left-aligned, grey background

   REPLY SECTION (bottom):
   - "Add Reply" textarea
   - Attachment button
   - "Send Reply" button (cyan)
   - "Attach File" button
   - Character count

6. FAQ SECTION (below or sidebar):
   - "Frequently Asked Questions" heading
   - Accordion of common questions:
     * "How do I reset my password?"
     * "How do I download a certificate?"
     * "How do I get a refund?"
   - "View All FAQs" link

7. CONTACT OPTIONS (sidebar or bottom):
   - "Need immediate help?" heading
   - Email: support@sas-ai.in (with copy button)
   - Live Chat button (if available)
   - "Average response time: 2 hours" (reassuring)

8. TICKET STATS (top cards):
   - Total Tickets Submitted
   - Open Tickets (red badge)
   - Average Response Time

Make responsive. Include real-time updates if possible (WebSocket for new replies). Professional support interface. Use 21st.dev components for polished UI.
```

---

## Animation Components (CRITICAL - USE AS-IS)

### TextShimmer Component (for all loading states)

**DO NOT MODIFY - Copy exactly as provided in your prompts:**

```tsx
'use client';
import React, { useMemo, type JSX } from 'react';
import { motion } from 'framer-motion';
import { cn } from '@/lib/utils';

interface TextShimmerProps {
  children: string;
  as?: React.ElementType;
  className?: string;
  duration?: number;
  spread?: number;
}

export function TextShimmer({
  children,
  as: Component = 'p',
  className,
  duration = 2,
  spread = 2,
}: TextShimmerProps) {
  const MotionComponent = motion(Component as keyof JSX.IntrinsicElements);
  const dynamicSpread = useMemo(() => {
    return children.length * spread;
  }, [children, spread]);

  return (
    <MotionComponent
      className={cn(
        'relative inline-block bg-[length:250%_100%,auto] bg-clip-text',
        'text-transparent [--base-color:#a1a1aa] [--base-gradient-color:#000]',
        '[--bg:linear-gradient(90deg,#0000_calc(50%-var(--spread)),var(--base-gradient-color),#0000_calc(50%+var(--spread)))] [background-repeat:no-repeat,padding-box]',
        'dark:[--base-color:#71717a] dark:[--base-gradient-color:#ffffff] dark:[--bg:linear-gradient(90deg,#0000_calc(50%-var(--spread)),var(--base-gradient-color),#0000_calc(50%+var(--spread)))]',
        className
      )}
      initial={{ backgroundPosition: '100% center' }}
      animate={{ backgroundPosition: '0% center' }}
      transition={{
        repeat: Infinity,
        duration,
        ease: 'linear',
      }}
      style={
        {
          '--spread': `${dynamicSpread}px`,
          backgroundImage: `var(--bg), linear-gradient(var(--base-color), var(--base-color))`,
        } as React.CSSProperties
      }
    >
      {children}
    </MotionComponent>
  );
}
```

Usage in prompts:
```
For loading states, include:
<TextShimmer className='font-mono text-sm' duration={1}>
  Loading courses...
</TextShimmer>
```

---

### Animated Sidebar Component (for all dashboard layouts)

**DO NOT MODIFY - Reference document 2 exactly**

When creating any dashboard (Student, Instructor, Admin), include in prompt:

```
Use the animated sidebar component from the provided document:
- Hover to expand (60px → 300px)
- Icons from lucide-react
- Smooth animation transitions
- Mobile responsive (collapses to hamburger)
```

---

## Development Workflow with v0 and Claude

### Step-by-Step Process:

1. **Choose a page** from the roadmap (start with Homepage)

2. **Copy the corresponding v0 prompt** from this document

3. **Paste into v0.dev** and generate

4. **Copy the generated code** (HTML/Tailwind)

5. **Open a new chat in Claude** and use this conversion prompt:

```
I have HTML/Tailwind code from v0 that I need to convert for my LMS project.

PROJECT CONTEXT:
- Tech stack: HTML, CSS, Bootstrap 5, JavaScript, PHP, MySQLi
- Design system: SAS-AI colors (use colors from attached DESIGN_SYSTEM.md)
- Database schema: (reference DB_SCHEMA.sql)

CONVERSION TASK:
1. Convert all Tailwind classes to Bootstrap 5 equivalents
2. Create custom CSS for any Tailwind classes without Bootstrap equivalent
3. Ensure responsive design using Bootstrap grid
4. Maintain all animations and interactions
5. Use the SAS-AI color palette

Here is the v0 code:
[PASTE CODE]

Please provide:
1. Converted HTML with Bootstrap classes
2. Custom CSS in <style> block
3. Any JavaScript needed for interactions
```

6. **After frontend conversion**, request backend integration:

```
Now convert this to a functional PHP page:

PAGE: [Student Dashboard / Course Player / etc.]

REQUIREMENTS:
- Include session_start() and authentication check
- Connect to database using PDO
- Fetch relevant data from database (reference DB_SCHEMA.sql)
- Populate HTML with dynamic PHP variables
- Use prepared statements for all queries
- Implement proper error handling

Database tables needed: [list relevant tables]

Please provide the complete .php file.
```

7. **Finally, security hardening**:

```
Review this PHP file for security:

1. Ensure ALL echoed variables use htmlspecialchars()
2. Add CSRF token to any forms
3. Validate all inputs
4. Add error handling
5. Check authentication and authorization
6. Use prepared statements

Please provide the security-hardened version.
```

---

## Project Folder Structure

```
C:/xampp/htdocs/LMS/
│
├── public/
│   ├── index.php (Homepage)
│   ├── courses.php (Catalog)
│   ├── course-detail.php
│   ├── login.php
│   ├── register.php
│   ├── css/
│   │   ├── bootstrap.min.css
│   │   ├── custom.css (SAS-AI theme overrides)
│   │   └── animations.css
│   ├── js/
│   │   ├── bootstrap.bundle.min.js
│   │   ├── jquery.min.js
│   │   └── main.js
│   └── img/
│
├── student/
│   ├── dashboard.php
│   ├── my-courses.php
│   ├── course-player.php
│   ├── assignments.php
│   ├── quizzes.php
│   ├── certificates.php
│   └── support.php
│
├── instructor/
│   ├── dashboard.php
│   ├── course-manager.php
│   ├── course-builder.php
│   ├── students.php
│   ├── analytics.php
│   ├── grading.php
│   └── qa-dashboard.php
│
├── admin/
│   ├── dashboard.php
│   ├── users.php
│   ├── courses.php
│   ├── analytics.php
│   ├── settings.php
│   └── support-tickets.php
│
├── api/
│   ├── login.php
│   ├── register.php
│   ├── courses.php
│   ├── lessons.php
│   └── payments.php
│
├── includes/
│   ├── config.php
│   ├── database.php
│   ├── functions.php
│   ├── auth.php
│   └── header.php / footer.php
│
└── uploads_secure/ (outside public_html)
    ├── videos/
    ├── assignments/
    ├── resources/
    └── certificates/
```

---

## Timeline Estimate

**MVP Development (2-3 months)**:
- Week 1-2: Setup, authentication, database
- Week 3-4: Public pages (homepage, catalog, course detail)
- Week 5-6: Student dashboard and course player
- Week 7-8: Instructor course builder and management
- Week 9-10: Quizzes, assignments, grading
- Week 11-12: Admin panel, payment integration, testing

**Phase 2 (1-2 months)**:
- Advanced features (forums, messaging, live sessions)
- Analytics enhancements
- Third-party integrations
- Performance optimization

---

## Next Steps

1. **Review this roadmap** thoroughly
2. **Set up your development environment** (XAMPP, database)
3. **Start with the homepage** using the v0 prompt provided
4. **Follow the conversion workflow** with Claude
5. **Build page by page** following the feature matrix
6. **Test incrementally** as you build
7. **Deploy to staging server** for client review

---

## Color Reference (Copy-Paste Ready)

```css
/* SAS-AI Design System */
:root {
  /* Primary Colors */
  --primary-bg: #0a0a23;
  --primary-accent: #007bff;
  --highlight: #00e5ff;
  
  /* Secondary Colors */
  --light-text: #f8f9fa;
  --muted-text: #6c757d;
  --card-bg: #343a40;
  
  /* Utility Colors */
  --success: #28a745;
  --danger: #dc3545;
  --warning: #ffc107;
  
  /* Fonts */
  --font-heading: 'Poppins', sans-serif;
  --font-body: 'Roboto', sans-serif;
}
```

---

**END OF ROADMAP**

This comprehensive roadmap covers every aspect of your LMS development. Use the v0 prompts provided, follow the conversion workflow with Claude, and reference this document throughout development.

For questions or clarifications, refer back to this document as your source of truth.

Good luck with your LMS project! 🚀
