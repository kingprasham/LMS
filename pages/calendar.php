<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Calendar', ['css/dashboard.css', 'css/calendar.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('calendar'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="calendar-container fade-in-up">
            <div class="calendar-header">
                <div>
                    <h1 class="page-title">Calendar</h1>
                    <p class="page-subtitle">Manage your schedule and deadlines</p>
                </div>
                <div class="calendar-actions">
                    <button class="btn-today">Today</button>
                    <div class="month-nav">
                        <button class="nav-btn"><i class="bi bi-chevron-left"></i></button>
                        <span class="current-month">November 2025</span>
                        <button class="nav-btn"><i class="bi bi-chevron-right"></i></button>
                    </div>
                    <button class="btn-add-event"><i class="bi bi-plus-lg"></i> Add Event</button>
                </div>
            </div>

            <div class="calendar-layout">
                <div class="calendar-grid">
                    <!-- Weekdays -->
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>

                    <!-- Days -->
                    <!-- Previous Month Days -->
                    <div class="day prev-month">27</div>
                    <div class="day prev-month">28</div>
                    <div class="day prev-month">29</div>
                    <div class="day prev-month">30</div>
                    <div class="day prev-month">31</div>
                    
                    <!-- Current Month Days -->
                    <div class="day">1</div>
                    <div class="day">2</div>
                    <div class="day">3
                        <div class="event event-purple">Python Quiz</div>
                    </div>
                    <div class="day">4</div>
                    <div class="day">5</div>
                    <div class="day">6</div>
                    <div class="day">7</div>
                    <div class="day">8</div>
                    <div class="day">9</div>
                    <div class="day">10
                        <div class="event event-blue">AI Workshop</div>
                    </div>
                    <div class="day">11</div>
                    <div class="day">12</div>
                    <div class="day">13</div>
                    <div class="day">14</div>
                    <div class="day">15
                        <div class="event event-green">Project Due</div>
                    </div>
                    <div class="day">16</div>
                    <div class="day">17</div>
                    <div class="day">18</div>
                    <div class="day">19</div>
                    <div class="day active">20</div>
                    <div class="day">21</div>
                    <div class="day">22</div>
                    <div class="day">23</div>
                    <div class="day">24
                        <div class="event event-orange">Live Class</div>
                    </div>
                    <div class="day">25</div>
                    <div class="day">26</div>
                    <div class="day">27</div>
                    <div class="day">28</div>
                    <div class="day">29</div>
                    <div class="day">30</div>
                </div>

                <div class="upcoming-sidebar">
                    <h3 class="sidebar-title">Upcoming Events</h3>
                    <div class="upcoming-list">
                        <div class="upcoming-item">
                            <div class="date-box">
                                <span class="d-day">20</span>
                                <span class="d-month">Nov</span>
                            </div>
                            <div class="event-info">
                                <h4>Today</h4>
                                <p>No events scheduled</p>
                            </div>
                        </div>

                        <div class="upcoming-item">
                            <div class="date-box">
                                <span class="d-day">24</span>
                                <span class="d-month">Nov</span>
                            </div>
                            <div class="event-info">
                                <h4>Live Class: ML Basics</h4>
                                <p>10:00 AM - 11:30 AM</p>
                                <span class="tag orange">Live</span>
                            </div>
                        </div>

                        <div class="upcoming-item">
                            <div class="date-box">
                                <span class="d-day">02</span>
                                <span class="d-month">Dec</span>
                            </div>
                            <div class="event-info">
                                <h4>Final Assessment</h4>
                                <p>All Day</p>
                                <span class="tag purple">Exam</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
