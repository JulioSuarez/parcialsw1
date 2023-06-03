// Contenedor donde se renderizará el diagrama
var container = document.getElementById('diagram-container');

// Crear el objeto del gráfico
var graph = new mxGraph(container);

// Agregar código para manipular el gráfico, crear elementos, establecer relaciones, etc.

// Ejemplo: Agregar un nodo al gráfico
var parent = graph.getDefaultParent();
graph.getModel().beginUpdate();
try {
    var vertex = graph.insertVertex(parent, null, 'Nodo 1', 20, 20, 80, 30);
} finally {
    graph.getModel().endUpdate();
}
