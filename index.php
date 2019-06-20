<?PHP session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>學生包裹自助查詢系統</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

  <!-- Custom styles for this template -->
</head>

<body>

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <?php
        if(isset($_SESSION["account"]) && !empty($_SESSION["account"])){
            if($_SESSION["account"] == "admin"){
                echo '<a class="btn btn-outline-primary" href="logout.php">Logout</a>';
                echo '<a class="btn btn-outline-danger" href="admin.php">Control Pannel</a>';
            }
            else
                echo '<a class="btn btn-outline-primary" href="logout.php">Logout</a>';
        }
        else
            echo '<a class="btn btn-outline-primary" href="login.html">Sign in</a>';
    ?>
  </div>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">學生包裹自助查詢系統</h1>
    <p class="lead">在這裡，你可以輕鬆查看到。</p>
  </div>

  <div class="container">
    <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th>宿舍</th>
          <th>收件人姓名</th>
          <th>郵寄公司</th>
          <th>種類</th>
          <th>系級</th>
          <th>收件天數</th>
        </tr>
      </thead>
      <tbody>
          <?php
            include 'mysqlCon.php';
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT * FROM `package` ORDER BY `recDays` ASC';
                $result = $conn->query($sql);
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    //PDO::FETCH_OBJ 指定取出資料的型態
                    echo '<tr>';
                    echo '<td>'.$row->dorm.'</td>';
                    echo '<td>'.$row->name.'</td>';
                    echo '<td>'.$row->company.'</td>';
                    echo '<td>'.$row->type.'</td>';
                    echo '<td>'.$row->department.'</td>';
                    echo '<td>'.$row->recDays.'</td>';
                    echo '</tr>';
                }
            } catch (PDOException $e) {
                echo $sql.'<br>'.$e->getMessage();
            }
          $conn = null;
          ?>
      </tbody>
    </table>
  </div>
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
    </footer>
  </div>


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <!-- <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script> -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>

  <script>
    Holder.addTheme('thumb', {
      bg: '#55595c',
      fg: '#eceeef',
      text: 'Thumbnail'
    });
  </script>
</body>

</html>