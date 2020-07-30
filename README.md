SSE Lib
======

for PHP

## Requirements

* PHP 5.4 or later

### Client example (Javascript)

```Javascript
const source = new EventSource('http://127.0.0.1:9001/sse.php', {withCredentials:true});
source.addEventListener('data', function(event) {
    console.log(event.data);
    // source.close(); // disconnect stream
}, false);
```

### Server example (PHP)

```PHP
use ItzYanick\SSELIB\Server;
use ItzYanick\SSELIB\Event;

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
header('X-Accel-Buffering: no'); // optional

$callback = function () {
    $push = ['content' => 'Fools'];
    if (empty($push)) {
        return false;
    }
    return json_encode(compact('push'));
};
(new SSE(new Event($callback, 'data')))->start(5);
```

## License

[MIT](https://github.com/itzyanick/sselib/blob/master/LICENSE)
