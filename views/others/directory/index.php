<?php
// Include settings and helpers
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Menu');

if (!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

include_once '../../../templates/header.php';
include_once '../../../templates/sidebar.php';

// Database connection function
function getDbConnection() {
    global $helpers;
    return $helpers->getConnection();
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type']) && $_POST['action_type'] === 'add_report') {
    $agency = trim($_POST['agency']);
    $barangay_name = trim($_POST['barangay_name']);
    $office_name = trim($_POST['office_name']);
    $contact_number = trim($_POST['contact_number']);

    if (empty($agency) || empty($barangay_name) || empty($office_name) || empty($contact_number)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $conn = getDbConnection();
        $stmt = $conn->prepare("INSERT INTO situational_reports (agency, barangay_name, office_name, contact_number, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $agency, $barangay_name, $office_name, $contact_number);

        if ($stmt->execute()) {
            echo "<script>alert('Report added successfully.');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
    }
}

// Fetch reports for table
function fetchReports() {
    $conn = getDbConnection();
    $sql = "SELECT id, agency, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS created_at FROM situational_reports ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $reports = [];

    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }

    $conn->close();
    return $reports;
}
?>
<style>
    .btn.btn-icon {
        width: 30px;
        height: 30px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .btn-primary {
        background-color: #7d4cd1;
        border-color: #7d4cd1;
    }
    .modal-content {
        background-color: #f9f6ff;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"><?php echo PAGE_TITLE ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo PAGE_TITLE ?></li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <?php echo PAGE_TITLE ?>
                    <span class="float-end">
                        <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add" data-bs-toggle="modal" data-bs-target="#modal-add">
                            <i class="mdi mdi-plus-outline text-info"></i>
                        </button>
                    </span>
                </h4>
                <table class="table" id="tbl-data">
                    <thead>
                        <tr>
                            <th>Agency</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reports = fetchReports();
                        foreach ($reports as $report) {
                            echo "<tr>
                                <td>{$report['agency']}</td>
                                <td>{$report['created_at']}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm' onclick='deleteReport({$report['id']})'>Delete</button>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for adding directory -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Situational Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-crud" method="post">
                        <input type="hidden" name="action_type" value="add_report">
                        <div class="form-group mb-3">
                            <label for="agency">Agency</label>
                            <input type="text" id="agency" name="agency" class="form-control" placeholder="Agency Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="barangay-name">Barangay</label>
                            <input type="text" id="barangay-name" name="barangay_name" class="form-control" placeholder="Barangay Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="office-name">Office</label>
                            <input type="text" id="office-name" name="office_name" class="form-control" placeholder="Office Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" name="contact_number" class="form-control" placeholder="Contact Number">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../../../templates/footer.php';
?>
<script>
    function deleteReport(id) {
        if (confirm('Are you sure you want to delete this report?')) {
            fetch('delete_report.php?id=' + id, { method: 'GET' })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => console.error('Error deleting report:', error));
        }
    }
</script>
