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
                        
                        show_status();
                        break;
                    

        case 'players' :  handle_players($method, $request,$input) ; 
                break; 
        case 'login' : 
                        switch ($b=array_shift($request)) {
                            case '': show_logged();
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
        //case 'Username': if($method = 'PUT'){

        //}
        
        }
                break;
        case 'check':
            checkstatus();

            break;
        case 'checkaborted':
            checkaborted();
            break;

        case $user1 :
            switch ($b=array_shift($request)){
            //move_piece($method,$b);
            case $b :echopiece($b);
            }
        default: header("HTTP/1.1 404 Not Found"); 
        exit;}

        function echopiece($b){
            echo 'move piece ';
            echo $b;
        }
        
            global $mysqli;
            $sql = 'select username from players where token is not null';
            $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            $user1 = $res->fetch_assoc()['username'];
        

        function rollthedice(){
            $dice = mt_rand(1,6);
            echo($dice);
            if($dice==6){
                echo 'Move piece or insert one piece from the spawn';
                checkmove();
            }
            global $mysqli;
            
        }
        function checkmove(){
            global $mysqli;
            $sql = 'select p_turn from game_status';
            $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            $turn = $res->fetch_assoc()['p_turn'];
        }

        function move_piece($method,$dice){
            $dice = mt_rand(1,6);
            $sql = 'select position from board where ';
            $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            $turn = $res->fetch_assoc()['p_turn'];
            if($method='POST'){
                //if()
                global $mysqli;
                $sql2 = "UPDATE board SET p1_piece1='B1' where position='6'";
                $st4 = $mysqli->prepare($sql2);
                $st4->execute();
            }
            
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