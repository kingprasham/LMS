<?php
/**
 * Data Functions for LMS
 *
 * ===================================================================================
 * IMPORTANT: This file contains all static data for the Learning Management System.
 * When migrating to a database, ONLY modify the internal logic of these functions.
 * Do NOT change the function signatures or return data structures.
 * ===================================================================================
 *
 * Purpose:
 * - Centralize all course, quiz, and assignment data
 * - Provide consistent data access across all pages
 * - Make database migration easier (change only this file, not every page)
 * - Ensure data consistency throughout the application
 *
 * Migration Guide (Static → Database):
 * 1. Keep all function names and parameters the same
 * 2. Replace static arrays with database queries
 * 3. Maintain the exact same return data structure
 * 4. Add proper error handling for database connections
 *
 * Example Migration:
 * Before (Static):
 *   function getCourseById($id) {
 *       $courses = [...static array...];
 *       return $courses[$id] ?? null;
 *   }
 *
 * After (Database):
 *   function getCourseById($id) {
 *       global $db;
 *       $stmt = $db->prepare("SELECT * FROM courses WHERE id = ?");
 *       $stmt->execute([$id]);
 *       return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
 *   }
 *
 * Functions:
 * - getAllCourses() - Returns all available courses with full details
 * - getCourseById($id) - Returns a specific course by ID
 * - getCourseQuizzes($course_id) - Returns all quizzes for a specific course
 * - getCourseAssignments($course_id) - Returns all assignments for a specific course
 * - getCourseModules($course_id) - Returns modules and lessons for course viewer page
 * - getCoursesWithQuizStats() - Returns courses with aggregated quiz statistics
 * - getCoursesWithAssignmentStats() - Returns courses with aggregated assignment statistics
 * - getDaysUntilDue($due_date) - Calculates days until assignment due date
 */

/**
 * Get all available courses
 *
 * Returns a comprehensive list of all courses with complete details.
 * Used by: dashboard.php, my-courses.php, course-card.php
 *
 * @return array Associative array indexed by course ID containing:
 *               - id: Course ID (int)
 *               - title: Course name (string)
 *               - instructor: Instructor name (string)
 *               - image: Course thumbnail URL (string)
 *               - category: Course category (string)
 *               - rating: Course rating 0-5 (float)
 *               - students: Number of enrolled students (int)
 *               - lessons: Total number of lessons (int)
 *               - duration: Course duration (string)
 *               - level: Difficulty level (string)
 *               - price: Course price in USD (int)
 *               - description: Short description (string)
 *               - progress: Student progress 0-100 (int)
 */
function getAllCourses() {
    return [
        1 => [
            'id' => 1,
            'title' => 'AI in Drug Discovery',
            'instructor' => 'Dr. Sarah Johnson',
            'image' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
            'category' => 'Generative AI',
            'rating' => 4.8,
            'students' => 2847,
            'lessons' => 45,
            'duration' => '12 weeks',
            'level' => 'Intermediate',
            'price' => 199,
            'description' => 'Learn how AI is revolutionizing drug discovery and development',
            'progress' => 68
        ],
        2 => [
            'id' => 2,
            'title' => 'Machine Learning for Healthcare',
            'instructor' => 'Prof. Michael Chen',
            'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop',
            'category' => 'Machine Learning',
            'rating' => 4.9,
            'students' => 3421,
            'lessons' => 52,
            'duration' => '14 weeks',
            'level' => 'Advanced',
            'price' => 249,
            'description' => 'Advanced machine learning techniques for healthcare applications',
            'progress' => 45
        ],
        3 => [
            'id' => 3,
            'title' => 'Deep Learning in Medical Imaging',
            'instructor' => 'Dr. Emily Rodriguez',
            'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
            'category' => 'Deep Learning',
            'rating' => 4.7,
            'students' => 1893,
            'lessons' => 38,
            'duration' => '10 weeks',
            'level' => 'Intermediate',
            'price' => 179,
            'description' => 'Master deep learning techniques for medical image analysis',
            'progress' => 82
        ]
    ];
}

/**
 * Get a specific course by ID
 * @param int $id Course ID
 * @return array|null Course data or null if not found
 */
function getCourseById($id) {
    $courses = getAllCourses();
    return $courses[$id] ?? null;
}

