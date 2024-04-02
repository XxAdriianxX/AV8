<?php
// Carga automática de clases a través del autoloader
require_once 'autoloader.php';

// Crear una instancia de la clase Importar
$importador = new Importar();

// Importar datos de clientes
echo "Importando datos de clientes...\n";
$importador->customers("customers.csv");
echo "¡Datos de clientes importados con éxito!\n";

// Importar datos de las marcas favoritas de los clientes
echo "Importando datos de marcas favoritas de clientes...\n";
$importador->brandCustomer("customers.csv");
echo "¡Datos de marcas favoritas de clientes importados con éxito!\n";
?>

