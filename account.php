<?php
   session_start();
   require 'db.php';
   
   if (!isset($_SESSION['user_id'])) {
       header("Location: index.php");
       exit();
   }
   
   $user_id = $_SESSION['user_id'];
   
   $stmt = $pdo->prepare("SELECT email, username FROM users WHERE id = ?");
   $stmt->execute([$user_id]);
   $user = $stmt->fetch();
   
   
   if (!$user) {
       exit();
   }
   
   if (isset($_SESSION['username'])) {
       $username = $_SESSION['username'];
   } else {
       $username = ''; 
   }
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
       if (isset($_POST['update_email'])) {
           $new_email = $_POST['email'];
           $update_email_stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
           $update_email_stmt->execute([$new_email, $user_id]);
           $_SESSION['message'] = "Email updated successfully!";
       }
   
       if (isset($_POST['change_password'])) {
           $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
           $update_password_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
           $update_password_stmt->execute([$new_password, $user_id]);
           $_SESSION['message'] = "Password updated successfully!";
       }
   
       header("Location: " . $_SERVER['PHP_SELF']); 
   
       exit();
       }
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Account</title>
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
         .btn-tab {
         color: #fff;
         background-color: #333;
         border-color: transparent;
         border-radius: 5px;
         padding: 10px 20px;
         margin-left: 5px;
         }
         .btn-tab:hover {
         background-color: #555;
         border: none;
         color: lightgray;
         }
         .btn-tab.active {
         background-color: #555;
         border-color: transparent;
         }
         .tab-pane {
         background-color: #1e1e1e;
         padding: 5px;
         border-radius: 5px;
         margin-top: 10px;
         }
         .nav-tabs {
         border-bottom: none;
         }
         .form-control::placeholder {
         color: gray;
         opacity: 1;
         }
         .editor-area {
         width: 100%;
         height: 300px;
         background-color: #333;
         color: lightgray;
         font-size: 16px;
         border: none;
         padding: 10px;
         border-radius: 9px;
         }
         .editor-area::focused {
         border: none;
         }
         :root {
         scrollbar-color: #222 #333;
         }
         .select-input.form-control[readonly]:not([disabled]) {
         background: white;
         }
         .select-input {
         color: white;
         }
         .select-arrow {
         color: white;
         }
         .btn-custom:hover {
         background-color: #2e2e2e;
         }
         .btn-custom {
         background-color: #333;
         border: none; 
         color: white; 
         font-size: 18px;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #1e1e1e;">
         <div class="container">
            <a class="navbar-brand" href="#">Account</a>
            <div class="collapse navbar-collapse justify-content-end">
               <a href="filemanager.php" class="btn btn-custom">Back to File Manager</a>
            </div>
         </div>
      </nav>
      <div class="wrapper">
         <div class="content container mt-5">
            <p></p>
            <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <div class="card">
               <div class="card-body">
                  <h1 class="text-center">User Info</h1>
                  <p></p>
                  <form action="filemanager.php" method="POST">
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required style="background-color: #333; border: none; color: white; font-size: 18px;">
                     </div>
                     <button type="submit" name="update_email" class="btn btn-custom">Update Email</button>
                  </form>
                  <form action="filemanager.php" method="POST" class="mt-3">
                     <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required style="background-color: #333; border: none; color: white; font-size: 18px;">
                     </div>
                     <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required style="background-color: #333; border: none; color: white; font-size: 18px;">
                     </div>
                     <button type="submit" name="change_password" class="btn btn-custom">Change Password</button>
                  </form>
                  <p></p>
                  <a href="logout.php" class="btn btn-custom">Logout</a>
               </div>
            </div>
         </div>
      </div>
      </div>
      </div>
   </body>
</html>