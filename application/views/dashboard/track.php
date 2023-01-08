<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bike | BikerZ </title>
    <?php $this->load->view('template/css') ?>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
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
                            <h1>Track Bikes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Track Bikes</li>
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
                        <h3 class="card-title">Intransit Bikes</h3>

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
                                        Transit Id
                                    </th>
                                    <th style="width: 15%">
                                        Bike Id
                                    </th>
                                    <th style="width: 20%">
                                        Created At
                                    </th>
                                    <th style="width: 20%" >
                                        Updated At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $key => $row) {
                                    echo '<tr>';
                                    echo '<td>#</td>';
                                    echo '<td><a id="' . $row->bid . '_name">'
                                        . $row->tid . '
                                </a>
                                <br />
                                <small id="' . $row->bid . '_user">
                                ' . $row->createdat . '
                                </small></td>';
                                    echo '<td id="' . $row->bid . '_bid">' . $row->bid . '</td>';
                                    echo '<td id="' . $row->bid . '_type">' . $row->createdat . '</td>';
                                    echo '<td id="' . $row->bid . '_status">' . $row->updatedat . '</td>';
                                    echo '<td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" onclick=Locate(' . $row->bid . ')>
                                        Locate
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
        <div class="modal fade" id="locateModal" tabindex="-1" role="dialog" aria-labelledby="EditBikeTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditBikeTitle">Edit Destination Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id='Map' style='width: 100%; height: 400px;'></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id='submit' onclick=setdest() class="btn btn-primary">Set Destinaion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('template/footer', $data = ['active' => 'live']) ?>
    <script>
        $.get('<?php echo site_url() ?>api/get/intransit',
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

        function Locate(bid) {
            $('#locateModal').modal('show')
            $.post('<?php echo site_url() ?>api/locate/', {
                    bid: bid
                },
                function(data, status, jqXHR) { // success callback
                    obj = JSON.parse(data)
                    if (obj.success == true) {
                        toastr.success('Data');
                        latitude = (obj.data[0].latitude);
                        longitude = (obj.data[0].longitude);
                        mapboxgl.accessToken = 'pk.eyJ1IjoidW5pbzEyMyIsImEiOiJjbGNscml3N2kxdmJpM25xdTdueWRsbzZ1In0.QC4d2Er0mmY38kzHamIG1g';
                        var map = new mapboxgl.Map({
                            container: 'Map',
                            style: 'mapbox://styles/mapbox/streets-v11',
                            center: [longitude, latitude],
                            zoom: 10
                        });
                        const marker = new mapboxgl.Marker()
                            .setLngLat([longitude, latitude])
                            .addTo(map);


                    } else {

                        toastr.error(obj.message, "Error");
                        document.getElementById('status').innerHTML = obj.message;

                    }
                })
        }
    </script>

</body>

</html>