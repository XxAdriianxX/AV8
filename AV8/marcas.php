<?php
// Incluir la clase Gestion
require_once 'autoloader.php';

// Crear una instancia de la clase Gestion
$gestion = new Gestion();

// Obtener los checkboxes de las marcas
$html = $gestion->getBrands();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Marcas</title>
</head>
<body>
    <?php echo $html; ?>
</body>
</html>
