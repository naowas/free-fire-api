<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submit'])) {

    $userId = $_POST['user_id'];

    $url = "https://shop.garena.my/api/auth/player_id_login";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = array(
      "app_id" => 100067,
      "login_id" => $userId,
    );
    $jsonData = json_encode($data);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
  }
  $jsonDecode = json_decode($resp, true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Fire API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <form class="row g-12" action="index.php" method="POST">
          <div class="col-auto">
            <label for="user_id" class="visually-hidden">ID</label>
            <input type="text" name="user_id" class="form-control" id="user_id" placeholder="123456" value="<?php echo $_POST['user_id'] ?? ''; ?>">
          </div>
          <div class="col-auto">
            <button type="submit" name="submit" class="btn btn-primary mb-3">Submit</button>
          </div>
        </form>
        <div class="col-md-6">
        <table class="table table-responsive">
          <thead>
            <tr>
              <th class="text-center" scope="col">Region</th>
              <th class="text-center" scope="col">Nick Name</th>
              <th class="text-center" scope="col">Open Id</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php

              if (isset($jsonDecode) && array_key_exists('nickname',$jsonDecode)) {

                echo '<td align="center">' . $jsonDecode['region'] . '</td>';
                echo '<td align="center">' . $jsonDecode['nickname'] . '</td>';
                echo '<td align="center">' . $jsonDecode['open_id'] . '</td>';
              }
            
              elseif (isset($jsonDecode) && array_key_exists('error',$jsonDecode)) {

                echo'<td align="center">' . $jsonDecode['error'] . '</td>';
              }

              ?>


            </tr>
          </tbody>
        </table>
        </div>
      </div>

    </div>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</body>

</html>