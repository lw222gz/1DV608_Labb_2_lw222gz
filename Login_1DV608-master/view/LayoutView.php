<?php


class LayoutView {
  
  //echos out all of the html
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, $rv) {
    $html = '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 4</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">';
          
          if (!isset($_GET["register"])){
              $html .= $v->response();
          }
          else{
            //CONTINUE: Write layout in RegisterView
            $html .= $rv -> RegisterLayout();
          }
          $html .= $dtv->show();    
          $html .= '</div>
         </body>
      </html>
    ';
    echo $html;
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return $this->renderOption() . '<br/><h2>Not logged in</h2>';
    }
  }
  
  private function renderOption(){
      if (isset($_GET["register"])){
           return '<a href=?>Back to login</a>';
      }
      else { 
        return '<a href=?register>Register a new user</a>';
      }
    }
  
}
