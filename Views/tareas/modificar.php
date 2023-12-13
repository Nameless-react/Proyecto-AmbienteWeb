<?php
include("../../global.php");
include_once(CONTORLLERS_PATH . "/tareasController.php");
include_once(VIEWS_PATH . "/layout.php");
$tarea = Modificar();

?>
<!DOCTYPE html>
<html lang="en">
<?php MostrarHead("Modificar Tarea") ?>

<body>
    <?php MostrarHeader() ?>
    <form class="form-usuarios" method="post">
        <a href="<?php echo ROOT . "/Views/tareas/" ?>" class="atras">
            <i class="fa-solid fa-arrow-left"></i>
            Atrás
        </a>
        <h2>Modificar Tarea</h2>
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $tarea['titulo']; ?>" required>
      
        <label for="horas">Horas:</label>
        <input type="text" id="horas" name="horas" value="<?php echo $tarea['horas']; ?>" required>
        <button class="boton-tarea"  type="submit" name="actualizarTarea">Guardar</button>
    </form>

    <?php MostrarFooter() ?>
</body>

<script>
    const burger = document.querySelector(".hamburger-menu");
    burger.addEventListener("click", () => {
        if (burger.classList.contains("close")) {
            burger.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        } else {
            burger.innerHTML = '<i class="fa-solid fa-bars"></i>'
        }

        burger.classList.toggle("close");
    })

    
    const closeEye = document.querySelector(".eye");
    const password = document.querySelector("#password");
    closeEye.addEventListener("click", () => {
        if (closeEye.classList.contains("fa-eye-slash")) {
            closeEye.classList.replace("fa-eye-slash", "fa-eye");
            password.setAttribute("type", "text");
        } else {
            closeEye.classList.replace("fa-eye", "fa-eye-slash");
            password.setAttribute("type", "password");
        }
    });
</script>
</html>