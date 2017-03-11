# MarkdownTransformerService

This is a micro service for transforming Markdown.

## Routes

| Route | Method | Parameters | Description |
|:------|:-------|:-----------|:------------|
| /     | GET    |            | The main route. Contains information about the service |
| /     | POST   |            | The content of the payload body will be transformed and returned |

## Attributions

This project makes use of

* [Slim](https://www.slimframework.com), a microframework in PHP
* [Parsedown](http://parsedown.org), a Markdown parser in PHP
* [Guzzle](https://github.com/guzzle/guzzle), a HTTP client in PHP

Thank you for developing and maintaining these excellent projects.
