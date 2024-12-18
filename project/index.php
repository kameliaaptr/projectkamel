
<?php
include('db.php');

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

      <!-- Month Dropdown -->
      <select class="form-select" aria-label="Default select example" style="border-color: #dd0b8c; border-width: 2px;">
        <option selected>Pilih Bulan</option>
        <option value="1">Januari</option>
        <option value="2">Febuari</option>
        <option value="3">Maret</option>
        <option value="3">April</option>
        <option value="3">Mei</option>
        <option value="3">Juni</option>
        <option value="3">Juli</option>
        <option value="3">Agustus</option>
        <option value="3">September</option>
        <option value="3">Oktober</option>
        <option value="3">November</option>
        <option value="3">Desember</option>
      </select>

      <!-- Total Balance Box -->
      <div
        class="white-small-box total-balance clearfix"
        style="margin-top: 20px"
      >
        <p>Total Balance</p>
        <h2>Rp. 10.000.000</h2>
      </div>

      <!-- Target Savings Box -->
      <div class="white-small-box target-savings clearfix">
        <p>Target Savings</p>
        <h2>Rp. 100.000.000</h2>
      </div>

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

      <!-- Spending Progress Box -->
      <div class="white-large-box spendings-progress clearfix">
        <p>Spending Progress</p>
        <div class="circle-container">
          <!-- Top Up Valorant -->
          <div class="round valorant" data-value="0.3">
            <strong></strong>
            <span>Top Up Valorant</span>
          </div>

          <!-- Beli Skincare -->
          <div class="round skincare" data-value="0.4">
            <strong></strong>
            <span>Beli Skincare</span>
          </div>

          <!-- Bayar Kost -->
          <div class="round kost" data-value="0.3">
            <strong></strong>
            <span>Bayar Kost</span>
          </div>
        </div>
      </div>
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