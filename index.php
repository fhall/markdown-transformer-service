<?php

namespace fhall\MarkdownTransformerService;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

/** Create the Slim App */
$app = new \Slim\App;

/**
 * Main route
 * Method: get
 */
$app->get('/', function(Request $request, Response $response) {
  $parsedown = new \Parsedown();

  $content = file_get_contents('./readme.md');
  $parsed_content = $parsedown->text($content);

  $response->getBody()->write($parsed_content);
  return $response;
});

/**
 * Route for transforming input markdown or markdown at a resource URL
 * Method: post
 */
$app->post('/', function(Request $request, Response $response) {
  $parsedown = new \Parsedown();

  $content = $request->getBody();

  if(filter_var($content, FILTER_VALIDATE_URL)) {
    $content = file_get_contents($content);
  }

  $parsed_content = $parsedown->text($content);
  $response->getBody()->write($parsed_content);

  return $response;
});

/**
 * Route for transforming markdown at a resource URL
 * Method: get
 */
$app->get('/{url}', function (Request $request, Response $response) {
  $parsedown = new \Parsedown();

  $url = $request->getAttribute('url');

  if(filter_var($url, FILTER_VALIDATE_URL)) {
    $content = file_get_contents($url);
    $parsed_content = $parsedown->text($content);
    $response->getBody()->write($parsed_content);
  } else {
    $response->getBody()->write('The url parameter is not a valid resource url');
    $response = $response->withStatus(400);
  }

  return $response;
});

$app->run();
