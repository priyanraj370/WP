<!DOCTYPE html>
<html>
<head>
    <title>Color Change by Day</title>
    <?php
       $daysOfWeek = array(
         'Sunday'    => 'red',
        'Monday'    => 'green',
        'Tuesday'   => 'blue',
        'Wednesday' => 'yellow',
        'Thursday'  => 'brown',
        'Friday'    => 'cyan',
        'Saturday'  => 'orange'
    );
 
    $currentDay = date('l'); 
    $backgroundColor = "#f700ffff"; 
       if (array_key_exists($currentDay, $daysOfWeek)) {
        $backgroundColor = $daysOfWeek[$currentDay];
    }
    ?>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>
    <h1>Welcome! Today is <?php echo $currentDay; ?>.</h1>
</body>
</html>
