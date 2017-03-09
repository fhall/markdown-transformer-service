# MarkdownTransformerService

This is a micro service for transforming Markdown and creating other representations.

## Routes

The main route (/) supports GET (service information) and POST (content or a a resource url to be transformed).

The second route available (/<url>) is used to transform a representation of the resource specified by the url (GET).

## Attributions

This project makes use of [Slim microframework for PHP](https://www.slimframework.com) and [Parsedown](http://parsedown.org).
