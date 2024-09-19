<?php include '../php/db_connection.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munayart - Productos</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #1D3354;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header img {
            height: 50px; /* Ajusta el tamaño del logo */
            margin-right: 20px;
        }
        header h1 {
            flex-grow: 1;
            margin: 0;
            text-align: left;
        }
        section {
            padding: 30px;
        }
        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        .product {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            flex: 1 1 calc(25% - 20px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s;
        }
        .product:hover {
            transform: scale(1.02);
        }
        .product h3 {
            margin-bottom: 10px;
            font-size: 1.2em;
            text-align: center;
        }
        .product p {
            margin: 5px 0;
            text-align: center;
        }
        .buy-button {
            background-color: #1D3354;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .buy-button:hover {
            background-color: #ff5722;
        }
        footer {
            background-color: #1D3354;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <!-- Aquí va el logo -->
        <img src="../images/logo.jpg" alt="Logo de Munayart">
        <h1>Munayart - Productos</h1>
    </header>

    <section>
        <div class="products-container">
            <?php
            $sql = "SELECT * FROM producto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<h3>" . htmlspecialchars($row['Nombre']) . "</h3>";
                    echo "<p>Tipo: " . htmlspecialchars($row['Tipo']) . "</p>";
                    echo "<p>Precio: " . htmlspecialchars($row['Precio']) . " Bs</p>";
                    echo "<p>Material: " . htmlspecialchars($row['Material']) . "</p>";
                    echo "<a href='#' class='buy-button'>Comprar</a>"; // Añadí un botón de compra
                    echo "</div>";
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }

            $conn->close();
            ?>
        </div>
    </section>

    <footer>
        <p>Munayart - © 2024</p>
    </footer>
</body>
</html>
