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
                            <h2 class="pt-3 pb-4 text-center font-bold font-up">Insertar Comida</h2>
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
                        ?>
                        <form method="POST" class="row g-3 w-6">
                            <div class="mb-3">
                                <label for="animal" class="form-label">Animal</label>
                                <select class="form-select" id="animal" name="animal">
                                    <option value="0">...</option>
                                    <?php
                                    // Obtener los datos de animales de la base de datos
                                    $query = "SELECT * FROM Animales";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora">
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Comida</label>
                                <input type="text" class="form-control" id="tipo" name="tipo">
                            </div>
                            <button type="submit" class="btn btn-primary">Insertar</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Obtener los datos del formulario
                            $animal = $_POST['animal'];
                            $fecha = $_POST['fecha'];
                            $hora = $_POST['hora'];
                            $tipo = $_POST['tipo'];

                            // Insertar los datos en la base de datos
                            $sql = "INSERT INTO Comidas (animal_id, fecha, hora, tipo) VALUES ('$animal', '$fecha', '$hora', '$tipo')";
                            if ($conn->query($sql) === TRUE) {
                                echo '<script>
                                        swal("¡Datos insertados correctamente!", "", "success").then(function() {
                                            
                                        });
                                    </script>';
                            } else {
                                echo '<script>
                                        swal("¡Error al insertar los datos!", "' . $conn->error . '", "error").then(function() {
                                            
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