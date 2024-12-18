<?php
include '../../controller/QuizController.php';
$quizController = new QuizController();
$list = $quizController->listQuizzes(); // Liste complète des quiz

// Pagination
$limit = 6; // Nombre de quiz par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Assurez-vous que la page est au moins 1
$offset = ($page - 1) * $limit;

$totalQuizzes = count($list); // Nombre total de quiz
$totalPages = ceil($totalQuizzes / $limit);

// Découper la liste des quiz pour la page courante
$currentQuizzes = array_slice($list, $offset, $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quiz List - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for pagination -->
    <style>
        /* Global Styles */
body {
    font-family: 'Nunito', sans-serif;
    background-color: #f8f9fc;
    color: #5a5c69;
    margin: 0;
    padding: 0;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
    font-size: 16px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

table th, table td {
    border: 10px solid #d1d3e2;
    padding: 10px 90px;
    text-align: left;
}

table th {
    background-color: #4e73df;
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f8f9fc;
}

table tr:hover {
    background-color: #f1f2f6;
}

/* Action Buttons */
table td a,
table td input[type="submit"] {
    background-color: #4e73df;
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

table td a:hover,
table td input[type="submit"]:hover {
    background-color: #2e59d9;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 5px;
}

.pagination a {
    color: #4e73df;
    padding: 8px 15px;
    text-decoration: none;
    border: 1px solid #d1d3e2;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination a.active {
    background-color: #4e73df;
    color: white;
    border-color: #4e73df;
}

.pagination a:hover {
    background-color: #2e59d9;
    color: white;
}

/* Card Design */
.card {
    border: 1px solid #d1d3e2;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
}

.card .card-body {
    padding: 20px;
}

/* Sidebar Styles */
.sidebar {
            width: 250px;
            background-color: #4e73df; /* Bleu */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 15px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #2e59d9; /* Bleu plus foncé */
            border-radius: 5px;
        }

/* Header */
h1.h3 {
    color: #4e73df;
    font-weight: bold;
}

/* Footer */
footer.sticky-footer {
    background-color: #f8f9fc;
    color: #5a5c69;
    text-align: center;
    padding: 10px 0;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    table {
        font-size: 14px;
    }

    table th, table td {
        padding: 8px;
    }

    .pagination a {
        font-size: 12px;
        padding: 5px 10px;
    }
}

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <div class="sidebar">
                <a href="../back/affiche.php">Event</a>
                <a href="../back/backoffice.php">SHOP</a>
                <a href="../back/listeRec.php">Réclamation</a>
                <a class="sidebar-brand " href="../back/dashboardblog.php">blog </a>
            <a class="sidebar-brand " href="../back/admin/pages/dashboard.php">Admin </a>
            <a class="sidebar-brand " href="../back/createquiz.php">Quiz </a>
                <hr>
                <a href="../back/createQuizContent.php">Add content</a>
                <a href="../back/createQuiz.php">Create quiz</a>
            </div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quiz List</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Quiz List Table -->
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Author</th>
                                                    <th colspan="2">Actions</th>
                                                </tr>

                                                <?php foreach ($currentQuizzes as $quiz): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($quiz->getId()); ?></td>
                                                        <td><?= htmlspecialchars($quiz->getTitle()); ?></td>
                                                        <td><?= htmlspecialchars($quiz->getDescription()); ?></td>
                                                        <td><?= htmlspecialchars($quiz->getAuthor()); ?></td>
                                                        <td align="center">
                                                            <form method="POST" action="updateQuiz.php">
                                                                <input type="submit" name="update" value="Update">
                                                                <input type="hidden" value="<?= htmlspecialchars($quiz->getId()); ?>" name="id">
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <a href="deleteQuiz.php?id=<?= htmlspecialchars($quiz->getId()); ?>">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                            <!-- Pagination -->
                                            <center>
                                                <div class="pagination">
                                                    <?php if ($page > 1): ?>
                                                        <a href="quizList.php?page=<?= $page - 1; ?>">&laquo;</a>
                                                    <?php endif; ?>

                                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                        <a href="quizList.php?page=<?= $i; ?>" <?= $i == $page ? 'class="active"' : ''; ?>>
                                                            <?= $i; ?>
                                                        </a>
                                                    <?php endfor; ?>

                                                    <?php if ($page < $totalPages): ?>
                                                        <a href="quizList.php?page=<?= $page + 1; ?>">&raquo;</a>
                                                    <?php endif; ?>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Quiz Management 2024</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="js/quizList.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>