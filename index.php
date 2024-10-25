<?php
if(isset($_POST['login'])){
  session_start();
  include 'koneksi.php';
  $username = $_POST['username'];
  $password = $_POST['password'];

  $login  = mysqli_query($koneksi,"SELECT * FROM data_user WHERE username = '$username' AND password = '$password'");
  $cek    = mysqli_num_rows($login);

  if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    if($data['level'] == "Admin"){
      $_SESSION['login']   = "Login";
      $_SESSION['id']      = $data['id_user'];
      $_SESSION['nama']    = $data['nama_user'];
      echo "<script>alert('Login Berhasil! Selamat Datang');window.location='admin/index.php'</script>";

    }elseif($data['level'] == "User"){
      $_SESSION['login']   = "Login";
      $_SESSION['id']      = $data['id_user'];
      $_SESSION['nama']    = $data['nama_user'];
      echo "<script>alert('Login Berhasil! Selamat Datang');window.location='user/index.php'</script>";
    }
    
  }else{
    echo "<script>alert('Login Gagal!Username dan Password Tidak Ditemukan');window.location='index.php'</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="assets/images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Sistem Forecasting Penjualan <br> Trend Moment</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
            <form action="" method="POST" id="login" onsubmit="return validasi()">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" id="username" name="username" placeholder="Masukkan Username" autocomplete="off" autofocus>
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="off">
                </div>
                <div class="button input-box">
                  <input type="submit" name="login" value="Login">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script>
    function validasi(){
      var username = document.getElementById('username');
      var password = document.getElementById('password');

      if (harusDiisi(username, "Username Wajib Diisi")) {
        if (harusDiisi(password, "Password Wajib Diisi")) {
          return true;
        };
      };
      return false;
    }

    function harusDiisi(att, msg){
      if (att.value.length == 0) {
        alert(msg);
        att.focus();
        return false;
      }
      return true;
    }
  </script>

</html>