/**
 * Get all quizzes for a specific course
 *
 * Returns all quizzes associated with a course, including completion status.
 * Used by: quiz.php
 *
 * @param int $course_id Course ID
 * @return array Array of quiz objects containing:
 *               - id: Quiz ID (int)
 *               - title: Quiz title (string)
 *               - questions: Number of questions (int)
 *               - duration: Time limit in minutes (int)
 *               - score: Student's score percentage or null if not completed (int|null)
 *               - status: 'completed', 'pending', or 'locked' (string)
 */
function getCourseQuizzes($course_id) {
    $quizzes = [
        1 => [
            ['id' => 1, 'title' => 'Introduction to AI Basics', 'questions' => 10, 'duration' => 30, 'score' => 85, 'status' => 'completed'],
            ['id' => 2, 'title' => 'Generative Models Fundamentals', 'questions' => 15, 'duration' => 45, 'score' => null, 'status' => 'pending'],
            ['id' => 3, 'title' => 'VAE and GANs', 'questions' => 12, 'duration' => 40, 'score' => 92, 'status' => 'completed'],
            ['id' => 4, 'title' => 'Drug Discovery Applications', 'questions' => 20, 'duration' => 60, 'score' => null, 'status' => 'locked'],
            ['id' => 5, 'title' => 'Final Assessment', 'questions' => 25, 'duration' => 90, 'score' => null, 'status' => 'locked'],
        ],
        2 => [
            ['id' => 1, 'title' => 'ML Basics Quiz', 'questions' => 10, 'duration' => 30, 'score' => 78, 'status' => 'completed'],
            ['id' => 2, 'title' => 'Healthcare Data Analysis', 'questions' => 15, 'duration' => 45, 'score' => null, 'status' => 'pending'],
            ['id' => 3, 'title' => 'Predictive Modeling', 'questions' => 12, 'duration' => 40, 'score' => null, 'status' => 'pending'],
            ['id' => 4, 'title' => 'Final Exam', 'questions' => 30, 'duration' => 120, 'score' => null, 'status' => 'locked'],
        ],
        3 => [
            ['id' => 1, 'title' => 'Deep Learning Introduction', 'questions' => 10, 'duration' => 30, 'score' => 95, 'status' => 'completed'],
            ['id' => 2, 'title' => 'CNN Architectures', 'questions' => 15, 'duration' => 45, 'score' => 88, 'status' => 'completed'],
            ['id' => 3, 'title' => 'Medical Image Analysis', 'questions' => 18, 'duration' => 50, 'score' => 94, 'status' => 'completed'],
            ['id' => 4, 'title' => 'Advanced Techniques', 'questions' => 20, 'duration' => 60, 'score' => 90, 'status' => 'completed'],
            ['id' => 5, 'title' => 'Capstone Quiz', 'questions' => 25, 'duration' => 90, 'score' => null, 'status' => 'pending'],
            ['id' => 6, 'title' => 'Final Certification Exam', 'questions' => 40, 'duration' => 150, 'score' => null, 'status' => 'locked'],
        ]
    ];

    return $quizzes[$course_id] ?? [];
}

/**
 * Get all assignments for a specific course
 *
 * Returns all assignments for a course with due dates and grading information.
 * Used by: assignment.php
 *
 * @param int $course_id Course ID
 * @return array Array of assignment objects containing:
 *               - id: Assignment ID (int)
 *               - title: Assignment title (string)
 *               - due_date: Due date in YYYY-MM-DD format (string)
 *               - status: 'submitted', 'pending', or 'locked' (string)
 *               - grade: Student's grade or null if not graded (int|null)
 *               - max_points: Maximum possible points (int)
 */
