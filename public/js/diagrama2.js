function init() {
    const $ = go.GraphObject.make;

    myDiagram =
        $(go.Diagram, "myDiagramDiv",
            {
                "undoManager.isEnabled": true,
                layout: $(go.TreeLayout,
                    { // esto solo se presenta en nodos de árboles conectados por enlaces de "generalización"
                        angle: 90,
                        path: go.TreeLayout.PathSource,  // los enlaces van del hijo al padre
                        setsPortSpot: false,  // mantener Spot.AllSides para el punto de conexión del enlace
                        setsChildPortSpot: false,  // mantener Spot.AllSides
                        // los nodos no conectados por enlaces de "generalización" se disponen horizontalmente
                        arrangement: go.TreeLayout.ArrangementHorizontal
                    })
            });


    // mostrar visibilidad o acceso como un solo carácter al principio de cada propiedad o método
    function convertVisibility(v) {
        switch (v) {
            case "public": return "+";
            case "private": return "-";
            case "protected": return "#";
            case "package": return "~";
            default: return v;
        }
    }

    // la plantilla de elemento para propiedades
    var propertyTemplate =
        $(go.Panel, "Horizontal",
            // visibilidad/acceso a la propiedad
            $(go.TextBlock,
                { isMultiline: false, editable: false, width: 12 },
                new go.Binding("text", "visibility", convertVisibility)),
            // nombre de propiedad, subrayado si scope=="class" para indicar propiedad estática
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "name").makeTwoWay(), // Permitir edición bidireccional del nombre
                new go.Binding("isUnderline", "scope", s => s[0] === 'c')),
            // tipo de propiedad, si se conoce
            $(go.TextBlock, "",
                new go.Binding("text", "type", t => t ? ": " : "")),
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "type").makeTwoWay()),
            // valor predeterminado de la propiedad, si lo hay
            $(go.TextBlock,
                { isMultiline: false, editable: false },
                new go.Binding("text", "default", s => s ? " = " + s : ""))
        );

    // la plantilla de elementos para métodos
    var methodTemplate =
        $(go.Panel, "Horizontal",
            // visibilidad/acceso al método
            $(go.TextBlock,
                { isMultiline: false, editable: false, width: 12 },
                new go.Binding("text", "visibility", convertVisibility)),
            // nombre del método, subrayado si scope=="class" para indicar el método estático
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "name").makeTwoWay(),
                new go.Binding("isUnderline", "scope", s => s[0] === 'c')),
            // parámetros del método
            $(go.TextBlock, "()",
                // esto no permite agregar/editar/eliminar parámetros a través de ediciones en el lugar
                new go.Binding("text", "parameters", parr => {
                    var s = "(";
                    for (var i = 0; i < parr.length; i++) {
                        var param = parr[i];
                        if (i > 0) s += ", ";
                        s += param.name + ": " + param.type;
                    }
                    return s + ")";
                })),
            // tipo de retorno del método, si lo hay
            $(go.TextBlock, "",
                new go.Binding("text", "type", t => t ? ": " : "")),
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "type").makeTwoWay())
        );

    // esta sencilla plantilla no tiene ningún botón que permita agregar o
    // eliminar propiedades o métodos, ¡pero podría hacerlo!
    myDiagram.nodeTemplate =
        $(go.Node, "Auto",
            {
                locationSpot: go.Spot.Center,
                fromSpot: go.Spot.AllSides,
                toSpot: go.Spot.AllSides
            },
            $(go.Shape, { fill: "lightyellow" }),
            $(go.Panel, "Table",
                { defaultRowSeparatorStroke: "black" },
                // encabezado
                $(go.TextBlock,
                    {
                        row: 0, columnSpan: 2, margin: 3, alignment: go.Spot.Center,
                        font: "bold 12pt sans-serif",
                        isMultiline: false, editable: true
                    },
                    new go.Binding("text", "name").makeTwoWay()),
                $(go.TextBlock, "Properties",
                    { row: 1, font: "italic 10pt sans-serif" },
                    new go.Binding("visible", "visible", v => !v).ofObject("PROPERTIES")),
                $(go.Panel, "Vertical", { name: "PROPERTIES" },
                    new go.Binding("itemArray", "properties"),
                    {
                        row: 1, margin: 3, stretch: go.GraphObject.Fill,
                        defaultAlignment: go.Spot.Left, background: "lightyellow",
                        itemTemplate: propertyTemplate
                    }
                ),
                $("PanelExpanderButton", "PROPERTIES",
                    { row: 1, column: 1, alignment: go.Spot.TopRight, visible: false },
                    new go.Binding("visible", "properties", arr => arr.length > 0)),
            )
        );


    function convertIsTreeLink(r) {
        return r === "generalization";
    }

    function convertFromArrow(r) {
        switch (r) {
            case "generalization": return "";
            default: return "";
        }
    }

    // function convertToArrow(r) {
    //     switch (r) {
    //         case "generalization": return "Triangle";
    //         case "aggregation": return "StretchedDiamond";
    //         default: return "";
    //     }
    // }

    function convertToArrow(r) {
        switch (r) {
            case "generalization": return "Triangle";
            case "aggregation": return "StretchedDiamond";
            case "composition": return "Circle";
            case "association": return "";
            default: return "";
        }
    }


    var nombre = "NewClassXD";
    var id = "id";
    var tipo_dato = "Primary key";

    // agregar una nueva clase al diagrama
    function addNewClassDiagram() {
        // Crea un nuevo objeto nodedata para el nuevo diagrama de clase
        var newClassDiagram = {
            key: myDiagram.model.nodeDataArray.length + 1,
            name: nombre,
            properties: [
                { name: id, type: tipo_dato, visibility: "public" },
            ],
            methods: []
        };
        // console.log(nombre);
        guardarClase(newClassDiagram);

        console.log("nombre de la clase: ", newClassDiagram.key);
        // Agrega el nuevo objeto nodedata al arreglo nodeDataArray del modelo del diagrama
        myDiagram.model.addNodeData(newClassDiagram);
    }

    // Agrega un evento click al botón en tu vista Blade
    var addButton = document.getElementById("addButton");
    // addButton.addEventListener("click", addNewClassDiagram);
    addButton.addEventListener('click', e => {
        addNewClassDiagram();
    });
    // fin de agregar un nuevo diagrama de clase








    function guardarClase(data) {
        let token = document.querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const id_diagrama = document.getElementById("id_diagrama").value;

        let formulario = new FormData();
        // agrego el id del diagrama
        formulario.append("id_diagrama", id_diagrama);
        console.log("Guardar: ", id_diagrama);

        // agrego los datos de la clase
        // agrego el nombre de la clase al formulario
        formulario.append("nombre", data.name);
        console.log("Guardar: ", data.name);
        // no estoy agregando el nombre del primer atributo porque es obvio que es ID primary key
        // solo agrego el tipo de atributo
        formulario.append("tipo", data.properties[0].type);
        console.log("Guardar: ", data.properties[0].type);

        // console.log(formulario);
        fetch('/claseStore', {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: 'POST',
            body: formulario

        }).then((data) => data.json())
            .then((data) => {
                console.log(data);
            });
    }




    // agregar atributos a la clase y relaciones
    var propertyTemplate = $(go.Panel, "Horizontal",
        $(go.Shape,
            { width: 12, height: 12, fill: null },
            new go.Binding("figure", "type", function (t) {
                if (t === "String") return "Ellipse";
                if (t === "Date") return "Diamond";
                if (t === "Currency") return "Square";
                if (t === "List") return "TriangleUp";
                return "Rectangle";
            }),
            new go.Binding("stroke", "visibility", function (v) {
                return v === "public" ? "green" : "red";
            })
        ),
        $(go.TextBlock,
            { margin: new go.Margin(0, 2), font: "10pt sans-serif" },
            new go.Binding("text", "name"),
            new go.Binding("stroke", "visibility", function (v) {
                return v === "public" ? "green" : "red";
            })
        ),
        {
            click: function (e, obj) {
                var itempanel = obj.panel.panel.panel;
                var itemdata = itempanel.part.data;
                var itemarray = itempanel.itemArray;
                var list = itemdata.properties || [];
                list.splice(itemarray.indexOf(obj.data), 1);  // remove
                itempanel.itemArray = list;  // update Panel.itemArray to reflect removal
            }
        }
    );


    myDiagram.nodeTemplate.selectionAdornmentTemplate =
        $(go.Adornment, "Spot",
            $(go.Panel, "Auto",
                $(go.Shape, { fill: null, stroke: "blue", strokeWidth: 2 }),
                $(go.Placeholder)
            ),
            $("Button",
                {
                    alignment: go.Spot.TopRight,
                    click: function (e, obj) {
                        var node = obj.part.adornedPart;
                        var itempanel = node.findObject("PROPERTIES");
                        var itemdata = node.data;
                        var list = itemdata.properties || [];
                        console.log("itemdata: ", itemdata.key);


                        document.getElementById('myModal').showModal();
                        // Espera a que el usuario complete el formulario y haga clic en "Guardar"
                        var saveButton = document.getElementById('saveButton');
                        saveButton.onclick = function () {
                            // const sintaxisSelect = document.getElementById('sintaxis');
                            const nombreAtributo = document.getElementById('name').value;
                            const select_data_type = document.getElementById('data_type');


                            // Comprueba la sintaxis seleccionada y agrega los datos correspondientes a la lista
                            if (nombreAtributo) {
                                list.push({ name: nombreAtributo, type: select_data_type.value, visibility: "public" });
                            }

                            // Actualiza Panel.itemArray y visualiza
                            itempanel.itemArray = list;

                            let token = document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content");
                            const id_diagrama = document.getElementById("id_diagrama").value;

                            let formulario = new FormData();
                            formulario.append("name", nombreAtributo);
                            formulario.append("formato", select_data_type);
                            formulario.append("id_clase", itemdata.key);
                            formulario.append("id_diagrama", id_diagrama);

                            // la ruta debe ser de tipo navegador con un slash al inicio
                            fetch('/atributoStore', {
                                headers: {
                                    "X-CSRF-TOKEN": token,
                                },
                                method: 'POST',
                                body: formulario
                            }).then((data) => data.json())
                                .then((data) => {
                                    console.log(data);
                                });
                            // }

                            // Cierra el modal
                            document.getElementById('myModal').close();
                        };
                    }
                },
                $(go.TextBlock, "+", { font: "bold 12pt sans-serif", stroke: "blue" })
            ),
            $("Button",
                {
                    alignment: go.Spot.BottomRight,
                    click: function (e, obj) {
                        var node = obj.part.adornedPart;
                        var itempanel = node.findObject("RELATIONSHIPS");
                        var itemdata = node.data;
                        var list = itemdata.relationships || [];

                        var relacion = [];
                        var tipo_de_relacion = [];

                        document.getElementById('relacion').showModal();

                        var saveRelation = document.getElementById('saveRelation');
                        saveRelation.onclick = function () {
                            const clase = document.getElementById('clase');
                            const tipo_relacion = document.getElementById('tipo_relacion');

                            // Comprueba la sintaxis seleccionada y agrega los datos correspondientes a la lista
                            if (clase.value === '1') {
                                relacion.push({ from: 1, to: 11 });
                            }

                            if (tipo_relacion.value === 'agreacion') {
                                tipo_de_relacion.push({ relationship: "aggregation" });
                            }

                            console.log(relacion);
                            console.log(tipo_de_relacion);
                            list.merge(relacion, tipo_de_relacion);
                            console.log(list);

                            // Actualiza Panel.itemArray y visualiza
                            itempanel.itemArray = list;

                            // Cierra el modal

                            let bt_cerrar_modal2 = document.getElementById('bt_cerrar_modal2');
                            bt_cerrar_modal2.addEventListener('click', e => {
                                //prevenir el evnto que viene por default
                                e.preventDefault();
                                console.warn('entre al modal de relaciones!');
                                document.getElementById('relacion').close();
                            });

                        };
                    }
                },
                $(go.TextBlock, "Relacion", { font: "bold 12pt sans-serif", stroke: "blue" })
            )
        );



    myDiagram.linkTemplate =
        $(go.Link,
            { routing: go.Link.Orthogonal },
            new go.Binding("isLayoutPositioned", "relationship", convertIsTreeLink),
            $(go.Shape),
            $(go.Shape, { scale: 1.3, fill: "white" },
                new go.Binding("fromArrow", "relationship", convertFromArrow)),
            $(go.Shape, { scale: 1.3, fill: "white" },
                new go.Binding("toArrow", "relationship", convertToArrow))
        );



    console.log('hola mnjdon!!!0')

    var nodedata = [];
    var linkdata = [];
    var propiedades = [];
    var clasesxd = document.querySelectorAll('input[name="clases"]');
    var atributosxd = document.querySelectorAll('input[name="atributos"]');

    var claseObj = JSON.parse(clasesxd[0].value);
    var atributoObj = JSON.parse(atributosxd[0].value);
    console.log("all clases: ", claseObj);
    console.log("all atributos: ", atributoObj);
    var contadorClase = 0;
    var contadorAtributo = 0;
    for (const co of claseObj) {

        let aux_nodedata = {
            key: co.id,
            name: co.name,
            properties: [],
        };

        console.log("ARRIBA ", nodedata);
        console.log("len: ", atributoObj.length);
        let contador = 0;
        for (const iterator of atributoObj) {
            // console.log("entre com:",contador);
            console.warn(co.id ,iterator.clase_id)
            if (co.id === iterator.clase_id) {
                // const contador = 0;
                console.log("entre en:",contador);


                aux_nodedata['properties'].push({
                        name: iterator.name,
                        type: "iterator.formato",
                        visibility: "public",
                    });

            }
            contador++;
        }
        console.warn("ABAJO ",aux_nodedata['properties']);

        nodedata.push(aux_nodedata);
    }
    console.warn("NODE",nodedata);

    // var linkdata = [
    //     { from: 12, to: 11, relationship: "generalization" },
    //     { from: 13, to: 11, relationship: "generalization" },
    //     { from: 14, to: 13, relationship: "aggregation" },
    //     { from: 1, to: 14, relationship: "assotiation" }
    // ];

    myDiagram.model = new go.GraphLinksModel(
        {
            copiesArrays: true,
            copiesArrayObjects: true,
            nodeDataArray: nodedata,
            linkDataArray: linkdata
        },
        console.log("nodeDataArray: ",nodedata),
        console.log("linkDataArray: ",linkdata),
    );
}

window.addEventListener('DOMContentLoaded', init);
