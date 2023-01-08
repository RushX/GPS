<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bike | BikerZ </title>
    <?php $this->load->view('template/css') ?>
    <style>
        th,
        tr {
            margin: auto;
        }
    </style>
</head>


<body class="hold-transition layout-fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view('template/nav'); ?>


        <!-- Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Bikes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Bikes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bikes</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Bike Name
                                    </th>
                                    <th style="width: 20%">
                                        Bike Id
                                    </th>
                                    <th style="width: 10%">
                                        GPS Id
                                    </th>
                                    <th style="width: 4%" class="text-center">
                                        Status
                                    </th>
                                    <th style="width: 20%">
                                        Registration Number
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $key => $row) {
                                    echo '<tr>';
                                    echo '<td>#</td>';
                                    echo '<td><a id="' . $row->bid . '_name">'
                                        . $row->bike_name . '
                                </a>
                                <br />
                                <small id="' . $row->bid . '_user">
  Unallocated
                                </small></td>';
                                    // id, name, gps, model, insurance, registration,status
                                    echo '<td id="' . $row->bid . '_bid">' . $row->bid . '</td>';
                                    echo '<td id="' . $row->bid . '_bike_gps_number">' . $row->bike_gps_number . '</td>';
                                    echo '<td id="' . $row->bid . '_status">' . $row->status . '</td>';
                                    echo '<td id="' . $row->bid . '_bike_model_number">' . $row->bike_model_number . '</td>';
                                    echo '<td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" onclick=Edit(' . $row->bid . ',' . $row->bike_name . ',' . $row->bike_gps_number . ',' . $row->bike_model_number . ',' . $row->insurance_number . ',' . $row->registration_number . ',' . $row->status . ',)>
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick=Delete(' . $row->bid . ')>
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </a>
                                </td></tr>';
                                }

                                ?>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- Modal -->

        <div class="modal fade" id="EditBike" tabindex="-1" role="dialog" aria-labelledby="EditBikeTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditBikeTitle">Edit Bike Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bike_name">Bike Id</label>
                                    <input type="text" class="form-control" disabled name='edit_bike_bid' id="edit_bike_bid" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="bike_name">Bike Name</label>
                                    <input type="text" class="form-control" name='edit_bike_name' id="edit_bike_name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="bike_number">Bike GPS Number</label>
                                    <input type="text" class="form-control" name='edit_bike_gps_number' id="edit_bike_gps_number" placeholder="Enter Bike Number eg. GPS92792">
                                </div>
                                <div class="form-group">
                                    <label for="bike_model_number">Model Number</label>
                                    <input type="text" class="form-control" id="edit_bike_model_number" placeholder="Enter Model Number">
                                </div>
                                <div class="form-group">
                                    <label for="insurance_number">Insurance Number</label>
                                    <input type="text" class="form-control" id="edit_insurance_number" placeholder="Enter Insurance Number">
                                </div>
                                <div class="form-group">
                                    <label for="registration_number">Registration Number</label>
                                    <input type="text" class="form-control" id="edit_registration_number" placeholder="Enter Registration Number">
                                </div>
                                <div class="form-group">
                                    <label for="registration_number">Status</label>
                                    <select type="text" class="form-control" id="edit_status">
                                        <option value="0">In Transit</option>
                                        <option value="1">Stand By</option>
                                        <option value="2">Repairing</option>
                                        <option value="3">Unallocated</option>
                                    </select>
                            </form>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editApi()">Save changes</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="DeleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteTitle">Edit User Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please Confirm to delete the user <b id="DeleteNameHolder"></b>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="DelBike">
                            <label class="form-check-label" for="DelBike">Delete user associated with the bike</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="button" onclick=deleteApi(document.getElementById('DeleteNameHolder').innerHTML,document.getElementById('DelBike').checked); value="Confirm" class="btn btn-danger"></input>
                    </div>
                </div>
            </div>
        </div>


        <?php $this->load->view('template/footer', $data = ['active' => 'bikes']) ?>
        <script>
            $.get('<?php echo site_url() ?>api/get/users',
                function(data) { // success callback
                    obj = JSON.parse(data)
                    if (obj.success == true) {
                        users = obj.data;
                        for (index in users) {

                            let uname = users[index].uname
                            let bid = users[index].bid
                            let status = users[index].status
                            $('#' + bid + "_user").html(uname);

                        }
                    } else {

                        toastr.error(obj.message, "Error");
                    }

                })


            function Edit(id, name, gps, model, insurance, registration, status) {
                $('#EditBike').modal('show');
                $('#edit_bike_bid').val(id);
                $('#edit_bike_name').val(name);
                $('#edit_bike_gps_number').val(gps);
                $('#edit_bike_model_number').val(model);
                $('#edit_insurance_number').val(insurance);
                $('#edit_registration_number').val(registration);
                $('#edit_status').val(status);

            }


            function Delete(id) {
                $('#Delete').modal('show');
                $('#DeleteNameHolder').html(id);

            }

            function deleteApi(id, isChecked) {
                $.post('<?php echo site_url() ?>api/delete/bike',

                    {
                        bid: id,
                        del_user: isChecked
                    },
                    function(data, status, jqXHR) { // success callback
                        obj = JSON.parse(data)
                        if (obj.success == true) {
                            toastr.success('Bike Deleted Successfully');

                        } else {

                            toastr.error(obj.message, "Error");
                            document.getElementById('status').innerHTML = obj.message;

                        }
                    })
            }

            

            function editApi(id, name, email, password, type, status) {
                $.post('<?php echo site_url() ?>api/edit/bike',
                    {
                        bike_uid: $('#edit_bike_bid').val(),
                        bike_name: $('#edit_bike_name').val(),
                        bike_gps_number: $('#edit_bike_gps_number').val(),
                        bike_model_number: $('#edit_bike_model_number').val(),
                        insurance_number: $('#edit_insurance_number').val(),
                        registration_number: $('#edit_registration_number').val(),
                        status: $('#edit_status').val()
                    },
                    function(data, status, jqXHR) { // success callback
                        obj = JSON.parse(data)
                        if (obj.success == true) {
                            toastr.success('User Edited Successfully');
                        } else {

                            toastr.error(obj.message, "Error");
                            document.getElementById('status').innerHTML = obj.message;

                        }
                    })
            }
        </script>

</body>

</html>