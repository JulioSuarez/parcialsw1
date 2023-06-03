@extends('index')

@section('jcst')
    {{-- <button id="add-button">Agregar</button>
    <!-- Agregar el modal para cambiar el nombre -->
    <div id="name-modal" class="modal">
        <div class="modal-content">
            <h4>Cambiar nombre de la clase</h4>
            <input type="text" id="class-name-input" placeholder="Nuevo nombre de la clase">
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect waves-light btn" id="save-name-button">Guardar</button>
        </div>
    </div>
    <div id="diagram-container"></div>


    <script src="{{ asset('vendor/mxgraph/js/mxClient.js') }}"></script>
    <script>
        let nombre = "nueva clase"
        document.addEventListener('DOMContentLoaded', function() {
            var container = document.getElementById('diagram-container');
            var addButton = document.getElementById('add-button');
            var graph = new mxGraph(container);
            var model = graph.getModel();

            // Agregar eventos a los botones
            addButton.addEventListener('click', function() {
                // Abrir el modal para cambiar el nombre
                var modal = document.getElementById('name-modal');
                var nameInput = document.getElementById('class-name-input');

                // Establecer el valor actual del nombre en el input
                nameInput.value = nombre;

                var instance = M.Modal.getInstance(modal);
                instance.open();
            });


            // funcion para agregar una clase
            addButton.addEventListener('click', function() {
                var parent = graph.getDefaultParent();

                var vertex = graph.insertVertex(parent, null, nombre, 400, 20, 120, 50);
                graph.setSelectionCell(vertex);
            });


            // Guardar el nombre cuando se hace clic en el botón de guardar
            document.getElementById('save-name-button').addEventListener('click', function() {
                var nameInput = document.getElementById('class-name-input');
                nombre = nameInput.value; // Guardar el nuevo nombre en la variable

                var selectedCell = graph.getSelectionCell();
                if (selectedCell) {
                    model.setValue(selectedCell, nombre); // Cambiar el nombre de la clase en el diagrama
                }

                var modal = document.getElementById('name-modal');
                var instance = M.Modal.getInstance(modal);
                instance.close();
            });



            // Función para eliminar utilizando el botón suprimir o la tecla de borrado
            document.addEventListener('keydown', function(evt) {
                if (evt.key === 'Delete' || evt.key === 'Backspace') {
                    var selectedCell = graph.getSelectionCell();

                    if (selectedCell) {
                        model.remove(selectedCell);
                    }
                }
            });

            // Graficar el diagrama
            graph.getModel().beginUpdate();
            try {
                var parent = graph.getDefaultParent();
                // Aquí se grafica el diagrama
            } finally {
                graph.getModel().endUpdate();
            }
        });
    </script> --}}



    <button id="add-button">Agregar</button>
    <div id="diagram-container"></div>

    <script src="{{ asset('vendor/mxgraph/js/mxClient.js') }}"></script>
    <script>
        let nombre = "nueva clase"
        document.addEventListener('DOMContentLoaded', function() {
            // aqui agrego mis botones
            var container = document.getElementById('diagram-container');
            var addButton = document.getElementById('add-button');
            var graph = new mxGraph(container);
            var model = graph.getModel();

            // aqui agrego los eventos a los botones

            // funcion para agregar una clase
            addButton.addEventListener('click', function() {
                var parent = graph.getDefaultParent();

                var vertex = graph.insertVertex(parent, null, nombre, 400, 20, 120, 50);
                graph.setSelectionCell(vertex);
            });

            // funcion para eliminar utilizando el boton suprimit o el borrado backspace
            document.addEventListener('keydown', function(evt) {
                if (evt.key === 'Delete' || evt.key === 'Backspace') {
                    var selectedCell = graph.getSelectionCell();

                    if (selectedCell) {
                        model.remove(selectedCell);
                    }
                }
            });

            // función para cambiar el nombre de la clase al hacer clic en ella
            // graph.addListener(mxEvent.CLICK, function(sender, evt) {
            //     var cell = evt.getProperty('cell');

            //     if (cell && cell.isVertex()) {
            //         var newValue = prompt('Ingresa el nuevo nombre de la clase', cell.getValue());

            //         if (newValue !== null) {
            //             model.setValue(cell, newValue);
            //         }
            //     }
            // });

            graph.addListener(mxEvent.CLICK, function(sender, evt) {
                var cell = evt.getProperty('cell');

                if (cell && cell.isVertex()) {
                    var input = document.createElement('input');
                    input.value = cell.getValue();

                    input.addEventListener('blur', function() {
                        var newValue = input.value;
                        model.setValue(cell, newValue);
                        container.removeChild(input);
                    });

                    container.appendChild(input);
                    input.focus();
                }
            });

            // graficar el diagrama
            graph.getModel().beginUpdate();
            try {
                var parent = graph.getDefaultParent();
                // aqui se grafica el diagrama
                var parent = graph.getDefaultParent();

                // Crear las clases iniciales en el gráfico
                var clase1 = graph.insertVertex(parent, null, 'Clase 1', 20, 20, 120, 50);
                var clase2 = graph.insertVertex(parent, null, 'Clase 2', 220, 20, 120, 50);
                var clase3 = graph.insertVertex(parent, null, 'Clase 3', 20, 120, 120, 50);
                var clase4 = graph.insertVertex(parent, null, 'Clase 4', 220, 120, 120, 50);

                // Crear relaciones entre las clases
                graph.insertEdge(parent, null, 'VARIABLE', clase1, clase2);
                graph.insertEdge(parent, null, '', clase2, clase3);
                graph.insertEdge(parent, null, '', clase3, clase4);



            } finally {
                graph.getModel().endUpdate();
            }
        });
    </script>

    {{--
    <button id="add-button">Agregar</button>
    <div id="diagram-container"></div>

    <script src="{{ asset('vendor/mxgraph/js/mxClient.js') }}"></script>
    <script>
        let nombre = "nueva clase"
        document.addEventListener('DOMContentLoaded', function() {
            // aqui agrego mis botones
            var container = document.getElementById('diagram-container');
            var addButton = document.getElementById('add-button');
            var graph = new mxGraph(container);
            var model = graph.getModel();

            // aqui agrego los eventos a los botones

            // funcion para agregar una clase
            addButton.addEventListener('click', function() {
                var parent = graph.getDefaultParent();

                var vertex = graph.insertVertex(parent, null, nombre, 400, 20, 120, 50);
                graph.setSelectionCell(vertex);
            });

            // funcion para eliminar utilizando el boton suprimit o el borrado backspace
            document.addEventListener('keydown', function(evt) {
                if (evt.key === 'Delete' || evt.key === 'Backspace') {
                    var selectedCell = graph.getSelectionCell();

                    if (selectedCell) {
                        model.remove(selectedCell);
                    }
                }
            });

            // graficar el diagrama
            graph.getModel().beginUpdate();
            try {
                var parent = graph.getDefaultParent();
                // aqui se grafica el diagrama
            } finally {
                graph.getModel().endUpdate();
            }
        });
    </script> --}}



    {{-- funcion de copiar --}}
    {{-- copyButton.addEventListener('click', function() {
    var encoder = new mxCodec();
    var node = encoder.encode(model);
    var diagramXml = mxUtils.getXml(node);

    // Aquí puedes realizar la acción para copiar el diagrama (por ejemplo, enviarlo al servidor)
    console.log('Diagrama copiado:', diagramXml);
}); --}}




    {{-- <div id="diagram-container"></div>
    <script src="{{ asset('vendor/mxgraph/js/mxClient.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var container = document.getElementById('diagram-container');
            var graph = new mxGraph(container);

            graph.getModel().beginUpdate();
            try {
                // Crear el diagrama de clase
                var parent = graph.getDefaultParent();

                // Obtener los usuarios pasados desde el controlador
                var usuarios = {!! json_encode($usuarios) !!};

                // Iterar sobre los usuarios y crear los nodos en el gráfico
                var y = 20;
                usuarios.forEach(function(usuario) {
                    var label = 'Usuario\n';
                    label += 'id: ' + usuario.id + '\n';
                    label += 'name: ' + usuario.name + '\n';
                    label += 'email: ' + usuario.email + '\n';
                    label += 'password: ' + usuario.password + '\n';
                    label += 'timestamp: ' + usuario.timestamp + '\n';

                    var vertex = graph.insertVertex(parent, null, label, 20, y, 200, 120);
                    y += 140;
                });

                usuarios.forEach(function(usuario) {
                    var label = '<div class="p-4 bg-gray-200 border border-gray-400">';
                    label += '<span class="text-lg font-bold">Usuario</span><br>';
                    label += '<span><strong>id:</strong> ' + usuario.id + '</span><br>';
                    label += '<span><strong>name:</strong> ' + usuario.name + '</span><br>';
                    label += '<span><strong>email:</strong> ' + usuario.email + '</span><br>';
                    label += '<span><strong>password:</strong> ' + usuario.password + '</span><br>';
                    label += '<span><strong>timestamp:</strong> ' + usuario.timestamp + '</span><br>';
                    label += '</div>';

                    var vertex = graph.insertVertex(parent, null, label, 20, y, 200, 'auto');
                    graph.getModel().setStyle(vertex, 'fillColor=white;strokeColor=gray;rounded=1');

                    y += 140;
                });

            } finally {
                graph.getModel().endUpdate();
            }
        });
    </script> --}}
@endsection
