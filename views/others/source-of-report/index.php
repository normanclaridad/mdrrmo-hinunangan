<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Menu');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}


include_once '../../../templates/header.php';
include_once '../../../templates/sidebar.php';
?>
<style>
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

</style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> <?php echo PAGE_TITLE ?> </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo PAGE_TITLE ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo PAGE_TITLE ?>
                        <span class="float-end">
                            <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add">
                                <i class="mdi mdi-plus-outline text-info"></i>
                            </button>
                        </span>
                    </h4>
                    <table class="table" id="tbl-data">
                        <thead>
                            <tr> 
                                <th>Subject</th>
                                <th>Created </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <!-- MODAL 1 -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-user-title">Add Report Source</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="frm-crud" action="submit_report.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action_type" id="action_type">
                    <iput type="hidden" name="id" id="id">

                    <fieldset>
                    <legend>Report Source</legend>
                        <div class="form-group mb-3">
                            <label for="sources" class="form-label">Source of Report <span class="text-danger">*</span></label>
                            <select class="form-control" id="sources" name="sources" required>
                                <option value="">Select source</option>
                                <option value="source1">LGU</option>
                                <option value="source2">BLGU</option>
                                <option value="source2">Police</option>
                                <option value="source3">Other LGUs</option>
                                <option value="source4">Supplier</option>
                            </select>
                            <small class="form-text text-muted">Please select the source of the report.</small>
                        </div>

                        <!-- LGU Details -->
                        <div id="lguDetails" style="display:none; border: 1px solid #ccc; padding: 15px; border-radius: 5px; margin-top: 15px;">
                            <h6 class="text-primary mb-3">LGU Details</h6>
                            <div class="form-group mb-3">
                                <label for="date" class="form-label">Date of Issuance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title of Issuance <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title of the issuance" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file" class="form-label">Upload Scanned File (PDF/Image) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="file" name="file" accept="application/pdf, image/*" multiple>
                                <small class="form-text text-muted"><br>Upload the related scanned document (PDF or Image).</small>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btn-save" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
                             
<?php
    include_once '../../../templates/footer.php';
?>

