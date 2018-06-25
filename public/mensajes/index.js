var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);

app.use(express.static('public'));

var messages = [{
	author: "Carlos",
    text: "Hola! que tal?"
},{
	author: "Pepe",
    text: "Muy bien! y tu??"
},{
	author: "Paco",
    text: "Genial!"
}];

io.on('connection', function(socket) {
	console.log('Un cliente se ha conectado');
    socket.emit('messages', messages);
});

app.listen(3000,function(){
    console.log('Server running in port 8080');
});
