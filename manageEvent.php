<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
require_once "functionSet.php";
if (!isset($_SESSION['host_id']) && !isset($_SESSION['guest_id'])) {
    header("Location: login.html");
    exit();
}

$event_id = $_POST['event_id'];
$event = displayEvent($pdo, $event_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    
    <title>Manage Event</title>
</head>
<body>
        <div class="d-flex">
            <?= sidebarShow("hostEvent"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                <h2>Manage Event id: <?php echo $event_id;?></h2>
                <form method = "POST">
                    <input type = "hidden" name="event_id" value="<?php echo $event_id?>"/>

                    <?php
                        if(isset($_POST['update'])){
                            $date = $_POST['date'];
                            $time = $_POST['time'];
                            $event_type = $_POST['event_type'];
                            updateEvent($pdo, $event_id, $date, $time, $event_type);
                            $event = displayEvent($pdo, $event_id); // Update the changed values
                        }

                        if(isset($_POST['delete'])){
                            deleteEvent($pdo, $event_id);
                            header("Location: hostEvents.php"); // Go back to hostsevents after deleting event
                        }
                    ?>
                    <input type="date" name="date" value="<?php echo $event['date']?>"/><br><br>
                    <input type="time" name="time" value="<?php echo $event['time']?>"/><br><br>
                    <input type="text" name="event_type" value="<?php echo $event['event_type']?>"/><br><br>

                    <button type= "submit" name= "update">Update Event </button><br><br><br>
                    <button type= "submit" name= "update">Delete Event </button>
                </form>
            </div>
        </div>
        

    </body>
</html>
