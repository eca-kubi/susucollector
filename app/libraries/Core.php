<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
  protected $currentController = 'Home';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {

    $url = $this->getUrl();

    if (isset($url[0])) {
      // Look for first value
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        // If exists, set as controller
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      } else {
        // Redirect to 404 page
        Helpers::redirect('Errors', 'index', 404);
      }
    }

    // Require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;

    // Check for second part of url
    if (isset($url[1])) {
      // Check to see if method exists in controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      } else {
        // Redirect to 404 page
        Helpers::redirect('errors', 'index', 404);
      }
    }

    // Get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl(): array
  {
      $url = [];
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
    }
      return $url;
  }
}
