SSE Lib
======

A library to create real-time server-sent events on your own PHP Server. On the client side you can use a simple and easy to use javascript to get the events in real-time.

## Requirements

* PHP 5.4 or later

## Installation via Composer

```bash
$ composer require itzyanick/sselib
```

## Usage

### Server Code example (PHP)

```PHP
use ItzYanick\SSELIB\Server;
use ItzYanick\SSELIB\Event;

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
header('X-Accel-Buffering: no'); // optional

$dataCallback = function ($var, $prevData) {
    $push = ['content' => 'Fools'];
    if (empty($push)) {
        return false;
    }
    return [json_encode(compact('push')), json_encode(compact('push'))];
};

$abortCallback = function () {

};

$server = new Server();
$server->setEvent(new Event($dataCallback, 'data', 'var', $abortCallback));
$server->startServer(0);
```

### Start the Server Example

```bash
$ php -S 127.0.0.1:9001 -t .
```

### Client Code example (Javascript)

```Javascript
const source = new EventSource('http://127.0.0.1:9001/sse.php', {withCredentials:true});
source.addEventListener('data', function(event) {
    console.log(event.data);
    // source.close(); // disconnect stream
}, false);
```

## License

[MIT](https://github.com/itzyanick/sselib/blob/master/LICENSE)
