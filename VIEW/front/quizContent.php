<?php
include '../../controller/QuizCController.php';
$quizContentController = new QuizContentController();

// Get the quiz ID from the URL query parameters
$quizId = $_GET['id'] ?? null;

// Fetch the quiz content for the given ID
$questions = $quizContentController->getQuizContentByQuizId($quizId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Take Quiz</title>
    <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!-- fonts style -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

<!--owl slider stylesheet -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />
<!-- nice select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
<!-- datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />
    
    
</head>
<body>
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container">
          <div class="contact_nav">
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +01 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : demo@gmail.com
              </span>
            </a>
            <a href="">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Location
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              <img src="images/logo.png" alt="">
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                <li class="nav-item ">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="about.php"> About</a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link" href="event.html">Events</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="quizList.php">Reservation</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="testimonial.html">Testimonial</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                      </li>
                </ul>
              </div>
              <div class="quote_btn-container">
                <a href="">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>
                <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center mb-4">Take the Quiz</h1>
            
            <!-- Timer Display -->
            <div id="timer" class="text-center mb-4">Time remaining: <span id="timeRemaining">30</span> seconds</div>
            
            <?php if (!empty($questions)): ?>
                <form id="quizForm">
                    <?php foreach ($questions as $index => $question): ?>
                        <div class="mb-4">
                            <label class="form-label">
                                <strong><?= ($index + 1) . '. ' . htmlspecialchars($question->getQuestionText()); ?></strong>
                            </label>
                            <div class="form-check">
                                <?php
                                $options = [
                                    1 => $question->getOption1(),
                                    2 => $question->getOption2(),
                                    3 => $question->getOption3(),
                                    4 => $question->getOption4()
                                ];
                                foreach ($options as $optionId => $optionText): ?>
                                    <input 
                                        class="form-check-input mb-2" 
                                        type="radio" 
                                        name="question_<?= htmlspecialchars($question->getContentId()); ?>" 
                                        value="<?= $optionId; ?>" 
                                        data-correct="<?= $question->getCorrectOption(); ?>" 
                                        required>
                                    <label class="form-check-label d-block">
                                        <?= htmlspecialchars($optionText); ?>
                                    </label>
                                <?php endforeach; ?>
                                <!-- Hint button to tick the correct option -->
                                <button type="button" class="btn btn-secondary hint-btn" onclick="showHint(<?= htmlspecialchars($question->getContentId()); ?>)">Show Hint</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" id="submitBtn" class="btn btn-danger w-100" onclick="calculateScore()">Submit Quiz</button>
                </form>
                <div id="result" class="alert mt-4 d-none"></div>
                <div id="quizListButton" class="mt-4 text-center d-none">
                    <a href="quizlist.php" class="btn btn-primary">Go to Quiz List</a>
                </div>
            <?php else: ?>
                <p class="text-danger">No questions available for this quiz.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let timeRemaining = 30;  // Set timer to 30 seconds
        const timerElement = document.getElementById('timeRemaining');
        const form = document.getElementById('quizForm');
        const resultDiv = document.getElementById('result');
        const quizListButton = document.getElementById('quizListButton');
        const submitBtn = document.getElementById('submitBtn');

        // Function to start the countdown timer
        function startTimer() {
            const timerInterval = setInterval(function() {
                if (timeRemaining > 0) {
                    timeRemaining--;
                    timerElement.textContent = timeRemaining;
                } else {
                    clearInterval(timerInterval);  // Stop the timer when it reaches 0
                    disableQuiz();
                    resultDiv.classList.remove('d-none', 'alert-success');
                    resultDiv.classList.add('alert-danger');
                    resultDiv.innerHTML = `<strong>Time's up!</strong> You cannot change your answers anymore.`;
                    showQuizListButton();
                }
            }, 1000);
        }

        // Function to disable all radio buttons after time runs out or when user clicks submit
        function disableQuiz() {
            const inputs = form.querySelectorAll('input[type="radio"]');
            inputs.forEach(input => {
                input.disabled = true;
            });
            submitBtn.disabled = true;  // Disable the submit button after submission
        }

        // Function to calculate score and disable inputs after submission
        function calculateScore() {
            const questions = form.querySelectorAll('.mb-4');
            let score = 0;

            // Disable inputs right after submission
            disableQuiz();

            // Calculate score
            questions.forEach(question => {
                const selectedOption = question.querySelector('input[type="radio"]:checked');
                if (selectedOption) {
                    const correctAnswer = selectedOption.dataset.correct;
                    if (selectedOption.value === correctAnswer) {
                        score++;
                    }
                }
            });

            if (questions.length === document.querySelectorAll('input[type="radio"]:checked').length) {
                if (score === questions.length) {
                    resultDiv.classList.remove('d-none', 'alert-danger');
                    resultDiv.classList.add('alert-success');
                    resultDiv.innerHTML = `<strong>Well done!</strong> Your Score: ${score} / ${questions.length}`;
                } else {
                    resultDiv.classList.remove('d-none', 'alert-success');
                    resultDiv.classList.add('alert-danger');
                    resultDiv.innerHTML = `<strong>Incorrect!</strong> Your Score: ${score} / ${questions.length}`;
                }
            } else {
                resultDiv.classList.remove('d-none', 'alert-success');
                resultDiv.classList.add('alert-danger');
                resultDiv.innerHTML = `<strong>Error:</strong> There's no answer!`;
            }

            // Show the "Go to Quiz List" button after submission
            showQuizListButton();
        }

        // Show the "Go to Quiz List" button
        function showQuizListButton() {
            quizListButton.classList.remove('d-none');
        }

        // Function to show the correct option when the hint button is clicked
        function showHint(questionId) {
            // Find the correct option for this question
            const options = document.querySelectorAll(`input[name="question_${questionId}"]`);
            options.forEach(option => {
                if (option.value == option.dataset.correct) {
                    option.checked = true;
                }
            });
        }
        // Start the timer when the page loads
        window.onload = startTimer;
    </script>
</body>
<script> window.chtlConfig = { chatbotId: "4111927534" } </script>
<script async data-id="4111927534" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
</html>
