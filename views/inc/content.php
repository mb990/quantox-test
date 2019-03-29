<?php
    // checking if user is logged in. If not he is redirected to the login page.
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    echo 'You are forbidden! Login first to access this page.<br>You will be redirected to login page in 10 seconds.<br>
    if you dont have an account, please  <a href="register">register</a> and then login.';
    header("refresh:10;url='login'");
    exit;
}
?>
<?php include '../inc/pageheading.php'; ?>
<div class="row">
      <div class="col">
        <div class="card card-body bg-light mt-5">
          <h2>Dashboard <small class="text-muted"><?php echo $_SESSION['email']; ?></small></h2>
          <p class="lead">Welcome to the dashboard <?php echo $_SESSION['name']; ?></p>
        </div>
      </div>
    </div>
<!-- <div class="container"> -->
    <div class="row justify-content-center">
        <div class="col-offset-4 col-md-4 col-offset-4">
            <form class="form-inline my-2 my-lg-0" method="POST" action="results">
                <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="row">

<?php
    // if something is searched find the results
    if (isset($_POST['search'])) {
        $q = $_POST['search'];
        $sql = "SELECT * FROM `users` WHERE `name` LIKE ?";
        $search = $pdo->prepare($sql);
        
        $search->execute(array("%$q%"));
        // if there are results, echo them out
        if ($search->rowCount() > 0){
            
            echo "<div class=container>";
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
?>

</div>