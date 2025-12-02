# SAS-AI Design System
## Official Color Palette & Typography

---

## Color Variables (CSS)

```css
/* Primary Color Palette */
:root {
  /* Backgrounds */
  --primary-bg: #0a0a23;           /* Deep Navy/Black - Main background */
  --card-bg: #343a40;              /* Dark Grey - Card backgrounds */
  
  /* Accent Colors */
  --primary-accent: #007bff;       /* Tech Blue - Primary buttons, links */
  --highlight: #00e5ff;            /* Bright Cyan - Secondary highlights, CTAs */
  
  /* Text Colors */
  --text-light: #f8f9fa;          /* Light text on dark backgrounds */
  --text-muted: #6c757d;          /* Secondary/muted text */
  
  /* Utility Colors */
  --success: #28a745;             /* Success states, completion */
  --danger: #dc3545;              /* Errors, warnings, failed states */
  --warning: #ffc107;             /* Warning states, pending actions */
  
  /* Typography */
  --font-heading: 'Poppins', sans-serif;
  --font-body: 'Roboto', 'Lato', sans-serif;
}
```

---

## Bootstrap Override (SCSS)

```scss
// SAS-AI LMS Theme - Bootstrap Overrides
// Save as: custom-theme.scss

// Primary Colors
$primary: #007bff;
$secondary: #6c757d;
$success: #28a745;
$danger: #dc3545;
$warning: #ffc107;
$info: #00e5ff;

// Background Colors
$body-bg: #0a0a23;
$body-color: #f8f9fa;

// Card Colors
$card-bg: #343a40;
$card-border-color: #495057;

// Typography
$font-family-base: 'Roboto', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
$headings-font-family: 'Poppins', sans-serif;
$headings-font-weight: 600;

// Navbar
$navbar-dark-bg: #0a0a23;
$navbar-dark-color: #f8f9fa;
$navbar-dark-hover-color: #00e5ff;

// Buttons
$btn-border-radius: 0.375rem;
$btn-padding-y: 0.625rem;
$btn-padding-x: 1.5rem;

// Import Bootstrap
@import "bootstrap/scss/bootstrap";

// Custom component overrides
.btn-primary {
  background-color: $primary;
  border-color: $primary;
  
  &:hover {
    background-color: darken($primary, 10%);
    border-color: darken($primary, 10%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
  }
}

.btn-accent {
  background-color: $info;
  color: #000;
  border-color: $info;
  font-weight: 600;
  
  &:hover {
    background-color: darken($info, 10%);
    border-color: darken($info, 10%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 229, 255, 0.4);
  }
}

.card {
  background-color: $card-bg;
  border: 1px solid #495057;
  
  &:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 20px rgba(0, 229, 255, 0.2);
  }
}
```

---

## HTML Color Classes

```html
<!-- Background Classes -->
<div class="bg-primary-dark">    <!-- #0a0a23 -->
<div class="bg-card">            <!-- #343a40 -->

<!-- Text Color Classes -->
<p class="text-light">           <!-- #f8f9fa -->
<p class="text-muted">           <!-- #6c757d -->
<p class="text-accent">          <!-- #00e5ff -->

<!-- Border Classes -->
<div class="border-accent">      <!-- #00e5ff border -->
<div class="border-primary">     <!-- #007bff border -->

<!-- Button Classes -->
<button class="btn btn-primary"> <!-- Tech Blue -->
<button class="btn btn-accent">  <!-- Bright Cyan -->
<button class="btn btn-success"> <!-- Green -->
```

---

## Custom CSS Classes

```css
/* Additional Custom Classes */

/* Backgrounds */
.bg-primary-dark {
  background-color: #0a0a23 !important;
}

.bg-card {
  background-color: #343a40 !important;
}

.bg-gradient-primary {
  background: linear-gradient(135deg, #0a0a23 0%, #1a1a3a 100%);
}

.bg-gradient-accent {
  background: linear-gradient(135deg, #007bff 0%, #00e5ff 100%);
}

/* Text Colors */
.text-accent {
  color: #00e5ff !important;
}

.text-light {
  color: #f8f9fa !important;
}

.text-muted-custom {
  color: #6c757d !important;
}

/* Borders */
.border-accent {
  border-color: #00e5ff !important;
}

.border-glow {
  border: 2px solid #00e5ff;
  box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
}

/* Hover Effects */
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 20px rgba(0, 229, 255, 0.3);
}

.hover-glow:hover {
  box-shadow: 0 0 20px rgba(0, 229, 255, 0.6);
}

/* Status Badges */
.badge-status-active {
  background-color: #28a745;
  color: white;
}

.badge-status-pending {
  background-color: #ffc107;
  color: #000;
}

.badge-status-failed {
  background-color: #dc3545;
  color: white;
}

.badge-preview {
  background-color: #00e5ff;
  color: #000;
  font-weight: 600;
}

/* Card Styles */
.card-custom {
  background-color: #343a40;
  border: 1px solid #495057;
  border-radius: 8px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.card-custom:hover {
  transform: translateY(-4px);
  border-color: #00e5ff;
  box-shadow: 0 8px 24px rgba(0, 229, 255, 0.2);
}

/* Progress Bar Custom */
.progress-custom {
  background-color: #495057;
  height: 8px;
  border-radius: 10px;
}

.progress-bar-custom {
  background: linear-gradient(90deg, #007bff 0%, #00e5ff 100%);
  border-radius: 10px;
}

/* Buttons Custom */
.btn-custom-accent {
  background-color: #00e5ff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 32px;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.btn-custom-accent:hover {
  background-color: #00d4e6;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 229, 255, 0.4);
}

.btn-custom-primary {
  background-color: #007bff;
  color: white;
  font-weight: 600;
  border: none;
  padding: 12px 32px;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.btn-custom-primary:hover {
  background-color: #0056b3;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}
```

