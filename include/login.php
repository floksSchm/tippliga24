<?php
  session_start();
  include_once ("connect.php");
  if(isset($_POST['login'])) {
    $team = mysqli_real_escape_string($conn,$_POST['team']);
    $passwort = mysqli_real_escape_string($conn,$_POST['passwort']);


    $query_user = mysqli_query($conn,'SELECT * FROM benutzer INNER JOIN tipper_liga ON benutzer.liga_id = tipper_liga.liga_id WHERE team = "'.$team.'"');
    if(mysqli_num_rows($query_user) == 1) {
      while($result = mysqli_fetch_assoc($query_user)) {

        if(password_verify($passwort,$result['kennwort']) && $team == $result['team']) {

          $_SESSION['id'] = $result['benutzer_id'];
          $_SESSION['vorname'] = $result['vorname'];
          $_SESSION['name'] = $result['nachname'];
          $_SESSION['email'] = $result['email'];
          $_SESSION['liga_name'] = $result['liga_name'];
          $_SESSION['team'] = $team;
          $_SESSION['liga_id'] = $result['liga_id'];
          $_SESSION['admin'] = intval($result['admin']);
          $_SESSION['pokal'] = intval($result['pokal']);

          $_SESSION['login'] = true;

          header('Location: /index.php');
          exit();
        } elseif (!password_verify($passwort,$result['kennwort']) || !$query_user) {
          header('Location: /index.php?fail=1');
        }
      }
    } else {
      header('Location: /index.php?fail=1');
    }
    
  }
?>