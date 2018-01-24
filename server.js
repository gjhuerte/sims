var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
// var redis = new Redis();
var redis = new Redis(process.env.REDIS_PORT, process.env.REDIS_HOST);
var dotenv = require('dotenv').config()

redis.subscribe('approval', function(err, count) {  });

redis.subscribe('trigger-announcement', function(err, count) {  });

redis.subscribe('generate-request', function(err, count){  });

redis.subscribe('request', function(err, count) {  });

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(process.env.SOCKET_PORT, function(){
    console.log('Listening on Port ' + process.env.SOCKET_PORT);
}); 

redis.on("call", function(channel, data) {
	socket.emit(channel, data);
});