<?php
include 'config.php'; // Include your database connection file

// Delete user if requested
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    // Delete the user from the database
    $delete = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete->execute([$user_id]);

    if ($delete) {
        header("Location: Accounts.php"); // Refresh the page to reflect the changes
        exit();
    }
}

// Ban user if requested
if (isset($_GET['ban'])) {
    $ban_id = $_GET['ban'];

    // Set the 'banned' status to 1 for the user
    $ban = $conn->prepare("UPDATE `users` SET banned = 1 WHERE id = ?");
    $ban->execute([$ban_id]);

    if ($ban) {
        header("Location: Accounts.php"); // Refresh the page to reflect the changes
        exit();
    }
}

// Unban user if requested
if (isset($_GET['unban'])) {
    $unban_id = $_GET['unban'];

    // Set the 'banned' status to 0 for the user
    $unban = $conn->prepare("UPDATE `users` SET banned = 0 WHERE id = ?");
    $unban->execute([$unban_id]);

    if ($unban) {
        header("Location: Accounts.php"); // Refresh the page to reflect the changes
        exit();
    }
}

// Update user if form is submitted
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    // If there's a new image, move it to the folder
    if ($image) {
        move_uploaded_file($image_tmp_name, $image_folder);
        // Update the image
        $update = $conn->prepare("UPDATE `users` SET name = ?, email = ?, user_type = ?, image = ? WHERE id = ?");
        $update->execute([$name, $email, $user_type, $image, $id]);
    } else {
        // No new image, just update the name, email, and role
        $update = $conn->prepare("UPDATE `users` SET name = ?, email = ?, user_type = ? WHERE id = ?");
        $update->execute([$name, $email, $user_type, $id]);
    }

    if ($update) {
        header("Location: Accounts.php"); // Reload the page to show updated info
        exit();
    }
}

// Prepare the query to fetch all users from the 'users' table
$query = $conn->prepare("SELECT * FROM `users`");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 my-2" id="sidenav-main" style="background-color: #2e59d9;">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/dashboard.php">
      <i class="material-symbols-rounded opacity-5">dashboard</i>
      <span class="nav-link-text ms-1">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/tables.html">
      <i class="material-symbols-rounded opacity-5">table_view</i>
      <span class="nav-link-text ms-1">Tables</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/Accounts.php">
      <i class="material-symbols-rounded opacity-5">receipt_long</i>
      <span class="nav-link-text ms-1">Accounts</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/virtual-reality.html">
      <i class="material-symbols-rounded opacity-5">view_in_ar</i>
      <span class="nav-link-text ms-1">Virtual Reality</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/rtl.html">
      <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
      <span class="nav-link-text ms-1">RTL</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/notifications.html">
      <i class="material-symbols-rounded opacity-5">notifications</i>
      <span class="nav-link-text ms-1">Notifications</span>
    </a>
  </li>
  <li class="nav-item mt-3">
    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
  </li>
  <li class="nav-item">
    <a class="nav-link active bg-gradient-dark text-white" href="../pages/profile.php">
      <i class="material-symbols-rounded opacity-5">person</i>
      <span class="nav-link-text ms-1">Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/login.php">
      <i class="material-symbols-rounded opacity-5">login</i>
      <span class="nav-link-text ms-1">Sign In</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pages/register.php">
      <i class="material-symbols-rounded opacity-5">assignment</i>
      <span class="nav-link-text ms-1">Sign Up</span>
    </a>
  </li>
</ul>


    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn btn-outline-dark mt-4 w-100" href="../pages/admin_profile_update.php" type="button">Update profile</a>
        <!-- <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> -->
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Accounts</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-material-dashboard">Online Builder</a>
            </li>
            <li class="mt-1">
              <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-symbols-rounded">notifications</i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6 mb-xl-0 mb-4">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/illustrations/pattern-tree.svg" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-symbols-rounded text-white p-2">wifi</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                          <h6 class="text-white mb-0">Jack Peterson</h6>
                        </div>
                        <div>
                          <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                          <h6 class="text-white mb-0">11/22</h6>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="row">
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">account_balance</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Salary</h6>
                      <span class="text-xs">Belong Interactive</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">+$2000</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">account_balance_wallet</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Paypal</h6>
                      <span class="text-xs">Freelance Payment</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">$455.00</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="card-header pb-0 px-3" style="padding-top: 30px;">
    <h6 class="mb-0">User Information</h6>
