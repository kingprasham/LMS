# SAS-AI Learning Management System (LMS)

## 🎯 Project Overview

A comprehensive, production-ready Learning Management System built with PHP, MySQL, JavaScript, and Bootstrap. Designed to handle **1000+ concurrent users** with 4 distinct user roles and extensive features for online education delivery.

**Parent Company**: SAS-AI (https://sas-ai.in)

---

## 📋 Quick Navigation

### **For Developers**
- [Development Roadmap](docs/internal/DEVELOPMENT_ROADMAP.md) - Complete module breakdown and timeline
- [Technical Architecture](docs/technical/TECHNICAL_ARCHITECTURE.md) - System design and infrastructure
- [Database Schema](docs/technical/DATABASE_SCHEMA.md) - Complete database structure
- [Security Implementation](docs/technical/SECURITY_GUIDE.md) - Security best practices
- [AI Prompts Library](docs/prompts/AI_PROMPTS_MASTER.md) - All Claude and v0 prompts
- [Module Breakdown](docs/internal/MODULE_BREAKDOWN.md) - Individual module specifications

### **For Clients**
- [Project Proposal](docs/client/PROJECT_PROPOSAL.md) - Executive summary and timeline
- [User Guide](docs/client/USER_GUIDE.md) - How to use the system
- [Admin Manual](docs/client/ADMIN_MANUAL.md) - Administration guide
- [Feature List](docs/client/FEATURE_LIST.md) - Complete feature documentation

### **For Deployment**
- [Deployment Guide](docs/technical/DEPLOYMENT_GUIDE.md) - Server setup and deployment
- [Testing Strategy](docs/technical/TESTING_STRATEGY.md) - QA and testing protocols
- [Maintenance Guide](docs/technical/MAINTENANCE_GUIDE.md) - Ongoing maintenance

---

## 🏗️ Tech Stack

| Component | Technology |
|-----------|------------|
| **Frontend** | HTML5, CSS3, JavaScript (ES6+), Bootstrap 5 |
| **Backend** | PHP 8.x, MySQLi |
| **Database** | MySQL 8.0+ |
| **Video Hosting** | YouTube Private API |
| **Server** | Apache (LAMP Stack) |
| **Caching** | Redis (Optional for production) |
| **Version Control** | Git |

---

## 👥 User Roles

1. **Student** - Course enrollment, learning, assignments, quizzes, certificates
2. **Trainer/Instructor** - Course creation, content management, student grading, analytics
3. **Employee** - Support, content moderation, billing, operational tasks
4. **Super Admin** - Full system control, user management, platform configuration

---

## 📊 System Capacity

- **Concurrent Users**: 1000+
- **Database**: Optimized for 10,000+ enrolled users
- **Video Delivery**: YouTube Private API (unlimited bandwidth)
- **Scalability**: Horizontal scaling ready

---

## ⚡ Key Features

### Student Dashboard
✅ Course enrollment and progress tracking  
✅ Video lessons with YouTube integration  
✅ Assignments and quizzes with auto-grading  
✅ Certificate generation and download  
✅ Payment and billing management  
✅ Calendar with deadlines and events  

### Trainer Dashboard
✅ Course creation and content management  
✅ Student roster and progress analytics  
✅ Assignment grading with rubrics  
✅ Live session scheduling  
✅ Resource upload and management  
✅ Certificate criteria configuration  

### Employee Dashboard
✅ Support ticket management  
✅ Content approval workflows  
✅ User support and impersonation  
✅ Billing and finance operations  
✅ Quality assurance tools  

### Super Admin Dashboard
✅ Complete user and role management  
✅ System-wide analytics and monitoring  
✅ Platform configuration and settings  
✅ Security and compliance tools  
✅ Audit logs and reporting  

---

## 📁 Project Structure

```
LMS/
├── assets/                 # Frontend assets
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── img/               # Images
│   └── fonts/             # Custom fonts
├── config/                # Configuration files
│   ├── database.php       # Database connection
│   ├── config.php         # App configuration
│   └── youtube_api.php    # YouTube API config
├── database/              # Database files
│   ├── schema.sql         # Database structure
│   ├── migrations/        # Database migrations
│   └── seeders/           # Sample data
├── modules/               # Application modules
│   ├── auth/              # Authentication
│   ├── student/           # Student module
│   ├── trainer/           # Trainer module
│   ├── employee/          # Employee module
│   ├── admin/             # Admin module
│   └── common/            # Shared components
├── docs/                  # Documentation
│   ├── client/            # Client-facing docs
│   ├── internal/          # Internal dev docs
│   ├── technical/         # Technical specs
│   └── prompts/           # AI prompts
├── public/                # Public web root
├── uploads/               # User uploads
├── tests/                 # Testing files
└── vendor/                # Third-party libraries
```

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Composer (optional)
- YouTube Data API v3 credentials

### Installation

1. **Clone/Download the project**
   ```bash
   # Project is located at C:\xampp\htdocs\LMS
   ```

2. **Import Database**
   ```bash
   mysql -u root -p < database/schema.sql
   ```

3. **Configure Settings**
   - Copy `config/config.example.php` to `config/config.php`
   - Update database credentials
   - Add YouTube API keys

4. **Set Permissions**
   ```bash
   chmod 755 uploads/
   chmod 755 assets/
   ```

5. **Access Application**
   - Open browser: `http://localhost/LMS`
   - Default admin: admin@sas-ai.in / Admin@123

---

## 📅 Development Timeline

| Phase | Duration | Status |
|-------|----------|--------|
| **Phase 1**: Authentication & Core | 3-4 weeks | Pending |
| **Phase 2**: Student Dashboard | 6-8 weeks | Pending |
| **Phase 3**: Trainer Dashboard | 6-8 weeks | Pending |
| **Phase 4**: Employee Dashboard | 4-5 weeks | Pending |
| **Phase 5**: Admin Dashboard | 3-4 weeks | Pending |
| **Phase 6**: Testing & QA | 3-4 weeks | Pending |
| **Phase 7**: Deployment | 1-2 weeks | Pending |

**Total Timeline**: 6-7 months (Client estimate: 8-9 months with buffer)

---

## 🔒 Security Features

- ✅ Password hashing with bcrypt
- ✅ SQL injection prevention (Prepared statements)
- ✅ XSS protection
- ✅ CSRF tokens
- ✅ Role-based access control (RBAC)
- ✅ Secure session management
- ✅ File upload validation
- ✅ API rate limiting

---

## 📞 Support

**Developer**: Prasham Mehta  
**Company**: AiCureAcademy  
**Email**: support@aicureacademy.com  
**Website**: https://aicureacademy.com  

---

## 📝 License

Proprietary - AiCureAcademy © 2025. All rights reserved.

---

## 🎨 Design Theme

The application follows the AiCureAcademy color scheme:
- Primary: #1a237e (Deep Blue)
- Secondary: #00bcd4 (Cyan)
- Accent: #ff6f00 (Orange)
- Background: #f5f5f5 (Light Gray)
- Text: #212121 (Dark Gray)

---

## 📚 Documentation Index

| Document | Purpose | Audience |
|----------|---------|----------|
| [Development Roadmap](docs/internal/DEVELOPMENT_ROADMAP.md) | Complete development plan | Developers |
| [Module Breakdown](docs/internal/MODULE_BREAKDOWN.md) | Individual module specs | Developers |
| [AI Prompts](docs/prompts/AI_PROMPTS_MASTER.md) | Claude/v0 prompts | Developers |
| [Technical Architecture](docs/technical/TECHNICAL_ARCHITECTURE.md) | System design | Developers/Architects |
| [Database Schema](docs/technical/DATABASE_SCHEMA.md) | Database structure | Developers/DBAs |
| [Security Guide](docs/technical/SECURITY_GUIDE.md) | Security implementation | Developers |
| [API Documentation](docs/technical/API_DOCUMENTATION.md) | API endpoints | Developers |
| [Deployment Guide](docs/technical/DEPLOYMENT_GUIDE.md) | Server deployment | DevOps |
| [Testing Strategy](docs/technical/TESTING_STRATEGY.md) | QA procedures | QA Team |
| [Project Proposal](docs/client/PROJECT_PROPOSAL.md) | Executive summary | Client |
| [User Guide](docs/client/USER_GUIDE.md) | End-user instructions | Client/Users |
| [Admin Manual](docs/client/ADMIN_MANUAL.md) | Admin instructions | Client/Admins |

---

**Last Updated**: November 2025  
**Version**: 1.0.0  
**Status**: In Development
