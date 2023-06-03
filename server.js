const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, { cors: { origin: " *" } });

io.on('connection', (socket) => {
    console.log('Cliente Socket: ' + socket.id);

    // recivimos el mensaje del cliente y mandamos la respuesta
    socket.on('saludo', (user_id) => {
        console.log(user_id);
        const respuesta = "Hola cambita " + user_id;
        io.emit('saludo_respuesta', respuesta);
    });








    socket.on('disconnect', () => {
        console.log("Cliente Desconectado: " + socket.id);
    });

});

server.listen(3000, () => {
    console.log('Servidor Conectado');
});