<script>
    // Show LGU Details when LGU is selected in the dropdown
    document.getElementById('sources').addEventListener('change', function () {
        const lguDetails = document.getElementById('lguDetails');
        if (this.value === 'source1') {
            lguDetails.style.display = 'block'; // Show LGU details
        } else {
            lguDetails.style.display = 'none'; // Hide LGU details
        }
    });

    // JavaScript code for pagination and search functionality
    const reportsData = [];
    const entriesSelect = document.getElementById('entriesSelect');
    const searchInput = document.getElementById('searchInput');
    const reportsTableBody = document.getElementById('reportsTableBody');
    const tableInfo = document.getElementById('tableInfo');
    const prevPage = document.getElementById('prevPage');
    const nextPage = document.getElementById('nextPage');
    let currentPage = 1;
    let itemsPerPage = parseInt(entriesSelect.value);
    let filteredReports = reportsData;

    // Updated Function to Render the Table with Icons
    function renderTable() {
        reportsTableBody.innerHTML = '';
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const currentData = filteredReports.slice(start, end);

        currentData.forEach((report, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${report.subject}</td>
                <td>${report.created}</td>
                <td>
                    <button class="btn btn-outline-secondary btn-sm edit-btn" onclick="editReport(${index})" title="Edit">
                        <i class="mdi mdi-pencil-outline text-warning"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm delete-btn" onclick="deleteReport(${index})" title="Delete">
                        <i class="mdi mdi-delete-outline text-danger"></i>
                    </button>
                </td>
            `;
            reportsTableBody.appendChild(row);
        });

        updatePagination();
    }

    // Function to update pagination buttons
    function updatePagination() {
        const totalPages = Math.ceil(filteredReports.length / itemsPerPage);
        prevPage.disabled = currentPage === 1;
        nextPage.disabled = currentPage === totalPages;

        tableInfo.textContent = `Showing ${currentPage * itemsPerPage - itemsPerPage + 1} to ${Math.min(currentPage * itemsPerPage, filteredReports.length)} of ${filteredReports.length} entries`;
    }

    // Event listener for pagination
    prevPage.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    nextPage.addEventListener('click', function () {
        const totalPages = Math.ceil(filteredReports.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });

    // Event listener for entries per page select
    entriesSelect.addEventListener('change', function () {
        itemsPerPage = parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    // Event listener for search input
    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        filteredReports = reportsData.filter(report => report.subject.toLowerCase().includes(query));
        currentPage = 1;
        renderTable();
    });

    // Handle saving a new report from the modal
    document.getElementById('btn-save').addEventListener('click', function () {
        const source = document.getElementById('sources').value;
        const subject = document.getElementById('title').value || source;
        const created = new Date().toLocaleString();

        if (subject) {
            reportsData.push({ subject: `${source}: ${subject}`, created });
            filteredReports = reportsData; // Reset filtered reports to include the new one
            renderTable();
            $('#modal-add').modal('hide'); // Close the modal
        }
    });

    // Edit functionality
    function editReport(index) {
        const report = filteredReports[index];
        document.getElementById('sources').value = report.subject.split(':')[0];
        document.getElementById('title').value = report.subject.split(':')[1].trim();
        $('#modal-add').modal('show');
        
        // Save the updated report when the modal save button is clicked
        document.getElementById('btn-save').onclick = function () {
            const updatedSubject = document.getElementById('title').value;
            filteredReports[index].subject = `${report.subject.split(':')[0]}: ${updatedSubject}`;
            renderTable();
            $('#modal-add').modal('hide');
        };
    }

    // Delete functionality
    function deleteReport(index) {
        filteredReports.splice(index, 1);
        renderTable();
    }

    // Initial render
    renderTable();
</script>

<!-- Include Material Design Icons (MDI) -->
<link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">


  

<script>
    document.getElementById("btn-save").addEventListener("click", function() {
    const formData = new FormData(document.getElementById("frm-crud"));
    
    fetch("submit_report.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert(data.message);
            // Refresh the reports table or add the new entry
            loadReportsTable();
            $('#modal-add').modal('hide'); // Close the modal
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});

    function loadReportsTable() {
    fetch("get_report.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#reportsTable tbody");
            tableBody.innerHTML = ""; // Clear table

            data.forEach(report => {
                const row = `<tr>
                    <td>${report.source}</td>
                    <td>${report.date}</td>
                    <td>${report.issuanceType}</td>
                    <td>${report.title}</td>
                    <td><a href="${report.file_path}" target="_blank">View File</a></td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error:", error));
}

// Load reports on page load
document.addEventListener("DOMContentLoaded", loadReportsTable);
    </script>
    

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
          let table = document.getElementById('others').getElementsByTagName('tbody')[0];
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










<script>
        //for edit
        $(document).on('click', '.btn-edit' ,function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var url = $(this).data('url');
                var icon = $(this).data('icon');
                var sort = $(this).data('sort');
                var status = $(this).data('status');
                var activekeyword = $(this).data('active-keyword');
                
                // Reset the form to remove the validation error
                $('#frm-menu').parsley().reset();

                $('#id').val(id);
                $('#action_type').val('update');
                $('#name').val(name);
                $('#url').val(url);
                $('#icon').val(icon);
                $('#sort').val(sort);
                $('#status').val(status);
                $('#active_keyword').val(activekeyword);
                
                if(status == 'Y'){
                    $('#status').prop('checked', true);
                }
                else {
                    $('#status').prop('checked', false);

                }
            

                $('#modal-add').modal('show');
                $('#modal-title').text('Edit Menu');
            })

            //for delete
            $(document).on('click', 'a.btn-delete', function(){
                var id = $(this).data('id');
                var name = $(this).data('name');

                if(confirm('Are you sure you want delete name: ' + name + '?'))
                {
                    $.ajax({
                        url : '<?php echo BASE_URL ?>/api/menu/dml.php',
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


            //clearing modal styles
            $('body').on('hidden.bs.modal', '.modal', function () {
                console.log("modal closed");
            
                $("#error-message").html("");
                $("#name").add("#url").add("#icon").add("#sort").css({ 'background-color' : 'white', 'border-color' : '', 'color' : 'black' });
                $('#frm-menu').parsley().reset();

        });
</script>