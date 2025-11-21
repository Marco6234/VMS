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

$results = getHostsEvents($pdo,$_SESSION['host_id']);
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
    
    <title>Find Event</title>
</head>
<body>
       <div class="d-flex">
            <?= sidebarShow("hostEvents"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                <h2>My Events</h2>
                    <div class="list-group list-group-checkable d-grid gap-2 border-0"> 
                        <?php foreach ($results as $event): ?>
                            <label class="list-group-item rounded-3 py-3">
                              <?= $event['event_type'] ?>
                               <span class="d-block small opacity-50">
                                   <?php foreach($event as $info => $value): ?>
                                     <?= "$info: $value" ?><br>
                                  <?php endforeach; ?>
                              </span>
                            </label>
                          <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'host'): ?>
                              <form method="POST" action="manageEvent.php">
                                    <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                                    <button type="submit" name="manage">Manage Event</button>
                              </form>
                           <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </body>
</html>