function getCourseAssignments($course_id) {
    $assignments = [
        1 => [
            ['id' => 1, 'title' => 'AI Fundamentals Report', 'due_date' => '2025-12-01', 'status' => 'submitted', 'grade' => 88, 'max_points' => 100],
            ['id' => 2, 'title' => 'Generative Model Implementation', 'due_date' => '2025-12-08', 'status' => 'pending', 'grade' => null, 'max_points' => 150],
            ['id' => 3, 'title' => 'Drug Discovery Case Study', 'due_date' => '2025-12-15', 'status' => 'pending', 'grade' => null, 'max_points' => 200],
            ['id' => 4, 'title' => 'Final Project Presentation', 'due_date' => '2025-12-22', 'status' => 'locked', 'grade' => null, 'max_points' => 250],
        ],
        2 => [
            ['id' => 1, 'title' => 'Healthcare Data Analysis', 'due_date' => '2025-11-28', 'status' => 'submitted', 'grade' => 82, 'max_points' => 100],
            ['id' => 2, 'title' => 'ML Model Training', 'due_date' => '2025-12-05', 'status' => 'submitted', 'grade' => 78, 'max_points' => 150],
            ['id' => 3, 'title' => 'Predictive Analytics Project', 'due_date' => '2025-12-12', 'status' => 'pending', 'grade' => null, 'max_points' => 200],
            ['id' => 4, 'title' => 'Research Paper', 'due_date' => '2025-12-19', 'status' => 'pending', 'grade' => null, 'max_points' => 200],
            ['id' => 5, 'title' => 'Final Capstone Project', 'due_date' => '2025-12-26', 'status' => 'locked', 'grade' => null, 'max_points' => 300],
        ],
        3 => [
            ['id' => 1, 'title' => 'CNN Architecture Design', 'due_date' => '2025-11-25', 'status' => 'submitted', 'grade' => 95, 'max_points' => 100],
            ['id' => 2, 'title' => 'Medical Image Segmentation', 'due_date' => '2025-12-02', 'status' => 'submitted', 'grade' => 92, 'max_points' => 150],
            ['id' => 3, 'title' => 'Transfer Learning Implementation', 'due_date' => '2025-12-09', 'status' => 'submitted', 'grade' => 94, 'max_points' => 150],
            ['id' => 4, 'title' => 'Custom Model Development', 'due_date' => '2025-12-16', 'status' => 'submitted', 'grade' => 90, 'max_points' => 200],
            ['id' => 5, 'title' => 'Advanced Techniques Paper', 'due_date' => '2025-12-20', 'status' => 'pending', 'grade' => null, 'max_points' => 200],
            ['id' => 6, 'title' => 'Final Thesis Project', 'due_date' => '2025-12-30', 'status' => 'locked', 'grade' => null, 'max_points' => 400],
        ]
    ];

    return $assignments[$course_id] ?? [];
}

/**
 * Get course modules and lessons for course viewer
 *
 * Returns the complete course structure with modules, lessons, and content.
 * Used by: course-view.php (the main course player page)
 *
 * @param int $course_id Course ID
 * @return array Array of module objects containing:
 *               - id: Module ID (int)
 *               - title: Module title (string)
 *               - lessons: Array of lesson objects:
 *                   - id: Lesson ID (int)
 *                   - title: Lesson title (string)
 *                   - duration: Duration or deadline (string)
 *                   - type: 'video', 'quiz', 'assignment', or 'certificate' (string)
 *                   - video_id: YouTube video ID (string, only for type='video')
 *                   - quiz_id: Quiz ID (int, only for type='quiz')
 *                   - assignment_id: Assignment ID (int, only for type='assignment')
 *                   - completed: Whether student completed this lesson (bool)
 */
