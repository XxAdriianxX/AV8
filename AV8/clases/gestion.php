<?php
require_once 'Conexion.php';

class Gestion extends Conexion
{
    public function getBrands()
    {
        $html = '<form action="" method="post">';
        
        // Consulta para obtener las marcas ordenadas alfabéticamente
        $sql = "SELECT * FROM brands ORDER BY brandName ASC";
        $result = $this->conn->query($sql);
        
        // Verificar si hay resultados
        if ($result && $result->num_rows > 0) {
            // Iterar sobre cada fila de resultados
            while ($row = $result->fetch_assoc()) {
                $brandId = $row['brandId'];
                $brandName = $row['brandName'];
                
                // Agregar el checkbox con el nombre y valor de la marca
                $html .= "<input type='checkbox' value='$brandId' name='$brandName'> $brandName<br>";
            }
            // Agregar el botón de enviar
            $html .= '<br><input type="submit" value="Seleccionar">';
            $html .= '</form>';
        } else {
            $html .= "No se encontraron marcas en la base de datos.";
        }
        
        return $html;
    }
}
?>
