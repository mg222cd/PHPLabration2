<?php

class HTMLView{

    public function echoHTML($body){
        echo "<!DOCTYPE html>
              <meta charset = 'UTF-8'>
              <html>
              <body>
                $body
              </body>
              </html>";
    }
}