<?php
    include_once("database.php");
    class TareasModel {
        
        public function crearTarea ($titulo, $horas) {
            $database = OpenDataBase();
            $stmt = $database->prepare("INSERT INTO Tareas(titulo, horas) VALUES (?, ?)");
            
            $stmt->bind_param("si", $titulo, $horas);
            $stmt->execute();
            closeDataBase($database);
        }
        
        public static function obtenerTareas() {
            $database = OpenDataBase();
            $result = $database->query("SELECT * FROM Tareas");
            $tareas = $result->fetch_all(MYSQLI_ASSOC);
            closeDataBase($database);
            return $tareas;
        }


        public static function eliminarTarea($id) {
            $database = OpenDataBase();
            $stmt = $database->prepare("DELETE FROM Tareas WHERE id_tarea = ?");
            $stmt->bind_param("i", $id);
            $success = $stmt->execute();
            
            closeDataBase($database);
        
            return $success;
        }
        

        // Funcion de editarTarea con su preparacion, contruccion y ejecucion de consulta SQL
        public function editarTarea($id_tarea, $titulo, $horas) {
            $sql = "UPDATE Tareas SET ";
            $params = array();
            $paramTypes = "";
            if ($titulo !== null) {
            array_push($params, "titulo=?");
            $paramTypes .= "s";
            }
            if ($horas !== null) {
            array_push($params, "horas=?");
            $paramTypes .= "s";
            }
            $sql .= join(", ", $params);
            $sql .= " WHERE id_tarea = ?";
            $paramTypes .= "i";
            $paramValues = array_filter([$titulo, $horas, $id_tarea], function ($value) {
            return $value !== null;
            });
            $database = OpenDataBase();
            $stmt = $database->prepare($sql);
            if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $database->error);
            }
            array_unshift($paramValues, $paramTypes);
            $stmt->bind_param(...$paramValues);
            $stmt->execute();
            if ($stmt->error) {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
            }
            $stmt->close();
            closeDataBase($database);
            }

    public static function Obtener($id) {
        $database = OpenDataBase();
        $stmt = $database->prepare("SELECT * FROM Tareas WHERE id_tarea = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tarea = $result->fetch_assoc();
        closeDataBase($database);
        return $tarea;
    }

}

?>