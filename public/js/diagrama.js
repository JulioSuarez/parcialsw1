function init() {
    // Since 2.2 you can also author concise templates with method chaining instead of GraphObject.make
    // For details, see https://gojs.net/latest/intro/buildingObjects.html
    const $ = go.GraphObject.make;

    myDiagram =
        $(go.Diagram, "myDiagramDiv",
            {
                "undoManager.isEnabled": true,
                layout: $(go.TreeLayout,
                    { // this only lays out in trees nodes connected by "generalization" links
                        angle: 90,
                        path: go.TreeLayout.PathSource,  // links go from child to parent
                        setsPortSpot: false,  // keep Spot.AllSides for link connection spot
                        setsChildPortSpot: false,  // keep Spot.AllSides
                        // nodes not connected by "generalization" links are laid out horizontally
                        arrangement: go.TreeLayout.ArrangementHorizontal
                    })
            });

    // show visibility or access as a single character at the beginning of each property or method
    function convertVisibility(v) {
        switch (v) {
            case "public": return "+";
            case "private": return "-";
            case "protected": return "#";
            case "package": return "~";
            default: return v;
        }
    }

    // the item template for properties
    var propertyTemplate =
        $(go.Panel, "Horizontal",
            // property visibility/access
            $(go.TextBlock,
                { isMultiline: false, editable: false, width: 12 },
                new go.Binding("text", "visibility", convertVisibility)),
            // property name, underlined if scope=="class" to indicate static property
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "name").makeTwoWay(),
                new go.Binding("isUnderline", "scope", s => s[0] === 'c')),
            // property type, if known
            $(go.TextBlock, "",
                new go.Binding("text", "type", t => t ? ": " : "")),
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "type").makeTwoWay()),
            // property default value, if any
            $(go.TextBlock,
                { isMultiline: false, editable: false },
                new go.Binding("text", "default", s => s ? " = " + s : ""))
        );

    // the item template for methods
    var methodTemplate =
        $(go.Panel, "Horizontal",
            // method visibility/access
            $(go.TextBlock,
                { isMultiline: false, editable: false, width: 12 },
                new go.Binding("text", "visibility", convertVisibility)),
            // method name, underlined if scope=="class" to indicate static method
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "name").makeTwoWay(),
                new go.Binding("isUnderline", "scope", s => s[0] === 'c')),
            // method parameters
            $(go.TextBlock, "()",
                // this does not permit adding/editing/removing of parameters via inplace edits
                new go.Binding("text", "parameters", parr => {
                    var s = "(";
                    for (var i = 0; i < parr.length; i++) {
                        var param = parr[i];
                        if (i > 0) s += ", ";
                        s += param.name + ": " + param.type;
                    }
                    return s + ")";
                })),
            // method return type, if any
            $(go.TextBlock, "",
                new go.Binding("text", "type", t => t ? ": " : "")),
            $(go.TextBlock,
                { isMultiline: false, editable: true },
                new go.Binding("text", "type").makeTwoWay())
        );

    // this simple template does not have any buttons to permit adding or
    // removing properties or methods, but it could!
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
                // header
                $(go.TextBlock,
                    {
                        row: 0, columnSpan: 2, margin: 3, alignment: go.Spot.Center,
                        font: "bold 12pt sans-serif",
                        isMultiline: false, editable: true
                    },
                    new go.Binding("text", "name").makeTwoWay()),
                // Console.log("name"),
                // properties
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
                // methods
                // $(go.TextBlock, "Methods",
                //     { row: 2, font: "italic 10pt sans-serif" },
                //     new go.Binding("visible", "visible", v => !v).ofObject("METHODS")),
                // $(go.Panel, "Vertical", { name: "METHODS" },
                //     new go.Binding("itemArray", "methods"),
                //     {
                //         row: 2, margin: 3, stretch: go.GraphObject.Fill,
                //         defaultAlignment: go.Spot.Left, background: "lightyellow",
                //         itemTemplate: methodTemplate
                //     }
                // ),
                // $("PanelExpanderButton", "METHODS",
                //     { row: 2, column: 1, alignment: go.Spot.TopRight, visible: false },
                //     new go.Binding("visible", "methods", arr => arr.length > 0))
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

    function convertToArrow(r) {
        switch (r) {
            case "generalization": return "Triangle";
            case "aggregation": return "StretchedDiamond";
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
        //prevenir el evnto que viene por efauld
        // e.preventDefault();
        // console.warn('entreeeal boton abrir modal!');
        // document.getElementById('myModal').showModal();
    });
    // fin de agregar un nuevo diagrama de clase



    // // Asumiendo que tienes una referencia a tu diagrama llamada 'myDiagram'
    // // Obtén una referencia al nodo que contiene el nombre de la clase
    // var classNode = myDiagram.findNodeForKey("KEY_DEL_NODO_DE_LA_CLASE");

    // // Agrega un evento de escucha para capturar los cambios en el nombre de la clase
    // myDiagram.addDiagramListener("TextEdited", function (event) {
    //     var editedPart = event.subject;
    //     // Verifica si el cambio se realizó en el texto del nombre y si es el nodo de la clase
    //     if (editedPart instanceof go.Node && editedPart.data && editedPart.data.name && editedPart === classNode) {
    //         console.log("Nombre de la clase editado:", editedPart.data.name);
    //     }
    // });








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

                            // var newRelName = prompt("Enter relationship name:");
                            // if (newRelName) {
                            // list.push({ name: newRelName });
                            // itempanel.itemArray = list;  // update Panel.itemArray to reflect addition
                            // }

                            // Actualiza Panel.itemArray y visualiza
                            itempanel.itemArray = list;

                            function guardar(data) {
                                // console.log("Guardar: ", data.properties[0]);
                                // console.log("Guardar: ", data.name);

                                let token = document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content");
                                const id_diagrama = document.getElementById("id_diagrama").value;

                                let formulario = new FormData();
                                formulario.append("name", nombreAtributo);
                                formulario.append("formato", select_data_type);
                                formulario.append("id_clase", id_diagrama);

                                // la ruta debe ser de tipo navegador con un slash al inicio
                                fetch('/clase', {
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

    // setup a few example class nodes and relationships






    var nodedata = [];
    var linkdata = [];
    // console.log(atributos_id[0].value);
    // console.log(clases_id[0].value);
    // console.log(clases_name[0].value);

    var clases_id = document.querySelectorAll('input[name="clase_id[]"]');
    var clases_name = document.querySelectorAll('input[name="clase_name[]"]');
    var atributos_id = document.querySelectorAll('input[name="atributo_id[]"]');
    var atributos_name = document.querySelectorAll('input[name="atributo_name[]"]');

    for (var i = 0; i < clases_id.length; i++) {
        var claseValue = clases_id[i].value;
        var claseName = clases_name[i].value;

        for (var j = 0; j < atributos_id.length - 1; j++) {
            var atributoValue = atributos_id[j].value;
            var atributoName = atributos_name[j].value;

            console.log(claseValue,'ID clase');
            console.log(claseName,'claseName');

            console.log(atributoValue,'ID atributo');
            console.log(atributoName,'atributoName');

            nodedata.push({
                key: claseValue,
                name: claseName,
                properties: [
                    { name: atributoName, type: "String", visibility: "public" },
                ],
            });

        }
    }
    linkdata.push({
        from: 1,
        to: claseValue,
        relationship: "generalization"
    })
    console.log(nodedata);

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
        });



}

window.addEventListener('DOMContentLoaded', init);
