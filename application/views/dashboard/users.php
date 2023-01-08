<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BikerZ | Users</title>
    <?php $this->load->view('template/css') ?>
</head>


<body class="hold-transition sidebar-mini">
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
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title">Users</h3>

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
                                        User Name
                                    </th>
                                    <th style="width: 30%">
                                        Bike Id
                                    </th>
                                    <th style="width: 10%">
                                        Type
                                    </th>
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $key => $row) {
                                    echo '<tr>';
                                    echo '<td>#</td>';
                                    echo '<td><a id="' . $row->uid . '_name">'
                                        . $row->uname . '
                                </a>
                                <br />
                                <small id="' . $row->uid . '_email">
                                ' . $row->email . '
                                </small></td>';
                                    echo '<td id="' . $row->uid . '_bid">' . $row->bid . '</td>';
                                    echo '<td id="' . $row->uid . '_type">' . $row->type . '</td>';
                                    echo '<td class="project-actions text-right"><a class="btn btn-primary btn-sm" onclick=\'Register(' . $row->uid . ',"' . $row->uname . '")\'>
                                        <i class="fas fa-folder"></i>
                                        Register Bike
                                    </a>
                                    <a class="btn btn-info btn-sm" onclick=\'Edit(' . $row->uid . ',"' . $row->uname . '","' . $row->email . '",' . $row->bid . ',' . $row->type .')\'>
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick=Delete(' . $row->uid . ')>
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
        <div class="modal fade" id="RegisterBike" tabindex="-1" role="dialog" aria-labelledby="RegisterBikeTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="RegisterBikeTitle">Register Bike</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="register_uid">User ID</label>
                                    <input type="text" class="form-control " disabled name='uid' id="register_uid">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" disabled name='name' id="register_name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="register_bike">Select New Bike</label>
                                    <select class="form-control" name='bike' id="register_bid" placeholder="Select Bike">
                                        <option value="0">0 None</option>
                                    </select>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="registerApi()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditBike" tabindex="-1" role="dialog" aria-labelledby="EditTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTitle">Edit User Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="register_uid">User ID</label>
                                    <input type="text" class="form-control " disabled name='uid' id="edit_uid">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name='name' id="edit_name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name='email' id="edit_email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="edit_password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="type">User Type</label>
                                    <select name="type" id="edit_type" default='1'>
                                        <option value="0">Admin</option>
                                        <option value="1">Biker</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick=editApi();>Save changes</button>
                        <!-- document.getElementById('edit_name').innerHTML,document.getElementById('edit_email').value,document.getElementById('edit_password').value,document.getElementById('edit_type').value,document.getElementById('edit_status').value -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="DeleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteTitle">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please Confirm to delete the user <b id="DeleteNameHolder"></b>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="DelBike">
                            <label class="form-check-label" for="DelBike">Delete bike associated with the user</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="button" onclick=deleteApi(document.getElementById('DeleteNameHolder').innerHTML,document.getElementById('DelBike').checked); value="Confirm" class="btn btn-danger"></input>
                    </div>
                </div>
            </div>
        </div>


        <?php $this->load->view('template/footer', $data = ['active' => 'users']) ?>
        <script>
            $.get('<?php echo site_url() ?>api/get/unallocated',
                function(data) { // success callback
                    obj = JSON.parse(data)
                    if (obj.success == true) {
                        bikes = obj.data;
                        for (index in bikes) {

                            let bid = bikes[index].bid
                            let name = bikes[index].bike_name
                            $('#register_bid').append($('<option>', {
                                value: bid,
                                text: name
                            }));
                        }

                    } else {

                        toastr.error(obj.message, "Error");

                    }
                })

            function Register(id, name) {
                $('#RegisterBike').modal('show');
                $('#register_uid').val(id);
                $('#register_name').val(name);

            }

            function Edit(id, name, email, bid, type, status) {
                $('#EditBike').modal('show');
                $('#edit_uid').val(id);
                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_bid').val(bid);
                $('#edit_type').val(type);

            }


            function Delete(id) {
                $('#Delete').modal('show');
                $('#DeleteNameHolder').html(id);

            }

            function deleteApi(id, isChecked) {
                $.post('<?php echo site_url() ?>api/delete/user',

                    {
                        uid: id,
                        del_bike: isChecked
                    },
                    function(data, status, jqXHR) { // success callback
                        obj = JSON.parse(data)
                        if (obj.success == true) {
                            toastr.success('User Deleted Successfully');

                        } else {

                            toastr.error(obj.message, "Error");
                            document.getElementById('status').innerHTML = obj.message;

                        }
                    })
            }

            function registerApi(id, bid) {
                $.post('<?php echo site_url() ?>api/edit/user',

                    {
                        uid: $('#register_uid').val(),
                        bid: $('#register_bid').val(),
                    },
                    function(data, status, jqXHR) { // success callback
                        obj = JSON.parse(data)
                        if (obj.success == true) {
                            toastr.success('User Registered Successfully');

                        } else {

                            toastr.error(obj.message, "Error");
                            document.getElementById('status').innerHTML = obj.message;

                        }
                    })
            }

            function editApi(id, name, email, password, type) {
                $.post('<?php echo site_url() ?>api/edit/user',

                    {
                        uid: $('#edit_uid').val(),
                        name: $('#edit_name').val(),
                        email: $('#edit_email').val(),
                        bid: $('#edit_bid').val(),
                        password: $('#edit_password').val(),
                        type: $('#edit_type').val()
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