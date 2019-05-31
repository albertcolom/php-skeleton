PHP skeleton Without a Framework
==============

### Examples in this repo

- [x] ***Routing*** with [FastRoute](https://github.com/nikic/FastRoute)
- [x] ***Dependency injection*** and container with [PHP-DI](http://php-di.org/)
- [x] ***CommandBus*** and ***CommandQuery*** with [Tactician](https://tactician.thephpleague.com)
- [x] Very simple ***API***

### Run

```sh
$ php -S 0.0.0.0:8000 -t public/
```

### Routes

```
[GET] /                 http://localhost:8000/
[GET|POST] /foo         http://localhost:8000/foo
```