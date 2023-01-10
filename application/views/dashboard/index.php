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

    .dropbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover,
    .dropbtn:focus {
      background-color: #3e8e41;
    }

    /* The search field */
    #myInput {
      box-sizing: border-box;
      background-image: url('searchicon.png');
      background-position: 14px 12px;
      background-repeat: no-repeat;
      font-size: 16px;
      padding: 14px 20px 12px 45px;
      border: none;
      border-bottom: 1px solid #ddd;
    }

    /* The search field when it gets focus/clicked on */
    #myInput:focus {
      outline: 3px solid #ddd;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
      margin-left: 200px;
      height: 40px;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f6f6f6;
      min-width: 230px;

      border: 1px solid #ddd;
      z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    #ch {
      display: none;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #f1f1f1
    }

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {
      display: block;
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
                <div class="dropdown">
                  <!-- <button onclick="myFunction()" class="dropbtn">Search Bike</button> -->
                  <input type="text" placeholder="Search.." id="myInput" onkeyup="myFunction(),filterFunction()">
                  <div id="myDropdown" class="dropdown-content">

                  </div>
                </div>
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
    $.get('<?php echo site_url() ?>api/get/intransit',
      function(data) { // success callback
        obj = JSON.parse(data)
        if (obj.success == true) {
          bikes = obj.data;
          for (index in bikes) {

            let bid = bikes[index].bid
            let name = bikes[index].bike_name
            $('#myDropdown').append($(`<a onclick="goto(${bid})" >${name}</a>`));
          }

        } else {

          toastr.error(obj.message, "Error");

        }
      })

   

    mapboxgl.accessToken = 'pk.eyJ1IjoidW5pbzEyMyIsImEiOiJjbGNscmVyaTkwcDUyM3ByeXNlMzhweHlsIn0.WxsoBTX_qfUojJMKaET4HQ';
    const map = new mapboxgl.Map({
      container: 'map',
      // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
      style: 'mapbox://styles/mapbox/light-v9',
      center: <?php echo "[{$intransarr[0]->longitude},{$intransarr[0]->latitude}]" ?>,
      zoom: 15
    });
    let bikearr=[]
    <?php
    $count = 1;
    foreach ($intransarr as $arr) {
    //   echo "
    // bikearr['{$arr->bid}']['lat']=$arr->latitude;
    // bikearr['{$arr->bid}']['long']=$arr->longitude;";
      echo `let bike_$count = [$arr->longitude,$arr->latitude]\n
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
    map.on('mouseenter', 'marker', () => {
      map.getCanvas().style.cursor = 'pointer';
    });
    function goto(bid) {
      var getvar='bike_'+bid
      map.flyTo({
        center:bikearr['bid']
      });
    }
  </script>
  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
      var input, filter, ul, li, a, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      div = document.getElementById("myDropdown");
      a = div.getElementsByTagName("a");
      for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          a[i].style.display = "";
        } else {
          a[i].style.display = "none";
        }
      }
    }
  </script>


</body>

</html>