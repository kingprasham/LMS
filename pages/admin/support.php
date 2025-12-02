<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Support Tickets', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('support'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Support Tickets</h1>
                <p class="dashboard-subtitle">Manage and respond to user support requests</p>
            </div>
            <div class="header-actions">
                <select class="form-select" style="width: auto;">
                    <option value="all">All Tickets</option>
                    <option value="open">Open</option>
                    <option value="in-progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid fade-in-up" style="animation-delay: 0.1s">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(239, 68, 68, 0.1);">
                    <i class="bi bi-exclamation-circle-fill" style="color: #ef4444;"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">12</h3>
                    <p class="stat-label">Open Tickets</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                    <i class="bi bi-clock-fill" style="color: #f59e0b;"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">8</h3>
                    <p class="stat-label">In Progress</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                    <i class="bi bi-check-circle-fill" style="color: #10b981;"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">45</h3>
                    <p class="stat-label">Resolved Today</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(79, 70, 229, 0.1);">
                    <i class="bi bi-graph-up" style="color: #4f46e5;"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">2.5h</h3>
                    <p class="stat-label">Avg Response Time</p>
                </div>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="table-card fade-in-up" style="animation-delay: 0.2s">
            <div class="table-header">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search tickets..." class="form-control">
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">High Priority</button>
                    <button class="filter-btn">Unassigned</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="ticket-id">#TKT-1234</span></td>
                            <td>
                                <div class="ticket-subject">
                                    <strong>Cannot access course videos</strong>
                                    <p class="ticket-preview">The video player is not loading for Module 3...</p>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff" alt="User" class="user-avatar-sm">
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td><span class="badge badge-purple">Technical</span></td>
                            <td><span class="priority-badge high">High</span></td>
                            <td><span class="status-badge open">Open</span></td>
                            <td>2 hours ago</td>
                            <td>
                                <button class="btn-icon" onclick="viewTicket(1234)" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Assign">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="ticket-id">#TKT-1233</span></td>
                            <td>
                                <div class="ticket-subject">
                                    <strong>Refund request for course</strong>
                                    <p class="ticket-preview">I would like to request a refund for the AI course...</p>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Wilson&background=10b981&color=fff" alt="User" class="user-avatar-sm">
                                    <span>Sarah Wilson</span>
                                </div>
                            </td>
                            <td><span class="badge badge-green">Billing</span></td>
                            <td><span class="priority-badge medium">Medium</span></td>
                            <td><span class="status-badge in-progress">In Progress</span></td>
                            <td>5 hours ago</td>
                            <td>
                                <button class="btn-icon" onclick="viewTicket(1233)" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Assign">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="ticket-id">#TKT-1232</span></td>
                            <td>
                                <div class="ticket-subject">
                                    <strong>Certificate not generating</strong>
                                    <p class="ticket-preview">Completed all modules but certificate won't download...</p>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=f59e0b&color=fff" alt="User" class="user-avatar-sm">
                                    <span>Mike Johnson</span>
                                </div>
                            </td>
                            <td><span class="badge badge-purple">Technical</span></td>
                            <td><span class="priority-badge high">High</span></td>
                            <td><span class="status-badge open">Open</span></td>
                            <td>1 day ago</td>
                            <td>
                                <button class="btn-icon" onclick="viewTicket(1232)" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Assign">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="ticket-id">#TKT-1231</span></td>
                            <td>
                                <div class="ticket-subject">
                                    <strong>Question about course content</strong>
                                    <p class="ticket-preview">Can you clarify the prerequisites for Module 5?...</p>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=Emily+Brown&background=ec4899&color=fff" alt="User" class="user-avatar-sm">
                                    <span>Emily Brown</span>
                                </div>
                            </td>
                            <td><span class="badge badge-blue">General</span></td>
                            <td><span class="priority-badge low">Low</span></td>
                            <td><span class="status-badge resolved">Resolved</span></td>
                            <td>2 days ago</td>
                            <td>
                                <button class="btn-icon" onclick="viewTicket(1231)" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Assign">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="ticket-id">#TKT-1230</span></td>
                            <td>
                                <div class="ticket-subject">
                                    <strong>Account access issue</strong>
                                    <p class="ticket-preview">Unable to login with my credentials...</p>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=David+Lee&background=0ea5e9&color=fff" alt="User" class="user-avatar-sm">
                                    <span>David Lee</span>
                                </div>
                            </td>
                            <td><span class="badge badge-orange">Account</span></td>
                            <td><span class="priority-badge high">High</span></td>
                            <td><span class="status-badge in-progress">In Progress</span></td>
                            <td>3 days ago</td>
                            <td>
                                <button class="btn-icon" onclick="viewTicket(1230)" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Assign">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <p class="table-info">Showing 1 to 5 of 65 tickets</p>
                <div class="pagination">
                    <button class="pagination-btn" disabled>Previous</button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">Next</button>
                </div>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--bg-card);
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-main);
    margin: 0;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.table-card {
    background: var(--bg-card);
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    overflow: hidden;
}

.table-header {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.search-box {
    position: relative;
    flex: 1;
    min-width: 250px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
}

.search-box input {
    padding-left: 2.5rem;
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: transparent;
    color: var(--text-secondary);
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
}

.filter-btn:hover {
    background: rgba(79, 70, 229, 0.05);
    color: var(--primary);
}

.filter-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    text-align: left;
    padding: 1rem 1.5rem;
    font-weight: 600;
    color: var(--text-secondary);
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.data-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    color: var(--text-main);
}

.data-table tr:hover {
    background: rgba(79, 70, 229, 0.02);
}

.ticket-id {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: var(--primary);
}

.ticket-subject strong {
    display: block;
    margin-bottom: 0.25rem;
}

.ticket-preview {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 300px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-purple { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
.badge-green { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.badge-blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.badge-orange { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

.priority-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.priority-badge.high { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
.priority-badge.medium { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.priority-badge.low { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.open { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
.status-badge.in-progress { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.status-badge.resolved { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.status-badge.closed { background: rgba(100, 116, 139, 0.1); color: #64748b; }

.btn-icon {
    background: rgba(79, 70, 229, 0.1);
    border: 1px solid rgba(79, 70, 229, 0.2);
    color: #4f46e5;
    padding: 0.5rem;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    margin: 0 0.25rem;
}

.btn-icon:hover {
    background: #4f46e5;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
}

.btn-icon i {
    font-size: 1rem;
}

.table-footer {
    padding: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-info {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin: 0;
}

.pagination {
    display: flex;
    gap: 0.5rem;
}

.pagination-btn {
    padding: 0.5rem 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: transparent;
    color: var(--text-main);
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
}

.pagination-btn:hover:not(:disabled) {
    background: rgba(79, 70, 229, 0.05);
    border-color: var(--primary);
}

.pagination-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .table-header {
        flex-direction: column;
        align-items: stretch;
    }

    .search-box {
        width: 100%;
    }

    .filter-buttons {
        overflow-x: auto;
    }
}
</style>

<script>
function viewTicket(ticketId) {
    alert(`Viewing ticket #TKT-${ticketId}\n\n(In production, this would open a detailed ticket view with conversation history and response options)`);
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