function getCourseModules($course_id) {
    $modules = [
        1 => [
            [
                'id' => 1,
                'title' => 'Introduction to AI in Drug Discovery',
                'lessons' => [
                    ['id' => 1, 'title' => 'Welcome to the Course', 'duration' => '5m', 'type' => 'video', 'video_id' => 'dQw4w9WgXcQ', 'completed' => true],
                    ['id' => 2, 'title' => 'Introduction to Generative Models', 'duration' => '10m', 'type' => 'video', 'video_id' => 'aircAruvnKk', 'completed' => false],
                    ['id' => 3, 'title' => 'AI in Healthcare Overview', 'duration' => '15m', 'type' => 'video', 'video_id' => 'R9OHn5ZF4Uo', 'completed' => false],
                    ['id' => 4, 'title' => 'Module 1 Quiz', 'duration' => '20m', 'type' => 'quiz', 'completed' => false]
                ]
            ],
            [
                'id' => 2,
                'title' => 'Fundamentals of Machine Learning',
                'lessons' => [
                    ['id' => 5, 'title' => 'Supervised Learning Basics', 'duration' => '12m', 'type' => 'video', 'video_id' => 'ujBiM9stPHU', 'completed' => false],
                    ['id' => 6, 'title' => 'Unsupervised Learning Methods', 'duration' => '18m', 'type' => 'video', 'video_id' => 'IHZwWFHWa-w', 'completed' => false],
                    ['id' => 7, 'title' => 'Neural Networks Introduction', 'duration' => '25m', 'type' => 'video', 'video_id' => 'CqOfi41LfDw', 'completed' => false],
                    ['id' => 8, 'title' => 'Hands-on Lab: Build Your First Model', 'duration' => '45m', 'type' => 'assignment', 'completed' => false]
                ]
            ],
            [
                'id' => 3,
                'title' => 'Deep Learning for Drug Discovery',
                'lessons' => [
                    ['id' => 9, 'title' => 'Molecular Representation', 'duration' => '20m', 'type' => 'video', 'video_id' => 'FfPvn3OCB5M', 'completed' => false],
                    ['id' => 10, 'title' => 'Graph Neural Networks', 'duration' => '30m', 'type' => 'video', 'video_id' => 'zCEYiCxrL_0', 'completed' => false],
                    ['id' => 11, 'title' => 'Protein Structure Prediction', 'duration' => '22m', 'type' => 'video', 'video_id' => 'W7wJDJ56c88', 'completed' => false],
                    ['id' => 12, 'title' => 'Module 3 Quiz', 'duration' => '25m', 'type' => 'quiz', 'completed' => false]
                ]
            ],
            [
                'id' => 4,
                'title' => 'Final Project',
                'lessons' => [
                    ['id' => 13, 'title' => 'Project Guidelines', 'duration' => '10m', 'type' => 'video', 'video_id' => 'wnHW6o8WMas', 'completed' => false],
                    ['id' => 14, 'title' => 'Final Project Submission', 'duration' => '120m', 'type' => 'assignment', 'completed' => false],
                    ['id' => 15, 'title' => 'Course Certificate', 'duration' => '5m', 'type' => 'certificate', 'completed' => false]
                ]
            ]
        ],
        2 => [
            [
                'id' => 1,
                'title' => 'Healthcare Data Analytics',
                'lessons' => [
                    ['id' => 1, 'title' => 'Introduction to Healthcare Data', 'duration' => '8m', 'type' => 'video', 'video_id' => 'dQw4w9WgXcQ', 'completed' => true],
                    ['id' => 2, 'title' => 'Data Preprocessing Techniques', 'duration' => '15m', 'type' => 'video', 'video_id' => 'aircAruvnKk', 'completed' => false],
                    ['id' => 3, 'title' => 'Module Quiz', 'duration' => '20m', 'type' => 'quiz', 'completed' => false]
                ]
            ],
            [
                'id' => 2,
                'title' => 'Predictive Modeling',
                'lessons' => [
                    ['id' => 4, 'title' => 'Regression Models', 'duration' => '20m', 'type' => 'video', 'video_id' => 'ujBiM9stPHU', 'completed' => false],
                    ['id' => 5, 'title' => 'Classification Algorithms', 'duration' => '25m', 'type' => 'video', 'video_id' => 'IHZwWFHWa-w', 'completed' => false],
                    ['id' => 6, 'title' => 'Model Evaluation', 'duration' => '18m', 'type' => 'video', 'video_id' => 'CqOfi41LfDw', 'completed' => false]
                ]
            ]
        ],
        3 => [
            [
                'id' => 1,
                'title' => 'CNN Fundamentals',
                'lessons' => [
                    ['id' => 1, 'title' => 'Convolutional Layers', 'duration' => '12m', 'type' => 'video', 'video_id' => 'dQw4w9WgXcQ', 'completed' => true],
                    ['id' => 2, 'title' => 'Pooling and Activation', 'duration' => '10m', 'type' => 'video', 'video_id' => 'aircAruvnKk', 'completed' => false],
                    ['id' => 3, 'title' => 'Quiz: CNN Basics', 'duration' => '15m', 'type' => 'quiz', 'completed' => false]
                ]
            ],
            [
                'id' => 2,
                'title' => 'Medical Image Processing',
                'lessons' => [
                    ['id' => 4, 'title' => 'Image Segmentation', 'duration' => '22m', 'type' => 'video', 'video_id' => 'ujBiM9stPHU', 'completed' => false],
                    ['id' => 5, 'title' => 'Object Detection in Medical Images', 'duration' => '28m', 'type' => 'video', 'video_id' => 'IHZwWFHWa-w', 'completed' => false]
                ]
            ]
        ]
    ];

    return $modules[$course_id] ?? [];
}

