<?php
require_once '../../classes/Database.php';
session_start();
$title = 'Search Results';
require_once ('../../classes/Database.php'); 

include (APPROOT . INC . '/header.php');

// include (APPROOT . INC . '/content.php');

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    echo 'You are forbidden! Login first to access this page.<br>You will be redirected to login page in 10 seconds.<br>
    if you dont have an account, please  <a href="register">register</a> and then login.';
    header("refresh:10;url='login'");
    exit;
}
if (isset($_POST['search'])) {
$q = $_POST['search'];
        $sql = "SELECT * FROM `users` WHERE `name` LIKE ?";
        $search = $pdo->prepare($sql);
        
        $search->execute(array("%$q%"));
        if ($search->rowCount() > 0){
            
            echo "<div class='container'>";
            echo "<div class='row justify-content-center'>";
           
            echo '<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">';
            echo "<table class='table table-bordered text-center'>
                <th>
                    ID <td class='col col-lg-4'><strong>Name</strong></td>
                    <td class='col col-lg-4'><strong>Email</strong></td>
                </th>";
            foreach ($search as $row){
           
            echo "<tr>
                    <td class='col col-lg-4'>" . $row["id"] . "</td>
                    <td class='col col-lg-4'>" . $row["name"] . "</td>
                    <td class='col col-lg-4'>" . $row["email"] . "</td>
                </tr>";
        }
        echo "</table>";
    // echo "</ul>";
    echo "</div>";
    echo "</div>";
    }
    else {
        echo "<div class=container>";
        echo '<p class="lead text-center">No results to show.</p>';
        echo "</div>";
    }
    
    echo "</div>";
}  
    include (APPROOT . INC . '/footer.php'); 
    
    