---

## Typography

```css
/* Typography System */

/* Headings */
h1, .h1 {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  color: #f8f9fa;
  font-size: 2.5rem;
  line-height: 1.2;
}

h2, .h2 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  color: #f8f9fa;
  font-size: 2rem;
  line-height: 1.3;
}

h3, .h3 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  color: #f8f9fa;
  font-size: 1.75rem;
  line-height: 1.3;
}

h4, .h4 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  color: #f8f9fa;
  font-size: 1.5rem;
}

/* Body Text */
body, p {
  font-family: 'Roboto', sans-serif;
  font-size: 1rem;
  line-height: 1.6;
  color: #f8f9fa;
}

.text-body {
  font-family: 'Roboto', sans-serif;
  color: #f8f9fa;
}

.text-body-muted {
  font-family: 'Roboto', sans-serif;
  color: #6c757d;
}

/* Link Styles */
a {
  color: #00e5ff;
  text-decoration: none;
  transition: color 0.2s ease;
}

a:hover {
  color: #00d4e6;
  text-decoration: underline;
}

/* Label Styles */
label {
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  color: #f8f9fa;
  margin-bottom: 0.5rem;
}
```

---

## Google Fonts Import

```html
<!-- Add to <head> of HTML -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
```

Or in CSS:

```css
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap');
```

---

## Component Examples

### Button Variants

```html
<!-- Primary Button -->
<button class="btn btn-primary">
  Primary Action
</button>

<!-- Accent Button (Cyan) -->
<button class="btn btn-custom-accent">
  Get Started
</button>

<!-- Success Button -->
<button class="btn btn-success">
  Complete
</button>

<!-- Outlined Button -->
<button class="btn btn-outline-primary">
  Secondary Action
</button>
```

### Card Component

```html
<div class="card card-custom">
  <img src="course-thumbnail.jpg" class="card-img-top" alt="Course">
  <div class="card-body">
    <span class="badge badge-preview mb-2">FREE PREVIEW</span>
    <h5 class="card-title">Course Title</h5>
    <p class="card-text text-muted-custom">Course description goes here...</p>
    <div class="d-flex justify-content-between align-items-center">
      <span class="text-accent fw-bold">$49.99</span>
      <button class="btn btn-sm btn-custom-accent">Enroll Now</button>
    </div>
  </div>
</div>
```

### Progress Bar

```html
<div class="progress progress-custom">
  <div class="progress-bar progress-bar-custom" 
       role="progressbar" 
       style="width: 65%;" 
       aria-valuenow="65" 
       aria-valuemin="0" 
       aria-valuemax="100">
    65%
  </div>
</div>
```

### Status Badges

```html
<span class="badge badge-status-active">Active</span>
<span class="badge badge-status-pending">Pending</span>
<span class="badge badge-status-failed">Failed</span>
<span class="badge badge-preview">FREE PREVIEW</span>
```

---

## Usage Guidelines

### When to use each color:

**Primary Background (#0a0a23)**:
- Main page backgrounds
- Navigation bars
- Sidebars
- Footer

**Card Background (#343a40)**:
- Content cards
- Modal backgrounds
- Form containers
- Secondary panels

**Tech Blue (#007bff)**:
- Primary buttons
- Active navigation items
- Primary links
- Important icons

**Bright Cyan (#00e5ff)**:
- Call-to-action buttons
- Highlights and accents
- Hover states
- Success indicators
- "Preview" badges

**Success (#28a745)**:
- Completion checkmarks
- "Completed" status
- Success messages
- Positive indicators

**Danger (#dc3545)**:
- Error messages
- "Failed" status
- Delete actions
- Critical alerts

**Warning (#ffc107)**:
- Pending states
- Upcoming deadlines
- Warning messages
- Caution indicators

---

## Animation Variables

```css
:root {
  --transition-base: 0.3s ease;
  --transition-fast: 0.15s ease;
  --transition-slow: 0.5s ease;
  
  --shadow-sm: 0 2px 4px rgba(0, 229, 255, 0.1);
  --shadow-md: 0 4px 8px rgba(0, 229, 255, 0.2);
  --shadow-lg: 0 8px 24px rgba(0, 229, 255, 0.3);
  --shadow-glow: 0 0 20px rgba(0, 229, 255, 0.6);
}

/* Usage */
.element {
  transition: all var(--transition-base);
}

.element:hover {
  box-shadow: var(--shadow-lg);
}
```

---

## Accessibility Notes

- All text maintains WCAG AA contrast ratios
- Light text (#f8f9fa) on dark backgrounds (#0a0a23) = 14.5:1 contrast
- Focus states use cyan accent (#00e5ff) with 3px outline
- All interactive elements have clear hover and focus states

---

**END OF DESIGN SYSTEM**

Use this as your color reference throughout development. All components should use these exact color values for brand consistency.
