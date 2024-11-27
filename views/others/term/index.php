
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

</style>
<div class="main-panel">
  <div class="content-wrapper">
      <div class="page-header">
          <h3 class="page-title"> Others </h3>
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Terms</li>
              </ol>
          </nav>
      </div>
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">
                  Terms
                  <span class="float-end">
                      <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add" onclick="openAddModal()">
                          <i class="mdi mdi-plus-outline text-info"></i>
                      </button>
                  </span>
              </h4>
              <table class="table" id="tbl-data">
                  <thead>
                      <tr> 
                          <th>Subject</th>
                          <th>Created</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Dynamically added rows will go here -->
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <!-- Modal Code -->
  <!-- MODAL 1 -->
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content" style="padding: 15px;">
              <div class="modal-header">
                  <h5 class="modal-title" id="add-user-title">Add Terms</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <fieldset style="padding: 5px;">
                <legend>Training/Seminar Form</legend>
                
                <div class="form-group mb-2">
                    <label for="term">Term:</label>
                    <select id="term" name="term" class="form-control" style="margin-bottom: 10px;">
                        <option value="">Select Term</option>
                        <option value="Attended">Attended</option>
                        <option value="Conducted">Conducted</option>
                    </select>
                </div>
            
                <div id="attended-container" class="form-group mb-2" style="display: none;">
                    <label for="source">Source:</label>
                    <select id="source" name="source" class="form-control" style="margin-bottom: 10px;">
                        <option value="">Select Source</option>
                        <option value="LGU">LGU</option>
                        <option value="BLGU">BLGU</option>
                    </select>
            
                    <div id="lgu-container" style="display: none;">
                        <label for="lgu-employee">List of Employees:</label>
                        <select id="lgu-employee" name="lgu-employee" class="form-control">
                            <option value="">Select Employee</option>
                            <option value="Employee 1">Employee 1</option>
                            <option value="Employee 2">Employee 2</option>
                            <option value="Employee 3">Employee 3</option>
                        </select>
                    </div>
            
                    <div id="blgu-container" style="display: none;">
                        <label for="blgu-name">BLGU Name:</label>
                        <select id="blgu-name" name="blgu-name" class="form-control">
                            <option value="">Select BLGU Name</option>
                            <option value="BLGU 1">BLGU 1</option>
                            <option value="BLGU 2">BLGU 2</option>
                            <option value="BLGU 3">BLGU 3</option>
                        </select>
                    </div>
                </div>
            
                <div id="conducted-container" class="form-group mb-2" style="display: none;">
                    <label for="conducted-name">Name of Person:</label>
                    <input type="text" id="conducted-name" name="conducted-name" class="form-control" style="margin-bottom: 10px;">
                </div>
            
                <div class="form-group mb-2">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" style="margin-bottom: 10px;">
                </div>
            
                <div class="form-group mb-2">
                    <label for="training-type">Type of Trainings/Seminar:</label>
                    <select id="training-type" name="training-type" class="form-control" style="margin-bottom: 10px;">
                        <option value="">Select Type of Trainings/Seminar</option>
                        <option value="BLS">BLS</option>
                        <option value="First Aid">First Aid</option>
                        <option value="ICS">ICS</option>
                    </select>
                </div>
            
                <div class="form-group mb-2">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" style="margin-bottom: 10px;">
                </div>
            
                <div class="form-group mb-2">
                    <label for="scanned-file">Scanned File:</label>
                    <input type="file" id="scanned-file" name="scanned-file" class="form-control" style="margin-bottom: 10px;">
                </div>
            
                <div class="modal-footer" style="display: flex; justify-content: flex-end; padding-top: 10px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn-save" class="btn btn-primary">Save Report</button>
                </div>
            </fieldset>
            
          </div>
      </div>
  </div>




                                    
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
      // Open the modal to add a new entry
      function openAddModal() {
          document.getElementById("add-user-title").innerText = "Add Terms";
          document.getElementById("term").value = "";
          document.getElementById("date").value = "";
          document.getElementById("training-type").value = "";
          document.getElementById("title").value = "";
  
          // Show the modal
          var addModal = new bootstrap.Modal(document.getElementById('modal-add'));
          addModal.show();
      }
  
      // Add an entry to the table
      document.getElementById("btn-save").addEventListener("click", function () {
          // Get form values
          const term = document.getElementById("term").value;
          const date = document.getElementById("date").value;
          const type = document.getElementById("training-type").value;
          const title = document.getElementById("title").value;
  
          if (title && date && type && term) {
              const tbody = document.querySelector("#tbl-data tbody");
  
              // Create a new row
              const row = document.createElement("tr");
  
              // Title cell
              const titleCell = document.createElement("td");
              titleCell.textContent = title;
              row.appendChild(titleCell);
  
              // Date cell
              const dateCell = document.createElement("td");
              dateCell.textContent = date;
              row.appendChild(dateCell);
  
              // Type cell
              const typeCell = document.createElement("td");
              typeCell.textContent = type;
              row.appendChild(typeCell);
  
              // Action cell with Edit and Delete buttons
              const actionCell = document.createElement("td");
  
              // Edit button
              const editButton = document.createElement("button");
              editButton.className = "btn btn-outline-primary btn-sm";
              editButton.innerHTML = '<i class="mdi mdi-pencil"></i> Edit';
              editButton.onclick = function() { editEntry(row, term, date, type, title); };
              actionCell.appendChild(editButton);
  
              // Delete button
              const deleteButton = document.createElement("button");
              deleteButton.className = "btn btn-outline-danger btn-sm";
              deleteButton.innerHTML = "Delete";
              deleteButton.onclick = function() { row.remove(); };
              actionCell.appendChild(deleteButton);
  
              row.appendChild(actionCell);
  
              // Append the row to the table
              tbody.appendChild(row);
  
              // Close the modal
              var addModal = bootstrap.Modal.getInstance(document.getElementById('modal-add'));
              addModal.hide();
          } else {
              alert("Please fill out all fields.");
          }
      });
  
      // Edit an entry in the table
      function editEntry(row, term, date, type, title) {
          document.getElementById("add-user-title").innerText = "Edit Terms";
          document.getElementById("term").value = term;
          document.getElementById("date").value = date;
          document.getElementById("training-type").value = type;
          document.getElementById("title").value = title;
  
          var editModal = new bootstrap.Modal(document.getElementById('modal-add'));
          editModal.show();
  
          // Update the row on Save Report click
          document.getElementById("btn-save").onclick = function() {
              const updatedTerm = document.getElementById("term").value;
              const updatedDate = document.getElementById("date").value;
              const updatedType = document.getElementById("training-type").value;
              const updatedTitle = document.getElementById("title").value;
  
              if (updatedTerm && updatedDate && updatedType && updatedTitle) {
                  row.cells[0].textContent = updatedTitle;
                  row.cells[1].textContent = updatedDate;
                  row.cells[2].textContent = updatedType;
  
                  editModal.hide();
              } else {
                  alert("Please fill out all fields.");
              }
          };
      }
  </script>


