console.log("hola mundo");
// document.getElementById('myModal').showModal();

//necesito saber la cantidad cotara
// $cantidad_ventas = document.getElementById('cantidad_ventas').value;
// console.log($cantidad_ventas );

// for (let i = 0; i < $cantidad_ventas; i++) {
    // let bt_abrir_modal = document.getElementById('bt_abrir_modal');
    // // console.log(document.getElementById('myModal'+i));
    // bt_abrir_modal.addEventListener('click', e => {
    //     //prevenir el evnto que viene por efauld
    //     e.preventDefault();
    //     console.warn('entreeeal boton abrir modal!');
    //     document.getElementById('myModal').showModal();
    // });

    let bt_cerrar_modal = document.getElementById('bt_cerrar_modal');
    bt_cerrar_modal.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        console.warn('entreeeal boton cerrar  modal!');
        document.getElementById('myModal').close();
    });

    let bt_cerrar_modal2 = document.getElementById('bt_cerrar_modal2');
    bt_cerrar_modal2.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        console.warn('entreeeal boton cerrar  modal!');
        document.getElementById('relacion').close();
    });
// }
