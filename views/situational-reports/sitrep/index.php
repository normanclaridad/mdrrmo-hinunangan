<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Incident System - MDRRMO Hinunangan</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link href="http://mdrrmo-hinunangan.test/assets/vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/css/parsley.css">
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/css/select2.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="http://mdrrmo-hinunangan.test/assets/css/style.css">
    <!-- End layout styles -->
    <script src="http://mdrrmo-hinunangan.test/assets/js/jquery-3.7.1.min.js"></script>
    <link rel="shortcut icon" href="http://mdrrmo-hinunangan.test/assets/images/favicon.png" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="http://mdrrmo-hinunangan.test/"><img src="http://mdrrmo-hinunangan.test/assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="http://mdrrmo-hinunangan.test/"><img src="http://mdrrmo-hinunangan.test/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">            
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="http://mdrrmo-hinunangan.test/assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="http://mdrrmo-hinunangan.test/assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-cog"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="http://mdrrmo-hinunangan.test/assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Admin Admin</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://mdrrmo-hinunangan.test/log-out.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav><!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">                
                                            <li class="nav-item " data-active-keyword="home|/views/situational-reports/schools/index.php">
                    <a class="nav-link" href="http://mdrrmo-hinunangan.test">
                        <span class="menu-title">Home</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                                                                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#situational-report" aria-expanded="false" aria-controls="situational-report">
                        <span class="menu-title">Situational Report</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-book menu-icon"></i>
                    </a>
                    <div class="collapse" id="situational-report">
                        <ul class="nav flex-column sub-menu">
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/situational-reports/schools/index.php">
                                    Schools                                </a>
                            </li>
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/situational-reports/sitrep/index.php">
                                    Sit Rep                                </a>
                            </li>
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/situational-reports/Suspension/index.php">
                                    Suspension                               </a>
                            </li>
                                                    </ul>
                    </div>
                </li>
                                                                <li class="nav-item " data-active-keyword="patient-healthcare|/views/situational-reports/schools/index.php">
                    <a class="nav-link" href="http://mdrrmo-hinunangan.test/views/patient-healthcare/index.php">
                        <span class="menu-title">Patient Healthcare</span>
                        <i class="mdi mdi-stethoscope menu-icon"></i>
                    </a>
                </li>
                                                                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                        <span class="menu-title">Settings</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-cog menu-icon"></i>
                    </a>
                    <div class="collapse" id="settings">
                        <ul class="nav flex-column sub-menu">
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/settings/menu/index.php">
                                    Menu                                </a>
                            </li>
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/settings/modules/index.php">
                                    Modules                                </a>
                            </li>
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/settings/user-roles/index.php">
                                    User Roles                                </a>
                            </li>
                                                        <li class="nav-item">
                                <a class="nav-link " href="http://mdrrmo-hinunangan.test/views/settings/users/index.php">
                                    Users                                </a>
                            </li>
                                                    </ul>
                    </div>
                </li>
                                            </ul>
        </nav>
        <!-- partial --><style>
    .btn.btn-icon {
        width: 30px;
        height: 30px;
    }
    .card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: 13px;
    }
    .form-group {
        margin-bottom: 0.75rem;
    }

    .form-control, .typeahead, .tt-query, .tt-hint, .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single{
        padding: 8px 8px;
    }

    .table th, .table td{
        padding: 5px 5px 5px 5px;
    }

    .table > :not(caption) > * > *{
        padding: 5px 5px 5px 5px;
    }

    table.dataTable{
        margin-top: 21px !important;
    }

    .parsley-errors-list {
        margin: 0px;
    }

    .parsley-errors-list {
        font-size: 0.8rem;
    }
    .password-area {
        display: none;
    }

    .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single {
        padding: 16px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: -6px;
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

.table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.table td {
    text-align: center;
}

.btn {
    padding: 5px 10px;
    background-color: #9e9e9e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #6d6d6d;
}

.btn.btn-sm, .ajax-upload-dragdrop .btn-sm.ajax-file-upload, .btn-group-sm > .btn, .ajax-upload-dragdrop .btn-group-sm > .ajax-file-upload {
    font-size: 0.875rem;
}
.btn i, .ajax-upload-dragdrop .ajax-file-upload i {
    font-size: 1rem;
}
.fa-edit:before, .fa-pencil-square-o:before {
    content: "\f044";
}
.fa-trash:before {
    content: "\f1f8";
}
/* Style for the Term Section */
/* Modal Header */
.modal-header {
    background-color: #f8f9fa; /* Light background for better contrast */
    border-bottom: 1px solid #dee2e6; /* Subtle border at the bottom */
}

/* Modal Title */
.modal-title {
    font-weight: 500; /* Medium weight for better readability */
    font-size: 1.25rem; /* Adjusted font size */
}

/* Modal Body */
.modal-body {
    padding: 20px; /* Increased padding for comfort */
}

/* Fieldset Styles */
fieldset {
    border: 1px solid #dee2e6; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    padding: 15px; /* Padding inside fieldsets */
    margin-bottom: 20px; /* Space between fieldsets */
}

/* Legend Styles */
legend {
    font-size: 1.1rem; /* Slightly larger font for legend */
    font-weight: bold; /* Bold text for emphasis */
    color: #333; /* Darker color for better contrast */
}

/* Input Styles */
.form-control {
    border-radius: 5px; /* Rounded corners for inputs */
    border: 1px solid #ced4da; /* Light gray border */
}

/* Input Focus */
.form-control:focus {
    border-color: #80bdff; /* Lighter blue border on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Shadow on focus */
}

/* Button Styles */
.btn-primary {
    border-radius: 5px; /* Rounded corners for buttons */
    transition: background-color 0.3s; /* Smooth transition effect */
}

/* Button Hover Effect */
.btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Footer Styles */
.modal-footer {
    background-color: #f1f1f1; /* Slightly darker background for footer */
    border-top: 1px solid #dee2e6; /* Gray border on top */
}

/* Small Text Styles */
.form-text {
    font-size: 0.85rem; /* Smaller text for hints */
    color: #6c757d; /* Subtle gray color for less emphasis */
}


/* Design for Column */



/* CSS for edit and delete */
</style>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> SitRep </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            SitRep                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title">
                      Situational Report
                      <span class="float-end">
                          <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add">
                              <i class="mdi mdi-plus-outline text-info"></i>
                          </button>
                      </span>
                  </h4>
                  <table id="situationalReport" class="table">
                      <thead>
                          <tr>
                              <th>Subject</th>
                              <th>Date</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Flood Alert</td>
                              <td>2024-10-08 14:30</td>
                              <td>
                                  <button class="btn btn-primary">View Details</button>
                                  <a class="btn btn-sm btn-edit" data-id="1" data-name="Flood Alert" data-code="FLAL" data-status="Y">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  &nbsp;
                                  <a class="btn btn-sm btn-delete" data-id="1" data-name="Flood Alert" data-status="Y">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td>Fire Outbreak</td>
                              <td>2024-10-07 16:00</td>
                              <td>
                                  <button class="btn btn-primary">View Details</button>
                                  <a class="btn btn-sm btn-edit" data-id="2" data-name="Fire Outbreak" data-code="FROB" data-status="Y">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  &nbsp;
                                  <a class="btn btn-sm btn-delete" data-id="2" data-name="Fire Outbreak" data-status="Y">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td>Fire Outbreak</td>
                              <td>2024-10-07 16:00</td>
                              <td>
                                  <button class="btn btn-primary">View Details</button>
                                  <a class="btn btn-sm btn-edit" data-id="3" data-name="Fire Outbreak" data-code="FROB" data-status="Y">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  &nbsp;
                                  <a class="btn btn-sm btn-delete" data-id="3" data-name="Fire Outbreak" data-status="Y">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          
          <!-- Modal for Edit -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form id="editForm">
                              <input type="hidden" id="edit-id">
                              <div class="form-group">
                                  <label for="edit-name">Name</label>
                                  <input type="text" class="form-control" id="edit-name" required>
                              </div>
                              <div class="form-group">
                                  <label for="edit-code">Code</label>
                                  <input type="text" class="form-control" id="edit-code" required>
                              </div>
                              <div class="form-group">
                                  <label for="edit-status">Status</label>
                                  <select class="form-control" id="edit-status">
                                      <option value="Y">Active</option>
                                      <option value="N">Inactive</option>
                                  </select>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" id="save-edit" class="btn btn-primary">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
          
          <!-- Confirmation Modal for Delete -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p>Are you sure you want to delete <span id="delete-item-name"></span>?</p>
                          <input type="hidden" id="delete-id">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="button" id="confirm-delete" class="btn btn-danger">Delete</button>
                      </div>
                  </div>
              </div>
          </div>
    
     <!-- Your existing HTML content goes here -->

<!-- MODAL 1 -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-user-title">Add Situational Report</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm-crud" method="post" data-parsley-validate="">
                    <input type="hidden" name="action_type" id="action_type">
                    <input type="hidden" name="id" id="id">

                    <fieldset>
                        <legend>Report Source</legend>
                        <div class="form-group mb-3">
                            <label for="sources" class="form-label">Source of Report <span class="text-danger">*</span></label>
                            <select class="form-control" id="sources" name="sources" required>
                                <option value="">Select source</option>
                                <option value="source1">LGU</option>
                                <option value="source2">BLGU</option>
                                <option value="source3">Other LGUs</option>
                                <option value="source4">Supplier</option>
                            </select>
                            <small class="form-text text-muted">Please select the source of the report.</small>
                        </div>

                        <!-- LGU Details -->
                        <div id="lguDetails" style="display:none; border: 1px solid #ccc; padding: 15px; border-radius: 5px; margin-top: 15px;">
                            <h6 class="text-primary mb-3">LGU Details</h6>
                            <div class="form-group mb-3">
                                <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="issuanceType" class="form-label">Type of Issuance <span class="text-danger">*</span></label>
                                <select class="form-control" id="issuanceType" name="issuanceType" required>
                                    <option value="">Select Type of Issuance</option>
                                    <option value="Ordinance">Ordinance</option>
                                    <option value="Resolution">Resolution</option>
                                    <option value="EO">Executive Order</option>
                                    <option value="MOA">Memorandum of Agreement</option>
                                    <option value="MOU">Memorandum of Understanding</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file" class="form-label">Upload Scanned File (PDF/Image) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="file" name="file" accept="application/pdf, image/*" multiple>
                                <small class="form-text text-muted"><br>Upload the related scanned document (PDF or Image).</small>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Term Details</legend>
                        <div class="form-group mb-3">
                            <label for="term">Term <span class="text-danger">*</span></label>
                            <select id="term" name="term" class="form-control">
                                <option value="Select">Select Term</option>
                                <option value="Attended">Attended</option>
                                <option value="Pending">Conducted</option>
                            </select>
                            <small class="form-text text-muted">Please select the term status.</small>
                        </div>
                        <div id="term-details-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; display: none; margin-top: 15px;">
                            <h6 class="text-primary mb-3">Term Details</h6>
                            <div class="form-group mb-3" id="lgu-container" style="display: none;">
                                <label for="lgu-employee">List of Employees:</label>
                                <select id="lgu-employee" name="lgu-employee" class="form-control">
                                    <option value="" disabled selected>Choose an Employee</option>
                                    <option value="Employee 1">Employee 1</option>
                                    <option value="Employee 2">Employee 2</option>
                                    <option value="Employee 3">Employee 3</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    

                    <fieldset>
                        <legend>Map Information</legend>
                        <div class="form-group mb-3">
                            <label for="map-source">Map Source <span class="text-danger">*</span></label>
                            <select id="map-source" name="map-source" class="form-control">
                                <option value="Select Source">Select Source</option>
                                <option value="Source1">Source1</option>
                                <option value="Source2">Source2</option>
                            </select>
                            <small class="form-text text-muted">Please select the source of the map.</small>
                        </div>
                        <div id="maps-details-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; display: none; margin-top: 15px;">
                            <div class="form-group mb-3">
                                <label for="list-name">List Name <span class="text-danger">*</span></label>
                                <input type="text" id="list-name" name="list-name" class="form-control" placeholder="Enter list name">
                                <small class="form-text text-muted">Please enter the name of the list.</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="map-type">Types of Maps <span class="text-danger">*</span></label>
                                <select id="map-type" name="map-type" class="form-control">
                                    <option value="Street Map">Street Map</option>
                                    <option value="Topographic Map">Topographic Map</option>
                                </select>
                                <small class="form-text text-muted">Select the type of map.</small>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Agency Directory</legend>
                        <div class="form-group mb-3">
                            <label for="agency">Agency <span class="text-danger">*</span></label>
                            <select id="agency" name="agency" class="form-control">
                                <option value="Select Agency">Select Agency</option>
                                <option value="BFP">BFP</option>
                                <option value="PNP">PNP</option>
                            </select>
                            <small class="form-text text-muted">Please select the agency.</small>
                        </div>
                        <div id="directory-details-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; display: none; margin-top: 15px;">
                            <div class="form-group mb-3">
                                <label for="barangay-name">Barangay Name <span class="text-danger">*</span></label>
                                <input type="text" id="barangay-name" name="barangay-name" class="form-control" placeholder="Enter barangay name">
                                <small>Please enter the barangay name.</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="office-name">Office Name <span class="text-danger">*</span></label>
                                <input type="text" id="office-name" name="office-name" class="form-control" placeholder="Enter office name">
                                <small>Please enter the office name.</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact-number">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" id="contact-number" name="contact-number" class="form-control" placeholder="Enter contact number">
                                <small>Please enter the contact number.</small>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save" class="btn btn-primary">Save Report</button>
            </div>
        </div>
    </div>
</div>
        </div>


<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




<!-- Script for the  Map and Diretory Section -->
<script>
    // Event listener for Maps Section
    const mapSourceSelect = document.getElementById('map-source');
    const mapsDetailsBox = document.getElementById('maps-details-box');
    const listNameContainer = document.getElementById('list-name-container');

    mapSourceSelect.addEventListener('change', function() {
        if (mapSourceSelect.value !== 'Select Source') {
            mapsDetailsBox.style.display = 'block';
            listNameContainer.style.display = 'block';
        } else {
            mapsDetailsBox.style.display = 'none';
            listNameContainer.style.display = 'none';
        }
    });

    // Event listener for Directory Section
    const agencySelect = document.getElementById('agency');
    const directoryDetailsBox = document.getElementById('directory-details-box');
    const barangayNameContainer = document.getElementById('barangay-name-container');

    agencySelect.addEventListener('change', function() {
        if (agencySelect.value !== 'Select Agency') {
            directoryDetailsBox.style.display = 'block';
            barangayNameContainer.style.display = 'block';
        } else {
            directoryDetailsBox.style.display = 'none';
            barangayNameContainer.style.display = 'none';
        }
    });
</script>
  <!-- End Here -->



<!-- Script for the Term Section -->
<script>
    // Get references to the select elements and containers
    document.addEventListener("DOMContentLoaded", function () {
    const termSelect = document.getElementById("term");
    const termDetailsBox = document.getElementById("term-details-box");
    const lguContainer = document.getElementById("lgu-container");

    termSelect.addEventListener("change", function () {
        const selectedValue = termSelect.value;

        // Show the term details box only when "Attended" is selected
        if (selectedValue === "Attended") {
            termDetailsBox.style.display = "block"; // Show term details box
            lguContainer.style.display = "block"; // Show LGU container
        } else {
            termDetailsBox.style.display = "none"; // Hide term details box
            lguContainer.style.display = "none"; // Hide LGU container
        }
    });
});

</script>
<!-- End Here -->


<!-- Script for function add -->
<script>
    // Function to toggle LGU Section based on source selection
    document.addEventListener('DOMContentLoaded', function() {
      const sourcesDropdown = document.getElementById('sources');
      const lguDetails = document.getElementById('lguDetails');
  
      sourcesDropdown.addEventListener('change', function() {
        if (this.value === 'source1') {
          // Show LGU section if LGU is selected
          lguDetails.style.display = 'block';
        } else {
          // Hide if any other source is selected
          lguDetails.style.display = 'none';
        }
      });
  
      // Handle form submission (Simulated for demo purposes)
      document.getElementById('btn-save').addEventListener('click', function() {
        // Validate form
        if (!$('form#frm-crud').parsley().validate()) {
          return;
        }
  
        // Simulating saving report and logging the data
        console.log('Saving report...');
        $('#modal-add').modal('hide');
        document.getElementById('frm-crud').reset();
      });
    });
  </script>
  <!-- end here -->

  



  <!-- Functionality for saving (pero wa ni gana)-->
   <script>
document.getElementById('btn-save').addEventListener('click', function() {
    // Validate form using Parsley
    if (!$('form#frm-crud').parsley().validate()) {
        return;
    }

    // Gather form data
    const formData = new FormData(document.getElementById('frm-crud'));

    // Send data to server using AJAX
    fetch('save_report.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Report saved successfully');
            $('#modal-add').modal('hide');
            document.getElementById('frm-crud').reset();
        } else {
            console.error('Failed to save report:', data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>
<!-- end here -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Open the modal when the "Add Report" button is clicked
      document.getElementById('btn-add').addEventListener('click', function() {
          $('#modal-add').modal('show');
      });
    
      // Handle the form submission
      document.getElementById('btn-save').addEventListener('click', function() {
          // Get form data
          let event = document.getElementById('event').value;
          let datetime = document.getElementById('datetime').value;
          let report = document.getElementById('report').value;
          let status = document.getElementById('status').checked ? 'Urgent' : 'Normal';
    
          // Basic validation to check if all required fields are filled
          if (event === '' || datetime === '' || report === '') {
              alert('Please fill all required fields.');
              return;
          }
    
          // Simulating AJAX call to save the data (you can replace this with actual AJAX request)
          let reportData = {
              event: event,
              datetime: datetime,
              report: report,
              status: status
          };
    
          // For this demo, we'll log the data to the console
          console.log('Saving Report:', reportData);
    
          // Simulate saving by closing the modal and clearing the form
          $('#modal-add').modal('hide');
          document.getElementById('frm-crud').reset();
    
          // Optional: You can add the new report to the table dynamically
          let table = document.getElementById('situationalReport').getElementsByTagName('tbody')[0];
          let newRow = table.insertRow();
          newRow.innerHTML = `
              <tr>
                  <td>${event}</td>
                  <td>${datetime}</td>
                  <td><button class="btn btn-primary">View Details</button></td>
              </tr>
          `;
      });
    });
    </script>


                             
<!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 MDRRMO-Hinunangan. All rights reserved.</span>
                </div>
            </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="http://mdrrmo-hinunangan.test/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="http://mdrrmo-hinunangan.test/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="http://mdrrmo-hinunangan.test/assets/js/off-canvas.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/js/misc.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/js/settings.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/js/todolist.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
        <!-- End custom js for this page -->
    
    <script src="http://mdrrmo-hinunangan.test/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>

    
    <script src="http://mdrrmo-hinunangan.test/assets/js/parsley.js"></script>
    <script src="http://mdrrmo-hinunangan.test/assets/js/select2.full.js"></script>
    
    <script>
    $(document).ready(function(){
        var table = $('#tbl-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'http://mdrrmo-hinunangan.test/api/schools/get.php',
                type: 'POST',
                data:   function ( d ) {
                    return $.extend( {}, d, {
                        //'action' : getAction()
                    } );
                },
                "dataSrc": function ( json ) {
                    
                    if($('#action').val() == 'excel') {
                        window.open(json.url, '_blank');
                    }

                    if($('#action').val() == 'print') {
                        // window.open(json.url);
                        //createPopupWin(json.url, 'Lots')
                    }
                    return json.data;
                }
            },
            "columnDefs": [ {
                "targets": [6],
                "orderable": false
            } ],
            "order": []
        });

        $('#btn-add').click(function(){

            // Reset the form to remove the validation error
            $('#frm-crud').parsley().reset();
            $('#frm-crud')[0].reset();
            $('#action_type').val('add');
            //Destroy and reinitialize
            // $("#barangay").select2("destroy").select2();
            $('#barangay').val(null).trigger('change');
            $('#modal-add').modal('show');
        })

        $('#btn-save').click(function(){

            if(!$('form#frm-crud').parsley().validate()) {
                return;
            }

            var msg = $('.error-message');
            $.ajax({
                url : 'http://mdrrmo-hinunangan.test/api/schools/dml.php',
                type : 'post',
                data : $('#frm-crud').serialize(),
                success : function(data) {
                    var json = $.parseJSON(data);

                    if(json['code'] == 0) {
                        msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                        $('#tbl-data').DataTable().ajax.reload();
                        $('#modal-add').modal('hide');
                        
                    } else {
                        msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                    }
                }
            })
            return false;
        })

        $('#barangay').select2({
            dropdownParent: $('#modal-add'),
            ajax: {
                url: 'http://mdrrmo-hinunangan.test/api/barangays/get.php',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.items
                    };
                }
            }
        });
    });

    //Bind to edit
    $(document).on('click', 'a.btn-edit', function(){
        $('#frm-crud')[0].reset();
        // Reset the form to remove the validation error
        $('#frm-crud').parsley().reset();

        $('.modal-title').html('Edit Schools');
        $('#action_type').val('update');
        $('#id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#school_type').val($(this).data('type'));
        // $('#barangay').val($(this).data('barangay-id'));
        // $('#barangay').val($(this).data('address'));

        var data = {
            id: $(this).data('barangay-id'),
            text: $(this).data('address')
        };

        var newOption = new Option(data.text, data.id, false, false);
        $('#barangay').append(newOption).trigger('change');

        $('#status').removeAttr('checked');
        // $('#status_no').attr('checked', false);
        if($(this).data('status') == 'Y'){
            $('#status').attr('checked', true);
        }
        $('.error-message').html('');

        //Show modal
        $('#modal-add').modal('show');
    });

    //for delete
    $(document).on('click', 'a.btn-delete', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');

        if(confirm('Are you sure you want delete name ' + name + '?'))
        {
            $.ajax({
                url : 'http://mdrrmo-hinunangan.test/api/schools/dml.php',
                type : 'post',
                data : { action_type : 'delete', 'id' : id },
                success : function(data) {
                    var json = $.parseJSON(data);
                    if(json['code'] == 0) {
                        alert(json['message']);
                        $('#tbl-data').DataTable().ajax.reload();
                    } else {
                        alert(json['message']);
                    }
                }
            })
        }
    })
    
</script>


<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<scrip src="froms.js"></scrip>
<scrip src="script.js"></scrip>
