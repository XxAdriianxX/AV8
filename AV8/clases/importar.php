<?php
require_once 'conexion.php';

class Importar extends Conexion
{
    public function customers($file)
    {
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "#")) !== FALSE) {
                $customerId = $data[0];
                $customerName = $data[1];

                // Verificar si el customerId ya existe en la tabla customers
                $sql = "SELECT COUNT(*) AS count FROM customers WHERE customerId = '$customerId'";
                $result = $this->conn->query($sql);
                $row = $result->fetch_assoc();
                $count = $row['count'];

                if ($count > 0) {
                    // Si el customerId ya existe, actualizar el customerName
                    $sql = "UPDATE customers SET customerName = '$customerName' WHERE customerId = '$customerId'";
                    $result = $this->conn->query($sql);
                    if (!$result) {
                        echo "Error al actualizar datos en la tabla customers: " . $this->conn->error;
                    }
                } else {
                    // Si el customerId no existe, insertar un nuevo registro
                    $sql = "INSERT INTO customers (customerId, customerName) VALUES ('$customerId', '$customerName')";
                    $result = $this->conn->query($sql);
                    if (!$result) {
                        echo "Error al insertar datos en la tabla customers: " . $this->conn->error;
                    }
                }
            }
            fclose($handle);
        } else {
            echo "Error al abrir el archivo $file";
        }
    }

    public function brandCustomer($file)
    {
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "#")) !== FALSE) {
                $customerId = $data[0];
                $brands = explode(", ", $data[2]);
    
                foreach ($brands as $brand) {
                    // Verificar si el nombre de la marca no está vacío
                    if (!empty($brand)) {
                        // Obtener brandId
                        $brandId = $this->getBrandId($brand);
    
                        // Si se pudo obtener el brandId, verificar si la entrada ya existe
                        if ($brandId !== false) {
                            $sql = "SELECT COUNT(*) AS count FROM brandCustomer WHERE customerId = '$customerId' AND brandId = '$brandId'";
                            $result = $this->conn->query($sql);
                            $row = $result->fetch_assoc();
                            $count = $row['count'];
    
                            // Si la entrada no existe, insertarla en la tabla brandCustomer
                            if ($count == 0) {
                                $sql = "INSERT INTO brandCustomer (customerId, brandId) VALUES ('$customerId', '$brandId')";
                                $result = $this->conn->query($sql);
                                if (!$result) {
                                    echo "Error al insertar datos en la tabla brandCustomer: " . $this->conn->error;
                                }
                            }
                        }
                    }
                }
            }
            fclose($handle);
        } else {
            echo "Error al abrir el archivo $file";
        }
    }
    
    
    public function getBrandId($brandName)
    {
        // Buscar el brandId por nombre de marca
        $sql = "SELECT brandId FROM brands WHERE brandName = '$brandName'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['brandId'];
        } else {
            echo "Error: Marca '$brandName' no encontrada en la base de datos.";
            return false;
        }
    }
}
?>


