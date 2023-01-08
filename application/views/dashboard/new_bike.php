<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bike | BikerZ</title>
    <?php $this->load->view('template/css') ?>
</head>

<body class="hold-transition layout-fixed sidebar-mini">
    <?php $this->load->view('template/nav') ?>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Bike</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Bike</li>
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
                                    <h3 class="card-title">New Bike</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="bike_name">Bike Name</label>
                                            <input type="text" class="form-control" name='bike_name' id="bike_name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="bike_number">Bike GPS Number</label>
                                            <input type="text" class="form-control" name='bike_gps_number' id="bike_gps_number" placeholder="Enter Bike Number eg. GPS92792">
                                        </div>
                                        <div class="form-group">
                                            <label for="bike_model_number">Model Number</label>
                                            <input type="text" class="form-control" id="bike_model_number" placeholder="Enter Model Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="insurance_number">Insurance Number</label>
                                            <input type="text" class="form-control" id="insurance_number" placeholder="Enter Insurance Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="registration_number">Registration Number</label>
                                            <input type="text" class="form-control" id="registration_number" placeholder="Enter Registration Number">

                                        </div>
                                        <p class="" id="status"></p>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="button" id='submit' class="btn btn-primary">Add Bike</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?php $this->load->view('template/footer', $data = ['active' => 'bikes']) ?>
        <script>
            $('#submit').click(() => {
                $.post('<?php echo site_url()?>api/add/bike',

                    {
                        bike_name: $('#bike_name').val(),
                        bike_gps_number: $('#bike_gps_number').val(),
                        bike_model_number: $('#bike_model_number').val(),
                        insurance_number: $('#insurance_number').val(),
                        registration_number: $('#registration_number').val()
                    },
                    function(data, status, jqXHR) { // success callback
                        obj=JSON.parse(data)
                        if(obj.success==true){
                            toastr.success('Bike Edited Successfully');
                            
                        }
                        else{
                            
                            toastr.error(obj.message,'Error');
                         
                        }
                    })

            })
        </script>

</body>

</html>

<!-- /.card -->