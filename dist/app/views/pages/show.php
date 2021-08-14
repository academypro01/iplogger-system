<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <script src="../../public/javascript/bootstrap.min.js"></script>
    <script src="../../public/javascript/043f718c75.js" crossorigin="anonymous"></script>

    <title>Data !</title>
    <link rel="shortcut icon" href="../../public/images/fav.webp" type="image/webp">
</head>
<body>

    <div class="container">
        <h1 class="text-center text-light text-responsive">Your data is:</h1>
        <small class='text-light'>Your Link => <?php echo URLROOT."target/add/".$data[0]->target_id; ?></small>
        <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">IP</th>
                <th scope="col">country</th>
                <th scope="col">Region</th>
                <th scope="col">City</th>
                <th scope="col">Time Zone</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">ISP</th>
                <th scope="col">OS</th>
                <th scope="col">Browser</th>
                <th scope="col">Device</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody class="bg-light">
            <?php
                $counter = 0;
                    foreach($data as $info):
                        $counter++;
                ?>
              <tr>
                <th scope="row"><?php echo $counter;  ?></th>
                <td><?php echo $info->ip_address;  ?></td>
                <td><?php echo $info->country;  ?></td>
                <td><?php echo $info->region_name;  ?></td>
                <td><?php echo $info->city;  ?></td>
                <td><?php echo $info->time_zone;  ?></td>
                <td><?php echo $info->lat;  ?></td>
                <td><?php echo $info->lon;  ?></td>
                <td><?php echo $info->isp;  ?></td>
                <td><?php echo $info->os;  ?></td>
                <td><?php echo $info->browser;  ?></td>
                <td><?php echo $info->device;  ?></td>
                <td><?php echo $info->date;  ?></td>
              </tr>
              <?php
                endforeach;
              ?>
            </tbody>
          </table>
        </div>
    </div>


    <!-- javascript Files  -->
    <script src="../../public/javascript/jquery-3.3.1.slim.min.js"></script>
    <script src="../../public/javascript/popper.min.js"></script>
</body>
</html>