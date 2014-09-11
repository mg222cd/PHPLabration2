<?php

class HTMLView{

    public function echoHTML($body){
        setlocale(LC_ALL, "sve");
        $time = strftime("%A, den %d %B år %Y. Klockan är [%X]");
        echo "<!DOCTYPE html>
              <meta charset = 'UTF-8'>
              <html>
              <body>
                $body
                <p>$time</p>
              </body>
              </html>";
    }
}