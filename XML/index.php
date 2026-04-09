<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Cine</title>
    <!-- Bootstrap para diseño rápido -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
            padding: 30px;
            max-width: 380px;
            margin:20px auto;
        }

        .movie-card {
            background-color: #2d2d2d;
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            height: 100%;
            padding: 20px;
        }

        .movie-card:hover {
            transform: scale(1.03);
            border: 1px solid #e50914;
        }

        .badge-format {
            background-color: #e50914;
            color: white;
        }

        .time-slot {
            background-color: #444;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin: 2px;
            font-size: 0.9rem;
        }

        h1 {
            color: #e50914;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <?php
        // Cargamos el archivo XML
        if (file_exists('cartelera.xml')) {
            $xml = simplexml_load_file('cartelera.xml');
            echo "<h1 class='text-center mb-5'>{$xml['cine']} - {$xml['ciudad']}</h1>";
            echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4'>";

            // Recorremos cada película
            foreach ($xml->pelicula as $peli) {
                ?>
                <div class="col">
                    <div class="card movie-card p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-format"><?php echo $peli->formato; ?></span>
                            <span class="text-secondary small"><?php echo $peli->estreno; ?></span>
                        </div>
                        <h3 class="h5 mt-2"><?php echo $peli->titulo; ?></h3>
                        <p class="text-info mb-1 small"><?php echo $peli->genero; ?></p>
                        <p class="text-secondary small">Dir: <?php echo $peli->director; ?></p>

                        <div class="mt-auto">
                            <hr class="border-secondary">
                            <p class="mb-1 small"><strong>Horarios:</strong></p>
                            <?php foreach ($peli->horarios->sesion as $hora): ?>
                                <span class="time-slot" title="Sala <?php echo $hora['sala']; ?>">
                                    <?php echo $hora; ?>
                                </span>
                            <?php endforeach; ?>
                            <div class="mt-2">
                                <span class="badge bg-secondary text-uppercase" style="font-size: 0.7rem;">
                                    Clasificación: <?php echo $peli->clasificacion; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: No se encontró el archivo cartelera.xml</div>";
        }
        ?>
    </div>

    <script src="https://jsdelivr.net"></script>
</body>

</html>