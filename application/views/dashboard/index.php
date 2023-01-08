<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | GPS</title>

  <?php $this->load->view('template/css') ?>
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
  <style>
    .mapboxgl-marker {
      background-image: url('<?php echo base_url() ?>public/admin/dist/img/motorcycle.png');
      background-size: cover;
      width: 50px;
      height: 50px;
      cursor: pointer;
    }

    #marker2 {
      background-image: url('<?php echo base_url() ?>public/admin/dist/img/motorcycle.png');
      background-size: cover;
      width: 50px;
      height: 50px;
      cursor: pointer;
    }

    .mapboxgl-popup {
      max-width: 200px;
    }
  </style>
</head> <!-- `body` tag options: Apply one or more of the following classes to to the body tag to get the desired effect * sidebar-collapse * sidebar-mini -->

<body class="hold-transition layout-fixed sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('template/nav') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $data['all'] ?></h3>
                  <p>Total Bikes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $data['intransit'] ?></h3>

                  <p>Intransit</p>
                </div>
                <div class="icon">
                  <i class="fa  fa-location-arrow"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $data['standby'] ?></h3>
                  <p>Standby</p>
                </div>
                <div class="icon">
                  <i class="fa fa-power-off"></i>
                </div>
              </div>
            </div> <!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
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
                <div id="map" style='width: 100%; height: 400px;'></div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <?php $intransarr = $data['info'];

  ?>
  <!-- /.content-wrapper -->
  <?php $this->load->view('template/footer', $data = ['active' => 'header']) ?>


  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoidW5pbzEyMyIsImEiOiJjbGNscmVyaTkwcDUyM3ByeXNlMzhweHlsIn0.WxsoBTX_qfUojJMKaET4HQ';
    const map = new mapboxgl.Map({
      container: 'map',
      // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
      style: 'mapbox://styles/mapbox/light-v9',
      center: <?php echo "[{$intransarr[0]->longitude},{$intransarr[0]->latitude}]"?>,
      zoom: 15
    });
    <?php
    $count = 1;
    foreach ($intransarr as $arr) {
      echo `const bike_$count = [$arr->longitude,$arr->latitude]\n
          const popup_$count = new mapboxgl.Popup({\n
            offset: 25\n
          }).setText(\n
            'Bike Id: $arr->bid Battery Status:$arr->battery Created At: $arr->createdat Updated At: $arr->updatedat'
          );\n
          const el_$count = document.createElement('div');
      el_$count.id = 'marker_$count';\n
      el_$count.class = 'marker';\n
      new mapboxgl.Marker(el_$count)\n
      .setLngLat( bike_$count)\n
      .setPopup(popup_$count) \n
      .addTo(map);`;

      echo "const bike_$count = [$arr->longitude,$arr->latitude]\nconst popup_$count = new mapboxgl.Popup({\noffset: 25\n}).setText(\n'Bike Id: $arr->bid Battery Status: $arr->battery Created At: $arr->createdat Updated At: $arr->updatedat'\n);\nconst el_$count = document.createElement('div');\n el_$count.id = 'marker_$count';\n new mapboxgl.Marker(el_$count)\n .setLngLat( bike_$count)\n .setPopup(popup_$count) \n .addTo(map);\n";
      $count++;
    }
    ?>

    // // create the popup
    // const popup = new mapboxgl.Popup({
    //   offset: 25
    // }).setText(
    //   'Construction on the Washington Monument began in 1848.'
    // );
    // const popup2 = new mapboxgl.Popup({
    //   offset: 25
    // }).setText(
    //   'Construction on the Washington Monument began in 1848.'
    // );

    // // create DOM element for the marker
    // const el = document.createElement('div');
    // el.id = 'marker';
    // const el2 = document.createElement('div');
    // el2.id = 'marker2';

    // // create the marker
    // new mapboxgl.Marker(el)
    //   .setLngLat(monument)
    //   .setPopup(popup) // sets a popup on this marker
    //   .addTo(map);
    // new mapboxgl.Marker(el2)
    //   .setLngLat(monument2)
    //   .setPopup(popup2) // sets a popup on this marker
    //   .addTo(map);
  </script>
</body>

</html>