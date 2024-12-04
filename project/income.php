<?php
include('db.php');
if(isset($_POST['submit'])){
  $amount = mysqli_real_escape_string($conn, $_POST['amount']);
  $source =  mysqli_real_escape_string($conn, $_POST['source']);


 $sql = "INSERT INTO tabungan (amount, source, type) VALUES ('$amount', '$source', 'income')";

 if (mysqli_query($conn, $sql)) {
     echo "<script>alert('New record created successfully')
     window.location.href='income.php';</script>";
 } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
 }
}

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>KAMEL BILA MONEY</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h1>Kamel Bila <span>Money</span> 💸</h1>
      </div>
      
      <a href="index.php" class="menu dashboard" style="text-decoration: none;">
      <div  id="dashboard">
        <i class="fas fa-piggy-bank"></i> dashboard
      </div>
      </a>
      <a href="income.php" class="menu incomes" style="text-decoration: none;">
      <div  id="incomes">
        <i class="fas fa-piggy-bank"></i> Incomes
      </div>
      </a>
      <a href="spendings.php" class="menu spendings" style="text-decoration: none;">
      <div  id="spendings">
        <i class="fas fa-piggy-bank"></i> spendings
      </div>
      </a>
      <a href="settings.php" class="menu settings" style="text-decoration: none;">
      <div  id="settings">
        <i class="fas fa-piggy-bank"></i> settings
      </div>
      </a>
    </div>
    <!-- End Sidebar -->

    <!-- Dashboard Content -->
    <div class="main-dashboard" id="main-dashboard">
      <!-- Dashboard Title -->
      <div class="user-title">
        <p class="kamel-title">
          Kamel Bila <span class="money-text">Money</span>
        </p>
      </div>
      <form action="income.php" method="post" >
      <div>
        <input type="text" name="amount" placeholder="Amount">
        
        <select name="source" required>
            <option value="" selected disabled>Source</option>
            <option value="Salary">Salary</option>
            <option value="Investasi">Investasi</option>
            <option value="Bisnis">Bisnis</option>
            <option value="Other">Other</option>
          </select>
          <button type="submit" name="submit">Submit</button>
      </div>
      </form>

      <!-- Income Progress Box -->
      <div class="white-large-box incomes-progress clearfix">
        <p>Income Progress</p>
        <div class="circle-container">
          <!-- Salary -->
          <div class="round salary" data-value="0.6">
            <strong></strong>
            <span>Salary</span>
          </div>

          <!-- Investasi -->
          <div class="round investasi" data-value="0.2">
            <strong></strong>
            <span>Investasi</span>
          </div>

          <!-- Bisnis -->
          <div class="round bisnis" data-value="0.2">
            <strong></strong>
            <span>Bisnis</span>
          </div>
        </div>
      </div>

      <table class="table">
        <thead>
        <tr>
            <th>Amount</th>
            <th>Date</th>
            <th>Source</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        
        <tbody>

<?php
    $sql = "SELECT * FROM tabungan WHERE type = 'Income'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            ?>
    
        <tr>
            <td><?php echo $row["amount"] ?></td>
            <td><?php echo $row["date"] ?></td>
            <td><?php echo $row["source"] ?></td>
            <td><a href="delete.php?id=<?php echo $row["id"] ?>">Delete</a></td>
            <td><a href="edit.php?id=<?php echo $row["id"] ?>">Edit</a></td>
        </tr>

        
        <?php
        }
    } else {
        echo "0 results";
    }


    ?>


</tbody>
          
      </table>
    </div>
    <!-- End Dashboard -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <script src="script.js"></script>
  </body>
