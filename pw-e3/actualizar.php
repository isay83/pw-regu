<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Zoo</title>
</head>

<body class="hm-gradient">
    <div class="vh-100 d-flex align-items-center position-fixed start-0 top-0" role="navigation">
        <div class="p-2">
            <div id="mainNav">
                <ul class="list-unstyled rounded ms-2">
                    <li><a class="vlink rounded border-0" href="index.php"><i class="bi bi-house-door-fill"></i> <span>Inicio</span></a></li>
                    <li><a class="vlink rounded" href="insertar.php"><i class="bi bi-plus-square-fill"></i> <span>Insertar</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <main>
        <!--MDB Tables-->
        <div class="container mt-5">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up">Actualizar Comida</h2>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="container col-md-6">
                        <?php
                        // Conexión a la base de datos
                        $conn = new mysqli('localhost', 'root', '', 'zoo');

                        if ($conn->connect_error) {
                            die("Error de conexión: " . $conn->connect_error);
                        }

                        // Consulta para obtener los datos de la comida
                        $sql = "SELECT c.id AS id, a.nombre AS animal, a.especie, h.nombre AS habitat, c.fecha, c.hora, c.tipo 
                            FROM Comidas c
                            INNER JOIN Animales a ON c.animal_id = a.id
                            INNER JOIN Habitats h ON a.habitat_id = h.id
                            WHERE c.id = " . $_GET['id'];

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0)
                            $row = $result->fetch_assoc();
                        ?>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Obtener los datos del formulario
                            $id = $_POST['id'];
                            $fecha = $_POST['fecha'];
                            $hora = $_POST['hora'];
                            $tipo = $_POST['tipo'];

                            // Actualizar los datos en la base de datos
                            $sql = "UPDATE Comidas SET fecha = '$fecha', hora = '$hora', tipo = '$tipo' WHERE id = $id";
                            if ($conn->query($sql) === TRUE) {
                                echo "Datos actualizados correctamente";
                            } else {
                                echo "Error al actualizar los datos: " . $conn->error;
                            }
                        }
                        ?>
                        <form method="POST" class="row g-3 w-6">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="mb-3">
                                <label for="animal" class="form-label">Animal</label>
                                <input type="text" class="form-control" id="animal" name="animal" value="<?php echo $row['animal']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="especie" class="form-label">Especie</label>
                                <input type="text" class="form-control" id="especie" name="especie" value="<?php echo $row['especie']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="habitat" class="form-label">Hábitat</label>
                                <input type="text" class="form-control" id="habitat" name="habitat" value="<?php echo $row['habitat']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row['fecha']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $row['hora']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Comida</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $row['tipo']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Obtener los datos del formulario
                            $id = $_POST['id'];
                            $fecha = $_POST['fecha'];
                            $hora = $_POST['hora'];
                            $tipo = $_POST['tipo'];

                            // Actualizar los datos en la base de datos
                            $sql = "UPDATE Comidas SET fecha = '$fecha', hora = '$hora', tipo = '$tipo' WHERE id = $id";
                            if ($conn->query($sql) === TRUE) {
                                echo '<script>
                                        swal("¡Datos actualizados correctamente!", "Serás redirigido al inicio", "success").then(function() {
                                            window.location.href = "index.php";
                                        });
                                    </script>';
                            } else {
                                echo '<script>
                                        swal("¡Error al actualizar los datos!", "' . $conn->error . '", "error").then(function() {
                                            window.location.href = "index.php";
                                        });
                                    </script>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>