<!-- script  -->
<script>
  const termSelect = document.getElementById('term');
  const attendedContainer = document.getElementById('attended-container');
  const sourceSelect = document.getElementById('source');
  const lguContainer = document.getElementById('lgu-container');
  const blguContainer = document.getElementById('blgu-container');
  const conductedContainer = document.getElementById('conducted-container');

  termSelect.addEventListener('change', (e) => {
      if (e.target.value === 'Attended') {
          attendedContainer.style.display = 'block';
          conductedContainer.style.display = 'none';
      } else if (e.target.value === 'Conducted') {
          attendedContainer.style.display = 'none';
          conductedContainer.style.display = 'block';
      } else {
          attendedContainer.style.display = 'none';
          conductedContainer.style.display = 'none';
      }
  });

  sourceSelect.addEventListener('change', (e) => {
      if (e.target.value === 'LGU') {
          lguContainer.style.display = 'block';
          blguContainer.style.display = 'none';
      } else if (e.target.value === 'BLGU') {
          lguContainer.style.display = 'none';
          blguContainer.style.display = 'block';
      } else {
          lguContainer.style.display = 'none';
          blguContainer.style.display = 'none';
      }
  });
</script>



<!-- Script for the add -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    // Get elements
    const addButton = document.getElementById("btn-add");
    const saveButton = document.getElementById("btn-save");
    const modalAdd = new bootstrap.Modal(document.getElementById("modal-add"));
    const tblData = document.getElementById("tbl-data").getElementsByTagName("tbody")[0];

    // Open modal on Add button click
    addButton.addEventListener("click", function () {
        modalAdd.show();
    });

    // Save data and add to table on Save button click
    saveButton.addEventListener("click", function () {
        // Collect form data
        const subject = document.getElementById("title").value;
        const created = new Date().toLocaleDateString();
        
        // Insert new row in the table
        const newRow = tblData.insertRow();
        newRow.innerHTML = `
            <td>${subject}</td>
            <td>${created}</td>
            <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
        `;

        // Clear form fields
        document.getElementById("title").value = "";
        document.getElementById("date").value = "";
        modalAdd.hide();
    });
});

// Function to delete a row
function deleteRow(button) {
    const row = button.closest("tr");
    row.remove();
}
    </script>
    


    <script>
    $(document).ready(function(){
        var table = $('#tbl-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'http://mdrrmo-hinunangan.test/api/menu/get.php',
                    type: 'POST'
                },
                "columnDefs": [ {
                    "targets": [4],
                    "orderable": false
                } ],
                "order": []
            });

            $('#btn-save').click(function(){
                if(!$('form#frm-menu').parsley().validate()) {
                    return;
                }
                var msg = $('.error-message');
                $.ajax({
                    url : 'http://mdrrmo-hinunangan.test/api/menu/dml.php',
                    type : 'post',
                    data : $('#frm-menu').serialize(),
                    success : function(data) {
                        var json = $.parseJSON(data);

                        if(json['code'] == 0) {
                            msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                            $('#modal-add').modal('hide');
                            table.ajax.reload();
                        } else {
                            msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                        }
                    }
                })
                return false;
            })

            $('#btn-add').click(function(){
                // Reset the form to remove the validation error
                $('#frm-menu').parsley().reset();
                $('#action_type').val('add');
                $('#id').val('');
                $('#frm-menu')[0].reset();
                $('#modal-add').modal('show');
                $('#modal-title').text('Add Menu');
            })
        });


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
                        url : 'http://mdrrmo-hinunangan.test/api/menu/dml.php',
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