# MarkdownTransformerService

This is a micro service for transforming Markdown.

## Routes

| Route | Method | Parameters | Description |
|:------|:-------|:-----------|:------------|
| /     | GET    |            | The main route. Contains information about the service |
| /     | POST   |            | The content of the payload body will be transformed and returned |

## Attributions

This project makes use of [Slim microframework for PHP](https://www.slimframework.com) and [Parsedown](http://parsedown.org). Thank you for developing and maintaining these excellent projects.
