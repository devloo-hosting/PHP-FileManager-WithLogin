<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <style>
         html, body {
         height: 100%;
         background-color: #121212;
         color: #ffffff;
         }
         .wrapper {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         }
         .content {
         flex: 1;
         }
         .card {
         background-color: #1e1e1e;
         color: #ffffff;
         border: none;
         }
         .footer {
         background: #000;
         padding: 10px 0;
         text-align: center;
         }
         .btn-hover:hover {
         background-color: #2e2e2e;
         }
         .btn-hover {
         background-color: #333;
         border: none; 
         color: white; 
         font-size
      </style>
   </head>
   <body>
      <div class="wrapper">
         <div class="content d-flex align-items-center justify-content-center">
            <div class="card p-4 shadow-sm" style="width: 400px;">
               <h3 class="text-center">Register</h3>
               <?php
                  if (isset($_SESSION['error'])) {
                      echo '<div class="alert alert-danger text-center">'.$_SESSION['error'].'</div>';
                      unset($_SESSION['error']);
                  }
                  ?>
               <form action="process_register.php" method="POST">
                  <div class="mb-3">
                     <label for="email" class="form-label">Email</label>
                     <input type="email" name="email" class="form-control" style="background-color: #333; border: none; color: white; font-size: 18px;" required>
                  </div>
                  <div class="mb-3">
                     <label for="username" class="form-label">Username</label>
                     <input type="text" name="username" class="form-control" style="background-color: #333; border: none; color: white; font-size: 18px;" required>
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" name="password" class="form-control" style="background-color: #333; border: none; color: white; font-size: 18px;" required>
                  </div>
                  <div class="mb-3">
                     <label for="confirm_password" class="form-label">Confirm Password</label>
                     <input type="password" name="confirm_password" class="form-control" style="background-color: #333; border: none; color: white; font-size: 18px;" required>
                  </div>
                  <button type="submit" class="btn btn-hover w-100">Register</button>
               </form>
               <p></p>
               <a class="btn btn-hover" href="index.php">Already have an account? Login here.</a>
            </div>
         </div>
      </div>
   </body>
</html>