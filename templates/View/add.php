<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Bootstrap</title>
</head>

<body>
    <div class="container">
        <h1>Formulario</h1>
        <form id="form">
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su cédula">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su teléfono">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo"
                    placeholder="Ingrese su correo electrónico">
            </div>
            <button type="button" class="btn btn-primary">Enviar</button>
        </form>
    </div>


    <script>
    $(document).ready(function() {
        // Manejar el evento de envío del formulario
        $("#form").on('click', function(event) {
            event.preventDefault(); // Evitar la recarga de la página

            // Obtener los datos del formulario
            var formData = $(this).serialize();

            // URL de la API a la que deseas enviar los datos
            // var apiUrl =
            //     "http://localhost/api_cake_prueba/api/personas"; 
            // Reemplaza con la URL de tu API
            var baseUrl = "<?= $this->Url->build('/', ['fullBase' => true]); ?>view/add";
            var url = baseUrl;

            // Realizar la solicitud AJAX para enviar los datos al servidor
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: 'Json',
                success: function(response) {
                    console.log(response);
                    // Manejar la respuesta del servidor aquí
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    // Manejar errores aquí
                    console.error(xhr.responseText);
                    alert("Hubo un error al enviar los datos.");
                }
            });
        });
    });
    </script>

</body>

</html>