<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                    <li><a class="vlink rounded border-0" href="#"><i class="bi bi-house-door-fill"></i> <span>Inicio</span></a></li>
                    <li><a class="vlink rounded" href="insertar.php"><i class="bi bi-plus-square-fill"></i> <span>Insertar</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <main>
        <!--MDB Tables-->
        <div class="container mt-4">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-6">
                            <h2 class="pt-3 pb-4 font-bold font-up">Registro de Comidas</h2>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="insertar.php" style="font-size: 4rem;">
                                <i class="bi bi-plus-square-fill me-2"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Grid column -->


                    <?php
                    // Conexión a la base de datos
                    $conn = new mysqli('localhost', 'root', '', 'zoo');

                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    // Consulta para obtener los datos de las comidas
                    $sql = "SELECT c.id AS id, a.nombre AS animal, a.especie, h.nombre AS habitat, c.fecha, c.hora, c.tipo 
                        FROM Comidas c
                        INNER JOIN Animales a ON c.animal_id = a.id
                        INNER JOIN Habitats h ON a.habitat_id = h.id
                        ORDER BY c.fecha DESC, c.hora DESC";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Animal</th>
                                    <th>Especie</th>
                                    <th>Hábitat</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Tipo de Comida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                <td>' . $row['animal'] . '</td>
                                <td>' . $row['especie'] . '</td>
                                <td>' . $row['habitat'] . '</td>
                                <td>' . $row['fecha'] . '</td>
                                <td>' . $row['hora'] . '</td>
                                <td>' . $row['tipo'] . '</td>
                                <td>
                                    <a href="actualizar.php?id=' . $row['id'] . '"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="#" onclick="confirmDelete(' . $row['id'] . ')"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>';
                        }

                        echo '</tbody></table>';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            // Perform delete operation
                            $deleteSql = "DELETE FROM Comidas WHERE id = $id";
                            if ($conn->query($deleteSql) === TRUE) {
                                echo '<script>
                                        swal("Registro eliminado exitosamente!", "", "success").then(function() {
                                            window.location.href = "index.php";
                                        });
                                    </script>';;
                            } else {
                                echo '<script>
                                        swal("¡Error al eliminar el registro!", "' . $conn->error . '", "error").then(function() {
                                            window.location.href = "index.php";
                                        });
                                    </script>';
                            }
                        }
                    } else {
                        echo '<p>No se encontraron registros de comidas.</p>';
                    }

                    $conn->close();
                    ?>
                    <!-- Grid row -->
                </div>
            </div>
        </div>
    </main>
    <script>
        function confirmDelete(id) {
            swal({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará el registro de comida seleccionado.",
                icon: "warning",
                buttons: ["Cancelar", "Eliminar"],
                dangerMode: true,
            }).then((confirm) => {
                if (confirm) {
                    // Perform delete operation
                    window.location.href = "index.php?id=" + id;
                }
            });
        }
    </script>
</body>

</html>