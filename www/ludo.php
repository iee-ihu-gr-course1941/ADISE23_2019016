<?php
require_once "../lib/dbconnect.php";
require_once "handleboard.php";
require_once "handleusers.php";

$method = $_SERVER['REQUEST_METHOD']; 
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$request = explode('/', trim($_SERVER['SCRIPT_NAME'],'/')); 
// Σε περίπτωση που τρέχουμε php–S 

$input = json_decode(file_get_contents('php://input'),true);
switch ($r=array_shift($request)) { 
    case 'board' : 
                        switch ($b=array_shift($request)) {
                            case '': handle_board($method);break;
                            case null: exit;break;
                            case 'piece': handle_piece($method, $request[0],$request[1],$input); break;
                            //case 'players': handle_players($method, $request[0],$input); break; 
                            default: header("HTTP/1.1 404 Not Found"); break;
                        }
        case 'game_status' : 
                        switch ($b=array_shift($request)) {
                        case '': exit; break;
                        default: header("HTTP/1.1 404 Not Found"); break;
                    }

        case 'players' :  handle_players($method, $request,$input) ; 
                break;
            
        case 'dice' : rollthedice();
                break; 
        case 'login' : 
                        switch ($b=array_shift($request)) {
                           case '': show_logged();
                           case 'B':
                            handle_login($method, $b, $input);
                            break;
                        case 'Y':
                            handle_login($method, $b, $input);
                            break;
                        case 'R':
                            handle_login($method, $b, $input);
                            break;
                        case 'G':
                            handle_login($method, $b, $input);
                            break;

        
        }
                break;
        default: header("HTTP/1.1 404 Not Found"); 
        exit;}
        
        
        

        function rollthedice(){
            $dice = mt_rand(1,6);
            
            if($dice>1)
            shownextf($dice);
        }

        function shownextf($d){
            echo intval($d);
            echo 'inside shownextf';
        }
       

        function handle_board($method){
            
            if($method == 'GET'){
                try{show_board();
                    echo 'im inside show_board';}
                catch(Exception $e){
                    echo 'Problem here ' .$e->getMessage();

                }
                
            }
            else if($method == 'POST'){
                try{reset_board();
                    show_board();
                    echo 'im inside reset';}
                catch(Exception $e){
                    echo 'Problem here ' .$e->getMessage();

                }
            }
            else{
                header('HTTP/1.1 405 Method Not Allowed');
            }

        }


        function handle_players($method, $p, $input){
            echo "im inside handle players";
                    switch($b=array_shift($p)) {
                        case '' : show_board_players();
                            break;
                        case 'B':
                            handle_users($method, $b, $input);
                            break;
                        case 'Y':
                            handle_users($method, $b, $input);
                            break;
                        case 'R':
                            handle_users($method, $b, $input);
                            break;
                        case 'G':
                            handle_users($method, $b, $input);
                            break;
                        default: header("HTTP/1.1 404 Not Found"); 
                        exit;
        
        
                        }
                    
        
                }

        
        
?>