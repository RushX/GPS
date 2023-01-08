<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Trip | BikerZ</title>
    <?php $this->load->view('template/css') ?>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            position: relative;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
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
                            <h1>Add Trip</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Trip</li>
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
                                    <h3 class="card-title">New Trip</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="bike_name">Select Bike</label>
                                            <select class="form-control" name='bid' id="bid">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="RouteInfo">Route Information</label>
                                            <br>
                                            <button type="button" id='mapsrc' class="btn btn-primary" onclick="">Choose Source On Map</button>
                                            <input type="text" class="form-control" id="source_long" placeholder="Enter Starting Longitude"><br>
                                            <input type="text" class="form-control" id="source_lat" placeholder="Enter Starting Latitude"><br>
                                            <button type="button" id='mapdest' class="btn btn-primary" onclick="">Choose Destination On Map</button>
                                            <input type="text" class="form-control" id="dest_long" placeholder="Enter Destination Longitude"><br>
                                            <input type="text" class="form-control" id="dest_lat" placeholder="Enter Destination Latitude"><br>
                                            <label for="address">Address Information</label>
                                            <input type="text" class="form-control" id="source_address" placeholder="Enter Source Address in text"><br>
                                            <input type="text" class="form-control" id="dest_address" placeholder="Enter Destination Address in text"><br>

                                        </div>
                                        <p class="" id="status"></p>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="button" id='submitFinal' class="btn btn-primary">Enroute Bike</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="SourceMapHold" tabindex="-1" role="dialog" aria-labelledby="EditBikeTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditBikeTitle">Edit Source Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id='SourceMap' style='width: 100%; height: 400px;'></div>
                                <input type="text" id="SourceMapLon"></input>
                                <input type="text" id="SourceMapLat"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id='submit' onclick=setsrc() class="btn btn-primary">Set Source</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="DestinationMapHold" tabindex="-1" role="dialog" aria-labelledby="EditBikeTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditBikeTitle">Edit Destination Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id='DestinationMap' style='width: 100%; height: 400px;'></div>
                                <input type="text" id="DestinationMapLon"></input>
                                <input type="text" id="DestinationMapLat"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id='submit' onclick=setdest() class="btn btn-primary">Set Destinaion</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoidW5pbzEyMyIsImEiOiJjbGNscml3N2kxdmJpM25xdTdueWRsbzZ1In0.QC4d2Er0mmY38kzHamIG1g';
                    var srcmap = new mapboxgl.Map({
                        container: 'SourceMap',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [78.48, 17.38],
                        zoom: 10
                    });
                    srcmap.on('click', (e) => {
                        document.getElementById('SourceMapLat').value = JSON.stringify(e.lngLat.lat);
                        document.getElementById('SourceMapLon').value = JSON.stringify(e.lngLat.lng);
                    });
                    var destmap = new mapboxgl.Map({
                        container: 'DestinationMap',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [78.48, 17.38],
                        zoom: 10
                    });
                    destmap.on('click', (e) => {
                        document.getElementById('DestinationMapLat').value = JSON.stringify(e.lngLat.lat);
                        document.getElementById('DestinationMapLon').value = JSON.stringify(e.lngLat.lng);

                    });
                </script>
        </div>
        <?php $this->load->view('template/footer', $data = ['active' => 'bikes']) ?>
        <script>
            $.get('<?php echo site_url() ?>api/get/standby',
                function(data) { // success callback
                    obj = JSON.parse(data)
                    if (obj.success == true) {
                        bikes = obj.data;
                        for (index in bikes) {

                            let bid = bikes[index].bid
                            let name = bikes[index].bike_name
                            $('#bid').append($('<option>', {
                                value: bid,
                                text: name
                            }));
                        }


                    } else {

                        toastr.error(obj.message, "Error");

                    }

                })

            $('#mapsrc').click(() => {
                $('#SourceMapHold').modal('show');
            })
            $('#mapdest').click(() => {
                $('#DestinationMapHold').modal('show');
            })
            $('#submitFinal').click(() => {
                $.post('<?php echo site_url() ?>api/enroute',

                    {
                        bid: $('#bid').val(),
                        source_latitude: $('#source_lat').val(),
                        source_longitude: $('#source_long').val(),
                        source_address: $('#source_address').val(),
                        destination_latitude: $('#dest_lat').val(),
                        destinaion_longitude: $('#dest_long').val(),
                        destinaion_address: $('#dest_address').val()
                    },
                    function(data, status, jqXHR) { // success callback
                        obj = JSON.parse(data)
                        if (obj.success == true) {
                            toastr.success('Bike Edited Successfully');

                        } else {

                            toastr.error(obj.message, 'Error');

                        }
                    })

            })

            function setsrc() {
                $('#SourceMapHold').modal('hide');
                $("#source_lat").val($("#SourceMapLat").val())
                $("#source_long").val($("#SourceMapLon").val())

            }

            function setdest() {
                $('#DestinationMapHold').modal('hide');

                $("#dest_lat").val($("#DestinationMapLat").val())
                $("#dest_long").val($("#DestinationMapLon").val())
            }
        </script>


</body>

</html>

<!-- /.card -->