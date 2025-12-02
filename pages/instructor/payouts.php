<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Payouts', ['css/dashboard.css', 'css/instructor-dashboard.css', 'css/instructor-pages.css']);
renderNavbar();

// Static data
$payouts = [
    ['id' => 'PO-2024-001', 'date' => '2024-04-01', 'amount' => 1250.00, 'status' => 'paid', 'method' => 'Bank Transfer'],
    ['id' => 'PO-2024-002', 'date' => '2024-03-01', 'amount' => 980.50, 'status' => 'paid', 'method' => 'Bank Transfer'],
    ['id' => 'PO-2024-003', 'date' => '2024-02-01', 'amount' => 1100.00, 'status' => 'paid', 'method' => 'PayPal'],
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('payouts'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Wallet Overview Section -->
        <div class="row mb-4 fade-in-up" style="animation-delay: 0.1s">
            <div class="col-12">
                <div class="balance-card p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-4">
                        <div class="balance-icon-small bg-white-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2);">
                            <i class="bi bi-wallet2 fs-3"></i>
                        </div>
                        <div>
                            <h4 class="text-white-50 mb-1" style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Available Balance</h4>
                            <h2 class="mb-0 fw-bold" style="font-size: 2.5rem;">$3,450.00</h2>
                        </div>
                        <div class="d-none d-md-block border-start border-white-50 mx-3" style="height: 40px;"></div>
                        <div class="d-none d-md-block">
                            <div class="d-flex gap-4 text-white-50">
                                <div>
                                    <small class="d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Min. Payout</small>
                                    <span class="text-white fw-medium">$50.00</span>
                                </div>
                                <div>
                                    <small class="d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Next Payout</small>
                                    <span class="text-white fw-medium">May 01</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-light btn-lg fw-bold text-primary shadow-sm" onclick="requestPayout()" style="border-radius: 10px; padding: 0.75rem 1.5rem;">
                            <i class="bi bi-cash-coin me-2"></i>Request Payout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row fade-in-up" style="animation-delay: 0.2s">
            <!-- Left Column: History (Main Content) -->
            <div class="col-lg-8 mb-4">
                <div class="settings-card h-100">
                    <div class="settings-header d-flex justify-content-between align-items-center border-bottom-0 pb-0">
                        <h3 class="settings-title"><i class="bi bi-clock-history me-2 text-primary"></i>Payout History</h3>
                        <button class="btn btn-light btn-sm text-primary fw-bold border">
                            <i class="bi bi-download me-1"></i> CSV
                        </button>
                    </div>
                    <div class="card-body p-0 mt-3">
                        <table class="admin-table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Payout ID</th>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payouts as $p): ?>
                                <tr>
                                    <td class="ps-4"><span class="font-mono bg-light px-2 py-1 rounded text-dark" style="font-size: 0.85rem;"><?php echo $p['id']; ?></span></td>
                                    <td><?php echo date('M d, Y', strtotime($p['date'])); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-bank text-secondary"></i>
                                            <?php echo $p['method']; ?>
                                        </div>
                                    </td>
                                    <td><strong>$<?php echo number_format($p['amount'], 2); ?></strong></td>
                                    <td>
                                        <span class="status-badge status-published">Paid</span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="ps-4"><span class="font-mono bg-light px-2 py-1 rounded text-dark" style="font-size: 0.85rem;">PO-2024-004</span></td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-bank text-secondary"></i>
                                            Bank Transfer
                                        </div>
                                    </td>
                                    <td><strong>$3,450.00</strong></td>
                                    <td>
                                        <span class="status-badge status-draft">Processing</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings (Sidebar) -->
            <div class="col-lg-4 mb-4">
                <div class="settings-card">
                    <div class="settings-header">
                        <h3 class="settings-title"><i class="bi bi-gear me-2 text-primary"></i>Payout Settings</h3>
                    </div>
                    <div class="settings-body">
                        <form>
                            <div class="form-group mb-3">
                                <label class="form-label">Payout Method</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-credit-card"></i></span>
                                    <select class="form-select border-start-0 ps-0">
                                        <option value="bank">Bank Transfer</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="stripe">Stripe</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="bankDetails">
                                <div class="form-group mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" value="Chase Bank">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" class="form-control" value="**** **** **** 1234">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Routing Number</label>
                                    <input type="text" class="form-control" value="********9">
                                </div>
                            </div>

                            <button type="submit" class="btn-primary w-100 py-2" style="font-weight: 600; letter-spacing: 0.02em;">
                                <i class="bi bi-check2-circle me-2"></i>Update Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
function requestPayout() {
    alert('Payout request submitted successfully! You will receive funds within 3-5 business days.');
}

document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle logic
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('active'));
    }
});
</script>
