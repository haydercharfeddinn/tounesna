<?php 
include_once '../../CONTROLLER/eventcontroller.php';
include_once '../../MODEL/event.php';

$error = "";
$ticket = null;

// create an instance of the controllers
$eventcontroller = new eventcontroller();
$ticketcontroller = new ticketcontroller();

// Fetch all events to populate the dropdown
$events = $eventcontroller->getAllEvents();

if (isset($_POST["event_id"]) && $_POST["user_id"] && $_POST["purchase_date"] && $_POST["quantity"] && $_POST["total_price"]) {
    if (
        !empty($_POST["event_id"]) &&
        !empty($_POST["user_id"]) &&
        !empty($_POST["purchase_date"]) &&
        !empty($_POST["quantity"]) &&
        !empty($_POST["total_price"])
    ) {
        $ticket = new Ticket(
            null,
            $_POST["event_id"],
            $_POST["user_id"],
            new DateTime($_POST["purchase_date"]),
            $_POST["quantity"],
            $_POST["total_price"]
        );

        $ticketcontroller->addticket($ticket);

        header('Location: tickets_list.php'); // Redirect to the ticket list
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Ticket</title>
    <style>
        /* Styles similaires au code précédent */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #5a5c69;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #4e73df;
            margin-bottom: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            max-width: 450px;
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #5a5c69;
        }

        input, select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            background-color: #f8f9fc;
            color: #6e707e;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        button {
            background-color: #4e73df;
            color: #ffffff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2e59d9;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ajouter un Ticket</h2>
    <form id="ticketForm" method="POST">
        <label for="event_id">Événement :</label>
        <select id="event_id" name="event_id">
            <option value="">-- Sélectionnez un événement --</option>
            <?php foreach ($events as $event) { ?>
                <option value="<?= $event['id'] ?>"><?= $event['nom_eve'] ?></option>
            <?php } ?>
        </select>
        <span class="error"></span>

        <label for="user_id">ID de l'utilisateur :</label>
        <input type="text" id="user_id" name="user_id" placeholder="Ex : 123">
        <span class="error"></span>

        <label for="purchase_date">Date d'achat :</label>
        <input type="date" id="purchase_date" name="purchase_date">
        <span class="error"></span>

        <label for="quantity">Quantité :</label>
        <input type="number" id="quantity" name="quantity" placeholder="Ex : 1">
        <span class="error"></span>

        <label for="total_price">Prix Total (en €) :</label>
        <input type="number" id="total_price" name="total_price" placeholder="Ex : 100">
        <span class="error"></span>

        <button type="submit">Ajouter</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>

</body>
</html>
