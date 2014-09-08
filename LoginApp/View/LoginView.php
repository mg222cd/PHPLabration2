<?php

class LoginView{

    public function ViewLogin(){
        $ret = "<h2>Inloggningsmodul för xx222xx</h2>

        <form>
            Användarnamn: <input type='text' name='username'>
            Lösenord: <input type='password' name='password'>
            <input type='submit' value='Logga in'>
        </form>";

        return $ret;
    }
}