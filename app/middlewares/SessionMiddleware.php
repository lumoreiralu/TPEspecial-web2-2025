<?php

class SessionMiddleware {

    public function run($request) {
        if (isset($_SESSION['USER_ID'])) {
            $request->user = new StdClass();
            $request->user->id_usuario = $_SESSION['USER_ID'];
            $request->user->user = $_SESSION['USER_NAME']; 
            $request->user->rol = $_SESSION['USER_ROLE'] ?? 'user'; // si no existe, usa 'user' por defecto
        } else {
            $request->user = null;
        }
        return $request;
    }
}
