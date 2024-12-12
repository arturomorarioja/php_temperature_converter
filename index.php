<?php

$initialLoad = true;

// The "Calculate" button has been pressed
if (isset($_POST['txtTemperature'])) {
    $initialLoad = false;

    $temperature = (float) $_POST['txtTemperature'];
    $from = $_POST['lstFrom'];
    $to = $_POST['lstTo'];
} else {    // The page has just been loaded
    $temperature = 0;            
    $from = 'C';
    $to = 'F';
}

// Calculations take place anyway
if ($from === $to) {
    $conversion = $temperature;
} else {
    switch ($from . $to) {
        case 'CF': $conversion = ($temperature * 1.8) + 32; break;
        case 'CK': $conversion = $temperature + 273.15; break;
        case 'FC': $conversion = ($temperature - 32) / 1.8; break;
        case 'FK': $conversion = ($temperature + 459.67) * (5 / 9); break;
        case 'KC': $conversion = $temperature - 273.15; break;
        case 'KF': $conversion = ($temperature * (5 / 9)) - 459.67; break;
    }
}
$conversion = round($conversion, 2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Temperature converter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css"></style>
</head>
<body>
    <header>
        <h1>Temperature converter</h1>
    </header>
    <main>
        <form action="index.php" method="POST">
            <div>
                <label for="txtTemperature">Convert</label><br>
                <input type="text" id="txtTemperature" name="txtTemperature" 
                    value="<?=$temperature ?>" pattern="-?\d*(\.\d{0,2})?" required>
            </div>
            <div>
                <div id="from">
                    <label for="lstFrom">From</label><br>
                    <select id="lstFrom" name="lstFrom" size="3">
                        <option value="C" <?=$from == 'C' ? 'selected' : '' ?>>Celsius</option>
                        <option value="F" <?=$from == 'F' ? 'selected' : '' ?>>Fahrenheit</option>
                        <option value="K" <?=$from == 'K' ? 'selected' : '' ?>>Kelvin</option>
                    </select>
                </div>
                <div id="to">
                    <label for="lstTo">To</label><br>
                    <select id="lstTo" name="lstTo" size="3">
                        <option value="C" <?=$to == 'C' ? 'selected' : '' ?>>Celsius</option>
                        <option value="F" <?=$to == 'F' ? 'selected' : '' ?>>Fahrenheit</option>
                        <option value="K" <?=$to == 'K' ? 'selected' : '' ?>>Kelvin</option>
                    </select>
                </div>
            </div>
            <div>
                <input type="submit" value="Calculate">
            </div>
        </form>
        <?php if (!$initialLoad): ?>
            <div id="results">
                <span id="fromText"><?=$temperature ?>&deg;<?=$from ?> = 
                    </span><span id="toText"><?=$conversion ?>&deg;<?=$to ?></span>
            </div>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2021 Arturo Mora-Rioja</p>
    </footer>
</body>
</html>