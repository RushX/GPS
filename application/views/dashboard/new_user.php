<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User | BikerZ</title>
    <?php $this->load->view('template/css') ?>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->load->view('template/nav') ?>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">New User</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name='name' id="name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name='email' id="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">User Type</label>
                                            <select name="type" id="type" default='1'>
                                                <option value="0">Admin</option>
                                                <option value="1">Biker</option>
                                            </select>
                                        </div>
                                        <p class="" id="status"></p>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="button" id='submit' class="btn btn-primary">Add User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?php $this->load->view('template/footer', $data = ['active' => 'users']) ?>
        <script>
            $('#submit').click(() => {
                $.post('<?php echo site_url()?>api/add/user',

                    {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        type: $('#type').val()
                    },
                    function(data, status, jqXHR) { // success callback
                        obj=JSON.parse(data)
                        if(obj.success==true){
                            document.getElementById('status').innerHTML="Success";
                            
                        }
                        else{
                            
                            document.getElementById('status').innerHTML=obj.message;
                         
                        }
                    })

            })
        </script>

</body>

</html>

<!-- /.card -->