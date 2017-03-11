<?php

namespace fhall\Service\Markdown\Transformer;

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

  /** Get the request body contents */
  $resource = $request->getBody()->getContents();

  if(filter_var($resource, FILTER_VALIDATE_URL)) {
    /** Create a HTTP client and fetch the resource */
    $http_client = new \GuzzleHttp\Client();
    $http_response = $http_client->request('GET', $resource);
    $resource = $http_response->getBody();
  }

  /** Transform the resource from Markdown to HTML */
  $parsed_resource = $parsedown->text($resource);

  /** Write the transformed resource to the http response */
  $response->getBody()->write($parsed_resource);

  return $response;
});

/**
 * Route for transforming markdown at a resource URL
 * Method: get
 */
$app->get('/{url}', function (Request $request, Response $response) {
  $parsedown = new \Parsedown();

  /** Get the url request by the client */
  $url = $request->getAttribute('url');

  if(filter_var($url, FILTER_VALIDATE_URL)) {
    /** Create a HTTP client and fetch the resource */
    $http_client = new \GuzzleHttp\Client();
    $http_response = $http_client->request('GET', $url);
    $resource = $http_response->getBody();

    /** Transform the resource from Markdown to HTML */
    $parsed_resource = $parsedown->text($content);

    /** Write the transformed resource to the http response */
    $response->getBody()->write($parsed_resource);
  } else {
    $response->getBody()->write('The url parameter is not a valid resource url');
    $response = $response->withStatus(400);
  }

  return $response;
});

$app->run();
