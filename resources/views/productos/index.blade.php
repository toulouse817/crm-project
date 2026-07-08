<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; padding: 40px; }
        h1 { color: #2c3e50; text-align: center; }

        /* Contenedor tipo Grid para los productos */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        /* Estilo de la tarjeta del producto */
        .producto-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .producto-card:hover { transform: translateY(-5px); }
        .producto-card h3 { margin: 0 0 10px 0; color: #e67e22; }
        .producto-card p { color: #7f8c8d; font-size: 0.9em; }
    </style>
</head>
<body>

    <h1>Catálogo de Productos</h1>

    <div class="grid-container">
        @foreach($productos as $producto)
        <div class="producto-card">
            <h3>Producto #{{ $producto['id'] }}</h3>
            <p>{{ $producto['title'] }}</p>
        </div>
        @endforeach
    </div>

</body>
</html>
