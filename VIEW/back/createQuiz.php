<?php
include_once '../../controller/QuizController.php';  // Correct the path as needed
include_once '../../Model/Quiz.php';  // If necessary, include the model here as well
$error = "";
$quizController = new QuizController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate required fields
    $requiredFields = ["title", "description", "author"];
    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (empty($missingFields)) {
        // Create a new quiz instance
        $quiz = new Quiz(
            null,
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['description']),
            htmlspecialchars($_POST['author'])
        );

        // Add the quiz using the controller
        $quizId = $quizController->addQuiz($quiz);

        // Redirect to the quiz content page with the quiz ID
        header("Location: createQuizContent.php?quizId=$quizId");
        exit;
    } else {
        $error = "The following fields are missing: " . implode(", ", $missingFields);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Quiz - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fc; /* Light background */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #5a5c69; /* Gray text */
}

h2 {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    color: #4e73df; /* Light blue */
    margin-bottom: 20px;
}
/* Sidebar */
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

/* Container */
.container {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px 20px;
    max-width: 450px;
    width: 100%;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Uniform spacing */
}

label {
    font-weight: bold;
    color: #5a5c69; /* Gray text */
    margin-bottom: 5px;
}

input,
textarea {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #d1d3e2; /* Light gray border */
    border-radius: 5px;
    background-color: #f8f9fc; /* Light gray background */
    color: #6e707e; /* Dark gray text */
    outline: none;
    transition: border-color 0.3s ease;
}

input:focus,
textarea:focus {
    border-color: #4e73df; /* Focus color */
    box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
}

textarea {
    resize: none;
}

/* Button */
button {
    background-color: #4e73df; /* Blue */
    color: #ffffff; /* White text */
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2e59d9; /* Darker blue */
}

/* Error Messages */
.alert {
    color: red;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .container {
        padding: 20px;
    }
}

    </style>
</head>
<body>
    <div id="wrapper">
        <form action="" method="POST">
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>
            <div class="sidebar">
                <a href="../back/affiche.php">Event</a>
                <a href="../back/backoffice.php">SHOP</a>
                <a href="../back/listeRec.php">Réclamation</a>
                <a class="sidebar-brand " href="../back/dashboardblog.php">blog </a>
            <a class="sidebar-brand " href="../back/admin/pages/dashboard.php">Admin </a>
            <a class="sidebar-brand " href="../back/createquiz.php">Quiz </a>
                <hr>
                <a href="../back/createQuizContent.php">Add content</a>
                <a href="quizList.php">Afficher</a>
            </div>

            <label for="title">Title:</label>
            <input class="form-control" type="text" id="title" name="title" value="<?= $_POST['title'] ?? ''; ?>"><br>

            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"><?= $_POST['description'] ?? ''; ?></textarea><br>

            
            <label for="author">Author:</label>
            <input class="form-control" type="text" id="author" name="author" value="<?= $_POST['author'] ?? ''; ?>"><br>

            <button type="submit" class="btn btn-primary btn-user btn-block">Create Quiz</button>
        </form>
    </div>
</body>
</html>
