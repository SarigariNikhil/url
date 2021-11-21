<?php 

session_start();

include "conn.php";

if (isset($_POST['submit']) && isset($_POST['long_url'])) {
    $url = $_POST['long_url'];
    $headers = @get_headers($url);
    

    if($headers && strpos( $headers[0], '200')) {
        $sql = "SELECT short_code FROM urls_list WHERE long_url = '".$url."'";
        $res = mysqli_query($conn,  $sql);
        header('Location: index.php');
        
        if (mysqli_num_rows($res) > 0){
            $_SESSION['present']="Already Present:";
            while ($sht = mysqli_fetch_assoc($res)){
                echo "sht =".$sht['short_code'];
                $_SESSION['short_url']=$sht['short_code'];
                $_SESSION['long_url']=$url;
                echo $_SESSION['short_url'].' '.$_SESSION['long_url'];
            }
        }
        else{

            $code = substr(uniqid(),7,12);
            $sql1 = "SELECT id FROM urls_list WHERE short_code = '".$code."'";
            $res = mysqli_query($conn,  $sql1);
            if (mysqli_num_rows($res) > 0){
                $_SESSION['err']="Unknown Error Occured try Once more";
            }
            else{
                $sql2 = "INSERT INTO urls_list (long_url, short_code)
                VALUES ('".$url."','".$code."');";
                if(mysqli_query($conn,  $sql2)){
                    $_SESSION['short_url']=$code;
                    $_SESSION['long_url']=$url;
                }
                echo mysqli_errno($conn);
            }
        } 
        
    }
    else {
        echo '<script type="text/javascript">'; 
        echo 'alert("URL Does not exists");'; 
        echo 'window.history.back();';
        echo '</script>';
    }
}
else{
    echo '<script type="text/javascript">'; 
    echo 'alert("Not Entered");'; 
    echo 'window.history.back();';
    echo '</script>';
}
?>