/**
 * Get courses with quiz statistics for quizzes listing page
 *
 * Returns courses with aggregated quiz data for display on quizzes overview.
 * Used by: quizzes.php
 *
 * @return array Array of course objects with quiz statistics containing:
 *               - id: Course ID (int)
 *               - title: Course name (string)
 *               - image: Course thumbnail URL (string)
 *               - category: Course category (string)
 *               - instructor: Instructor name (string)
 *               - total_quizzes: Total number of quizzes (int)
 *               - completed_quizzes: Number of completed quizzes (int)
 *               - pending_quizzes: Number of pending quizzes (int)
 *               - average_score: Average score across all completed quizzes (int)
 */
function getCoursesWithQuizStats() {
    return [
        [
            'id' => 1,
            'title' => 'AI in Drug Discovery',
            'image' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
            'category' => 'Generative AI',
            'instructor' => 'Dr. Sarah Johnson',
            'total_quizzes' => 5,
            'completed_quizzes' => 3,
            'pending_quizzes' => 2,
            'average_score' => 85
        ],
        [
            'id' => 2,
            'title' => 'Machine Learning for Healthcare',
            'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop',
            'category' => 'Machine Learning',
            'instructor' => 'Prof. Michael Chen',
            'total_quizzes' => 4,
            'completed_quizzes' => 2,
            'pending_quizzes' => 2,
            'average_score' => 78
        ],
        [
            'id' => 3,
            'title' => 'Deep Learning in Medical Imaging',
            'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
            'category' => 'Deep Learning',
            'instructor' => 'Dr. Emily Rodriguez',
            'total_quizzes' => 6,
            'completed_quizzes' => 5,
            'pending_quizzes' => 1,
            'average_score' => 92
        ]
    ];
}

/**
 * Get courses with assignment statistics for assignments listing page
 *
 * Returns courses with aggregated assignment data for display on assignments overview.
 * Used by: assignments.php
 *
 * @return array Array of course objects with assignment statistics containing:
 *               - id: Course ID (int)
 *               - title: Course name (string)
 *               - image: Course thumbnail URL (string)
 *               - category: Course category (string)
 *               - instructor: Instructor name (string)
 *               - total_assignments: Total number of assignments (int)
 *               - submitted: Number of submitted assignments (int)
 *               - pending: Number of pending assignments (int)
 *               - due_soon: Number of assignments due within 3 days (int)
 *               - average_grade: Average grade across all graded assignments (int)
 */
function getCoursesWithAssignmentStats() {
    return [
        [
            'id' => 1,
            'title' => 'AI in Drug Discovery',
            'image' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
            'category' => 'Generative AI',
            'instructor' => 'Dr. Sarah Johnson',
            'total_assignments' => 4,
            'submitted' => 2,
            'pending' => 2,
            'due_soon' => 1,
            'average_grade' => 88
        ],
        [
            'id' => 2,
            'title' => 'Machine Learning for Healthcare',
            'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop',
            'category' => 'Machine Learning',
            'instructor' => 'Prof. Michael Chen',
            'total_assignments' => 5,
            'submitted' => 3,
            'pending' => 2,
            'due_soon' => 0,
            'average_grade' => 82
        ],
        [
            'id' => 3,
            'title' => 'Deep Learning in Medical Imaging',
            'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
            'category' => 'Deep Learning',
            'instructor' => 'Dr. Emily Rodriguez',
            'total_assignments' => 6,
            'submitted' => 5,
            'pending' => 1,
            'due_soon' => 1,
            'average_grade' => 94
        ]
    ];
}

/**
 * Calculate days until due date
 *
 * Utility function to calculate how many days remain until an assignment is due.
 * Used by: assignment.php to display urgency warnings
 *
 * @param string $due_date Due date in YYYY-MM-DD format
 * @return int Number of days remaining (negative if overdue, 0 if due today)
 *
 * Examples:
 * - getDaysUntilDue('2025-12-25') on 2025-12-20 returns 5
 * - getDaysUntilDue('2025-12-20') on 2025-12-20 returns 0 (due today)
 * - getDaysUntilDue('2025-12-15') on 2025-12-20 returns -5 (overdue)
 */
function getDaysUntilDue($due_date) {
    $now = new DateTime();
    $due = new DateTime($due_date);
    $diff = $now->diff($due);
    $days = $diff->days;
    if ($now > $due) {
        return -$days;
    }
    return $days;
}
?>
