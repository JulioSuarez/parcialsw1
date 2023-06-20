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
                        setsPortSpot: true,  // mantener Spot.AllSides para el punto de conexión del enlace
                        setsChildPortSpot: true,  // mantener Spot.AllSides
                        // los nodos no conectados por enlaces de "generalización" se disponen horizontalmente
                        arrangement: go.TreeLayout.ArrangementHorizontal
                    })
            });


    var linkdata = [];

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
            case "composition": return "Diamond";
            // case "composition": return "Circle";
            case "association": return "";
            default: return "";
        }
    }

    // variables globales para crear un nuevo diagrama de clase by Julico
    var nombre = "Clase";
    var id = "id";
    var tipo_dato = "Llave primaria";

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
        guardarClase(newClassDiagram);

        // console.log("clase id: ", newClassDiagram.key);
        // console.log("clase name: ", newClassDiagram.name);
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

        console.log("formulario para registrar clases");

        let formulario = new FormData();
        formulario.append("id_diagrama", id_diagrama);
        formulario.append("nombre", data.name);
        formulario.append("tipo", data.properties[0].type);

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
                        console.log("id Clase: ", itemdata.key);


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

                            let tipoDeDato = select_data_type.value;
                            console.log(tipoDeDato);
                            switch (tipoDeDato) {
                                case "Numerico":
                                    tipoDeDato = 1;
                                    break;
                                case "Texto":
                                    tipoDeDato = 2;
                                    break;
                                case "Fecha":
                                    tipoDeDato = 3;
                                    break;
                                case "Llave primaria":
                                    tipoDeDato = 4;
                                    break;
                                case "Llave Foranea":
                                    tipoDeDato = 5;
                                    break;
                                default:
                                    tipoDeDato = "ERROR";
                                    break;
                            }

                            console.log("id del tipo de relacion", tipoDeDato);

                            let token = document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content");
                            const id_diagrama = document.getElementById("id_diagrama").value;

                            console.log("FORMULARIO REGISTRA ATRIBUTOS NUEVOS1");
                            let formulario = new FormData();
                            formulario.append("name", nombreAtributo);
                            formulario.append("tipoDeDato", tipoDeDato);
                            formulario.append("id_clase", itemdata.key);
                            formulario.append("id_diagrama", id_diagrama);

                            console.log("FORMULARIO REGISTRA ATRIBUTOS NUEVOS2");
                            console.log("name", nombreAtributo);
                            console.log("tipoDeDato", tipoDeDato);
                            console.log("id_clase", itemdata.key);
                            console.log("id_diagrama", id_diagrama);

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

                        console.log("List: ", itemdata)
                        console.log("ID de la clase que ejecuta: ", itemdata.key)

                        document.getElementById('relacion').showModal();

                        var saveRelation = document.getElementById('saveRelation');
                        saveRelation.onclick = function () {
                            const SelectClaseRelacion = document.getElementById('claseRelacion').value;
                            const tipo_relacion = document.getElementById('tipo_relacion').value;

                            let relacionxd;
                            switch (parseInt(tipo_relacion)) {
                                case 1:
                                    relacionxd = "generalization";
                                    break;
                                case 2:
                                    relacionxd = "aggregation";
                                    break;
                                case 3:
                                    relacionxd = "composition";
                                    break;
                                case 4:
                                    relacionxd = "association";
                                    break;
                                default:
                                    relacionxd = "ERROR";
                                    break;
                            }
                            //EJEMPLO { from: 12, to: 11, relationship: "generalization" }
                            console.log("Tipo de la relacionar: ", relacionxd);
                            const newRelationship = { from: itemdata.key, to: SelectClaseRelacion, relationship: relacionxd };
                            list.push(newRelationship);
                            console.log("Así quedó la relación: ", list);

                            // Crear el enlace en el diagrama
                            myDiagram.startTransaction("addRelationship");
                            myDiagram.model.addLinkData(newRelationship);
                            myDiagram.commitTransaction("addRelationship");





                            let token = document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content");

                            let formulario = new FormData();
                            formulario.append("claseOrigen", itemdata.key);
                            formulario.append("claseDestino", SelectClaseRelacion);
                            formulario.append("tipoRelacion", parseInt(tipo_relacion));

                            // la ruta debe ser de tipo navegador con un slash al inicio
                            fetch('/relacionStore', {
                                headers: {
                                    "X-CSRF-TOKEN": token,
                                },
                                method: 'POST',
                                body: formulario
                            }).then((data) => data.json())
                                .then((data) => {
                                    console.log(data);
                                });









                            // let newRelationship = { from: itemdata.key, to: parseInt(SelectClaseRelacion), relationship: relacionxd };

                            // if (newRelationship) {
                            //     console.log("entreee: ",newRelationship)
                            //     list.push(newRelationship);
                            //     // list.push({ from: itemdata.key, to: parseInt(SelectClaseRelacion), relationship: relacionxd });
                            //     linkdata.push({ from: itemdata.key, to: parseInt(SelectClaseRelacion), relationship: relacionxd });
                            // }
                            // console.log("asdasdasda");

                            // Actualiza Panel.itemArray y visualiza
                            // itempanel.itemArray = list;

                            // Cierra el modal
                            document.getElementById('relacion').close();


                        };
                    }
                },
                $(go.TextBlock, "Relacion", { font: "bold 12pt sans-serif", stroke: "blue" })
            )
        );

    let bt_cerrar_modal2 = document.getElementById('bt_cerrar_modal2');
    bt_cerrar_modal2.addEventListener('click', e => {
        //prevenir el evento que viene por default
        e.preventDefault();
        console.warn('entre al modal de relaciones!');
        document.getElementById('relacion').close();
    });


    // evento que reconoce cuando elimna una relacion
    myDiagram.addDiagramListener("SelectionDeleted", function (e) {
        var diagram = e.diagram;
        var selection = e.subject; // Elementos seleccionados eliminados
        console.log("Me parece que quieres eliminar una relacion", selection);
        selection.each(function (part) {
            if (part instanceof go.Link) {
                var link = part; // Obtener la relación eliminada
                var linkData = link.data;

                console.log("idClaseOrigen ", link.data.from);
                console.log("idClaseDestino ", link.data.to);
                console.log("tipoRelacion ", link.data.relationship);
                //formulario para eliminar de la bd la relacion
                let token = document.querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                let formulario = new FormData();
                formulario.append("idClaseOrigen", link.data.from);
                formulario.append("idClaseDestino", link.data.to);
                formulario.append("tipoRelacion", link.data.relationship);

                console.log("formulario Eliminar Relacion");

                // la ruta debe ser de tipo navegador con un slash al inicio
                fetch('/relacionDestroy', {
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    method: 'POST',
                    body: formulario
                }).then((data) => data.json())
                    .then((data) => {
                        console.log(data);
                    });
                console.log("Relación eliminada:", linkData);
            }
        });
    });


    // Evento para cambiar el nombre de un nodo al hacer doble clic
    myDiagram.addDiagramListener("ObjectDoubleClicked", function (e) {
        var part = e.subject.part;
        if (part instanceof go.Node) {
            var node = part;
            var oldName = node.data.name;
            var keyClase = node.data.key;
            var newName = prompt("Ingrese el nuevo nombre:", oldName);

            // Verificar si se ingresó un nuevo nombre
            console.log("Id de la clase que seleccione:", keyClase);
            if (newName !== null) {
                // Actualizar el nombre del nodo
                console.log("Nuevo nombre:", newName);
                myDiagram.startTransaction("updateNodeName");
                myDiagram.model.setDataProperty(node.data, "name", newName);
                myDiagram.commitTransaction("updateNodeName");

                // Formulario para actualizar los nombres de las clases

                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

                let formulario = new FormData();
                formulario.append("idClase", keyClase);
                formulario.append("NuevoNombre", newName);

                console.log("Formulario para actualizar nombre de mis clases by julico");
                console.log(keyClase);
                console.log(newName);

                // La ruta debe ser de tipo navegador con una barra diagonal al inicio
                fetch('/claseUpdate', {
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
        }
    });




    // Agrega un evento al botón con el ID "screenDiagram"
    var xd = document.getElementById("screenDiagram");
    xd.onclick = function () {
        var diagram = go.Diagram.fromDiv("myDiagramDiv");

        // Realiza una disposición completa del diagrama antes de generar la imagen
        diagram.layoutDiagram(true);

        // Obtiene el tamaño del contenido del diagrama
        var bounds = diagram.documentBounds;
        var padding = 10; // Margen adicional alrededor del contenido
        var imgWidth = bounds.width + padding;
        var imgHeight = bounds.height + padding;

        // Crea un elemento de lienzo temporal para generar la imagen
        var canvas = document.createElement("canvas");
        canvas.width = imgWidth;
        canvas.height = imgHeight;

        // Obtiene el contexto 2D del lienzo
        var ctx = canvas.getContext("2d");

        // Establece el fondo del lienzo en blanco
        ctx.fillStyle = "white";
        ctx.fillRect(0, 0, imgWidth, imgHeight);

        // Renderiza el diagrama en el lienzo
        diagram.renderCanvas(ctx, new go.Rect(0, 0, imgWidth, imgHeight));

        // Convierte el lienzo en una imagen
        var image = canvas.toDataURL("image/png");

        // Crea un enlace para descargar la imagen
        var link = document.createElement("a");
        link.href = image;
        link.download = "diagrama.png";

        // Dispara el evento de clic en el enlace para iniciar la descarga de la imagen
        link.click();
    };





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



    console.log('---------------------------')

    var nodedata = [];
    var propiedades = [];
    var clasesxd = document.querySelectorAll('input[name="clases"]');
    var atributosxd = document.querySelectorAll('input[name="atributos"]');

    var claseObj = JSON.parse(clasesxd[0].value);
    var atributoObj = JSON.parse(atributosxd[0].value);

    console.log("all clases: ", claseObj);
    console.log("all atributos: ", atributoObj);
    console.log("all Relaciones: ", relacionesObj);

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
            console.warn(co.id, iterator.clase_id)
            if (co.id === iterator.clase_id) {
                console.log("entre en:", contador);
                let opcion;

                switch (iterator.tipo_id) {
                    case 1:
                        opcion = "Numerico";
                        break;
                    case 2:
                        opcion = "Texto";
                        break;
                    case 3:
                        opcion = "Fecha";
                        break;
                    case 4:
                        opcion = "Llave primaria";
                        break;
                    case 5:
                        opcion = "Llave Foranea";
                        break;
                    default:
                        opcion = "ERROR";
                        break;
                }

                aux_nodedata['properties'].push({
                    name: iterator.name,
                    type: opcion,
                    visibility: "public",
                });

            }
            contador++;
        }
        console.warn("ABAJO ", aux_nodedata['properties']);

        nodedata.push(aux_nodedata);
    }
    console.warn("NODE", nodedata);


    var relaciones = document.querySelectorAll('input[name="relaciones"]');
    var relacionesObj = JSON.parse(relaciones[0].value);
    for (let rel of relacionesObj) {

        console.log("relacion_id ", rel.id);
        console.log("relacion_origen ", rel.clase_origen);
        console.log("relacion_destino ", rel.clase_destino);
        console.log("relacion_tipo ", rel.tipo_relacion);

        let relacion_tipo;
        switch (parseInt(rel.tipo_relacion)) {
            case 1:
                relacion_tipo = "generalization";
                break;
            case 2:
                relacion_tipo = "aggregation";
                break;
            case 3:
                relacion_tipo = "composition";
                break;
            case 4:
                relacion_tipo = "association";
                break;
            default:
                relacion_tipo = "ERROR";
                break;
        }

        linkdata.push({ from: rel.clase_origen, to: rel.clase_destino, relationship: relacion_tipo });
    }
    /*
        case "generalization": return "Triangle";
        case "aggregation": return "StretchedDiamond";
        case "composition": return "Circle";
        case "association": return "";
    */
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
        console.log("nodeDataArray: ", nodedata),
        console.log("linkDataArray: ", linkdata),
    );
}

window.addEventListener('DOMContentLoaded', init);
