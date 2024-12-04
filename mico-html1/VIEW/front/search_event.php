<?php
// Configuration de la base de données
require_once '../../config.php'; // Remplacez par votre fichier de connexion

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);

    try {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT * FROM events WHERE nom_eve LIKE :search");
        $query->execute(['search' => "%$search%"]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
  <div class="container mt-4">
    <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
    <div class="row">
      <?php if (!empty($results)): ?>
        <?php foreach ($results as $event): ?>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($event['nom_eve']); ?></h5>
                <p class="card-text">
                  <strong>Type:</strong> <?php echo htmlspecialchars($event['type_']); ?><br>
                  <strong>Date:</strong> <?php echo htmlspecialchars((new DateTime($event['date_']))->format('Y-m-d')); ?><br>
                  <strong>Price:</strong> <?php echo htmlspecialchars($event['price']); ?> TND
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">No events found for "<?php echo htmlspecialchars($search); ?>"</p>
      <?php endif; ?>
    </div>
    <a href="event.html" class="btn btn-secondary">Back to Events</a>
  </div>
</body>
</html>
