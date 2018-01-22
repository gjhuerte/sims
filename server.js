var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
var dotenv = require('dotenv').config()

redis.subscribe('trigger-notification', function(err, count) {
});

http.listen(process.env.SOCKET_PORT, function(){
    console.log('Listening on Port ' + process.env.SOCKET_PORT);
});