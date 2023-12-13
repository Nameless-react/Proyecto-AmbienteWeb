<?php    
    include_once(MODELS_PATH . "/tareasModel.php");
    session_start();

    //Metodo para agregar una nueva tarea
    $tareaModel = new TareasModel();
    if (isset($_POST["crearTarea"])) {
        $tituloTarea = $_POST["tituloTarea"];
        $horasTarea = $_POST["horasTarea"];
        $id_empleadoTarea = $_POST["id_empleadoTarea"];
        $tareaModel->Agregar($titulo, $horas, $id_empleado);
        header('Location: tareas.php');
    }

    if (isset($_GET["eliminar"])) {
        $id_tarea = $_GET["eliminar"];
        $success = TareasModel::eliminarTarea($id_tarea);
        if (!$success) {
            echo '
            <div class="error">
            <a class="close-pop-up-error" href="#"><i class="fa-solid fa-xmark"></i></a>
                <h3>No se pudo eliminar la tarea debido a que está enlazada a un empleado</h3>
            </div>';
            
        } else {
            header("Location: " . ROOT . "/Views/tareas");
        }
        }

    if (isset($_POST["actualizarTarea"])) {
        $titulo = $_POST["titulo"];
        $horas = $_POST["horas"];
        $id_tarea = $_GET["actualizar"];
        TareasModel::editarTarea($id_tarea, $titulo, $horas);
        header("Location: " . ROOT . "/Views/tareas");
    }
    function Actualizar() {
        if (isset($_GET["actualizar"])) {
        $id = $_GET["actualizar"];
        $_POST["id_tarea"] = $id_tarea;
        return TareasModel::obtenerTareas($id_tarea);
    }
    }

    function mostrarTareas() {
        $tareas = TareasModel::obtenerTareas(); 
    
        
        echo '<div class="tareas-container">';
        foreach ($tareas as $tarea) {
            echo '<div class="tarea">
                <h3>Titulo: ' . $tarea["titulo"]  . '</h3>
                <p>Horas: ' . $tarea["horas"] . '</p>
                <div class="opciones">
                        <a href="' . ROOT . "/Views/tareas?eliminar=" . $tarea["id_tarea"]  . '" class="delete-empleado">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a href="' . ROOT . "/Views/tareas/modificar.php?actualizar=" . $tarea["id_tarea"]  . '" class="edit-empleado">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
            </div>';
        }
        echo '</div>';
    }
    function Modificar() {
    
    
        if (isset($_GET["actualizar"])) {
            $id = $_GET["actualizar"];
            $_POST["id"] = $id;
            return TareasModel::Obtener($id);
        }
    }

?> 

