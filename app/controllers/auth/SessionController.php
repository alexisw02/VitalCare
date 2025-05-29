<?php

    namespace app\controllers\auth;

    use app\controllers\Controller as Controller;
    use app\classes\View as View;
    use app\models\user as user;

    class SessionController extends Controller {
        public function __construct(){
            parent::__construct();
        }
    
        public function iniSession($params = null){
            $response = [
                'title' => "Iniciar sesión",
                'ua' => self::sessionValidate() ?? ['sv' => false],
                'code' => 200
            ];
            View::render('auth/inisession', $response);
        }

        public function userAuth(){
            $datos = filter_input_array(INPUT_POST , FILTER_SANITIZE_SPECIAL_CHARS);

            $user = new user();

            $result = $user -> where([["username",$datos['username']],["passwd",sha1($datos['passwd'])]]) -> get();

            if( count( json_decode($result) ) > 0 ){
                //Se registra la sesión
                echo $this -> sessionRegister( $result );
            }else{
                self::sessionDestroy();
                echo json_encode( ["r" => false]);
            }
        }

        private function sessionRegister( $r ){
            $datos = json_decode( $r );
            session_start();
            $_SESSION['sv']       = true;
            $_SESSION['IP']       = $_SERVER['REMOTE_ADDR'];
            $_SESSION['id']       = $datos[0]->id;
            $_SESSION['username'] = $datos[0]->username;
            $_SESSION['passwd']   = $datos[0]->passwd;
            $_SESSION['tipo']     = $datos[0]->tipo;
            session_write_close();
            return json_encode( ["r" => true]);

        }

        public static function sessionValidate(){
            $user = new user();
            session_start();
            
            if(isset($_SESSION['sv']) && $_SESSION['sv'] == true){
                $datos = $_SESSION;
                
                $result = $user -> where([["username",$datos['username']],
                                        ["passwd",$datos['passwd']]]) -> get(); 

                if( count(json_decode($result)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
                    session_write_close();
                    return ['username'=>$datos['username'],
                            'sv'=>$datos['sv'],
                            'id'=>$datos['id'],
                            'tipo'=>$datos['tipo']];
                }else{
                    session_write_close();
                    self::sessionDestroy();
                    return null;
                }
            }
            session_write_close();
            self::sessionDestroy();
            return null;
        }

        private static function sessionDestroy(){
            session_start();
            $_SESSION = ['sv' => false];
            session_destroy();
            session_write_close();
        }

        public function logout(){
            $this->sessionDestroy();
            //Redirect::to('/');
            exit();
        }

        // Muestra el formulario
        public function register($params = null){
            $response = [
                'title' => 'Registro de Usuario',
                'ua'    => self::sessionValidate() ?? ['sv' => false],
            ];
            View::render('auth/register', $response);
        }

        // Procesa el formulario (POST)
        public function registerUser(){
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $user = new user();

            // Aquí podrías validar si el email ya existe antes de registrar
            $exists = json_decode($user->where([['email', $data['email']]])->get());
            if (count($exists) > 0) {
                $_SESSION['login_error'] = 'El correo ya está registrado.';
                header('Location: /VitalCare/app/public/?uri=Session/register');
                exit();
            }

            $create = $user->insert($data);

            if ($create) {
                $_SESSION['login_success'] = 'Usuario registrado correctamente.';
                header('Location: /VitalCare/app/public/?uri=Session/iniSession');
                exit();
            } else {
                $_SESSION['login_error'] = 'Error al registrar usuario.';
                header('Location: /VitalCare/app/public/?uri=Session/register');
                exit();
            }
        }

    }