</div>

<?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <div class="row">
            <div class="col-md-7 mt-4">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <!-- User Image on the left side -->
                                <div class="me-3">
                                    <img src="uploaded_img/<?php echo htmlspecialchars($user['image']); ?>" alt="User Image" style="width: 60px; height: 60px; border-radius: 50%;">
                                </div>

                                <!-- User Details -->
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm"><?php echo htmlspecialchars($user['name']); ?></h6> <!-- Display user name -->
                                    <span class="mb-2 text-xs">Email: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo htmlspecialchars($user['email']); ?></span></span>
                                    <span class="text-xs">Role: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo htmlspecialchars($user['user_type']); ?></span></span>
                                    <span class="text-xs">Status: 
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            <?php echo $user['banned'] == 1 ? 'Banned' : 'Active'; ?>
                                        </span>
                                    </span>
                                </div>

                                <!-- Actions (Edit, Delete, Ban, Unban) -->
                                <div class="ms-auto text-end">
                                    <!-- Edit Button -->
                                    <a class="btn btn-link text-dark px-3 mb-0" href="#editModal-<?php echo $user['id']; ?>" data-bs-toggle="modal">
                                        <i class="material-symbols-rounded text-sm me-2">edit</i>Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="material-symbols-rounded text-sm me-2">delete</i>Delete
                                    </a>

                                    <!-- Ban/Unban Buttons -->
                                    <?php if ($user['banned'] == 0): ?>
                                        <a class="btn btn-link text-warning px-3 mb-0" href="?ban=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to ban this user?');">
                                            <i class="material-symbols-rounded text-sm me-2">block</i>Ban
                                        </a>
                                    <?php else: ?>
                                        <a class="btn btn-link text-success px-3 mb-0" href="?unban=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to unban this user?');">
                                            <i class="material-symbols-rounded text-sm me-2">check_circle</i>Unban
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-4">
                <!-- Additional content can go here if needed -->
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


        <!-- Modal for Editing User -->
        <div class="modal fade" id="editModal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                    <div class="modal-header" style="background-color: #f8f9fa; padding: 15px;">
                        <h5 class="modal-title" id="editModalLabel" style="font-weight: bold;">Edit User Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <form action="billing.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            
                            <!-- Styled Input for Name -->
                            <div style="display: flex; align-items: center;">
                                <label for="name" style="width: 100px; font-weight: bold;">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                            
                            <!-- Styled Input for Email -->
                            <div style="display: flex; align-items: center;">
                                <label for="email" style="width: 100px; font-weight: bold;">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                            
                            <!-- Styled Select for Role -->
                            <div style="display: flex; align-items: center;">
                                <label for="user_type" style="width: 100px; font-weight: bold;">Role</label>
                                <select id="user_type" name="user_type" required style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                                    <option value="admin" <?php echo $user['user_type'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="user" <?php echo $user['user_type'] == 'user' ? 'selected' : ''; ?>>User</option>
                                </select>
                            </div>
                            
                            <!-- Styled Input for Image -->
                            <div style="display: flex; align-items: center;">
                                <label for="image" style="width: 100px; font-weight: bold;">Image</label>
                                <input type="file" id="image" name="image" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                            
                            <!-- Styled Submit Button -->
                            <div style="text-align: center; margin-top: 10px;">
                                <button type="submit" class="btn btn-primary" name="update" style="padding: 10px 20px; border-radius: 5px; font-size: 16px;">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with  by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Innovateur</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Innovateur</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>