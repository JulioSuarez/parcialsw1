@extends('VistaDiagramas.index')

{{-- @section('jcst') --}}

    {{-- <div id="mermaid-editor" style="width: 100%; height: 500px;">

    <div class="mermaid">
        classDiagram
        Class01 &lt;|-- AveryLongClass : Cool
        &lt;&lt;Interface>> Class01
        Class09 --&gt; C2 : Where am I?
        Class09 --* C3
        Class09 --&gt; Class07
        Class07 : equals()
        Class07 : Object[] elementData
        Class01 : size()
        Class01 : int chimp
        Class01 : int gorilla
        class Class10 {
        &lt;&lt;service&gt;&gt;
        int id
        size()
        }
    </div>
</div> --}}
    {{-- @dd($data) --}}
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


    @section('content')
    <div class="container">
        <h1>Editor de Diagramas</h1>

        <div id="diagramContainer"></div>
    </div>

    <script src="{{ asset('vendor/mxgraph/javascript/mxClient.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var container = document.getElementById('diagramContainer');
            var editor = new mxEditor();
            var graph = editor.graph;
            editor.setGraphContainer(container);
        });
    </script>

@endsection
