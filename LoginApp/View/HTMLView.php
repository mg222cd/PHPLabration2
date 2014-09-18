<?php

class HTMLView{

    public function echoHTML($body){
        date_default_timezone_set("Europe/Stockholm");
        setlocale(LC_ALL, "sve");
        $time = strftime("%A, den %d %B år %Y. Klockan är [%X]");
        echo "<!DOCTYPE html>
              <html>
              <head>
                <title>Login</title>
                <meta charset = 'UTF-8'>
              </head>
              <body>
                $body
                <p>$time</p>
              </body>
              </html>";
    }
}