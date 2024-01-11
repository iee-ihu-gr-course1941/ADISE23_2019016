<?php


        function handle_users($method, $b, $input){
            if($method == 'GET'){
                show_user($b);
            }
            else if($method =='POST'){
                //set_user($b,$input);
                handle_login($method, $b,$input);
            }
        }

        function show_user($b){
	        global $mysqli;
	        $sql = 'select username,piece_color,spawn_pieces from players where piece_color=?';
	        $st = $mysqli->prepare($sql);
	        $st->bind_param('s',$b);
	        $st->execute();
	        $res = $st->get_result();
	        header('Content-type: application/json');
	        print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
        }
/*
        function set_user($b,$input) {
            //print_r($input);
            if(!isset($input['username']) || $input['username']=='') {
                header("HTTP/1.1 400 Bad Request");
                print json_encode(['errormesg'=>"No username given."]);
                exit;
            }
            $username=$input['username'];
            global $mysqli;
            $sql = 'select count(*) as c from players where piece_color=? and username is not null';
            $st = $mysqli->prepare($sql);
            $st->bind_param('s',$b);
            $st->execute();
            $res = $st->get_result();
            $r = $res->fetch_all(MYSQLI_ASSOC);
            if($r[0]['c']>0) {
                header("HTTP/1.1 400 Bad Request");
                print json_encode(['errormesg'=>"Player $b is already set. Please select another color."]);
                exit;
            }
            $sql = 'update players set username=?, token=md5(CONCAT( ?, NOW()))  where piece_color=?';
            $st2 = $mysqli->prepare($sql);
            $st2->bind_param('sss',$username,$username,$b);
            $st2->execute();
        
        
            
            //update_game_status();
            $sql = 'select * from players where piece_color=?';
            $st = $mysqli->prepare($sql);
            $st->bind_param('s',$b);
            $st->execute();
            $res = $st->get_result();
            header('Content-type: application/json');
            print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
            
            
        }*/



        



        function show_logged(){
            
            global $mysqli;
	        $sql = 'select * from players where token is not null';
	        $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            header('Content-type: application/json');
            print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
            

        }

        function show_logged_info($b){
            
            global $mysqli;
	        $sql = 'select * from players where piece_color=?';
	        $st = $mysqli->prepare($sql);
	        $st->bind_param('s',$b);
	        $st->execute();
	        $res = $st->get_result();
	        header('Content-type: application/json');
	        print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
            

        }

        
        
        function handle_login($method, $b,$input){
                $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $parts = explode('/', $url_path);
                $username = end($parts);
                
                if ($username === null || $username === '') {
                    header("HTTP/1.1 400 Bad Request");
                    print json_encode(['errormesg' => "No username given."]);
                    exit;
                }
                
                if($method=='GET'){
                    show_logged_info($b);
                }
                else if($method=='POST'){
                    global $mysqli;
	                $sql = 'select username from players where piece_color=? and token is not null';
	                $st = $mysqli->prepare($sql);
	                $st->bind_param('s',$b);
	                $st->execute();
	                $res = $st->get_result();
                    
	                $sql1 = 'select count(username) as loggedin from players where token is not null';
	                $st1 = $mysqli->prepare($sql1);
	                $st1->execute();
	                $result1 = $st1->get_result();
                    $row1 = $result1->fetch_assoc();
                    $loggedinCount = $row1['loggedin'];
                    if($loggedinCount == 0){
                        $sql = 'call clean_board()';
                        $mysqli -> query($sql);
                        //show_board();
                    }
                    if($loggedinCount < 2){
                    if ($res->num_rows > 0) {
                        header("HTTP/1.1 400 Bad Request");
                        print json_encode(['errormesg'=>"Player $b is already set. Please select another color."]);
                        exit;
                    }else{
                    $sql = 'update players set username=?, token=md5(CONCAT( ?, NOW()))  where piece_color=?';
                    $st2 = $mysqli->prepare($sql);
                    $st2->bind_param('sss',$username,$username,$b);
                    $st2->execute();
                    update_game_status();
                    $sql = 'select * from players where piece_color=?';
                    $st = $mysqli->prepare($sql);
                    $st->bind_param('s',$b);
                    $st->execute();
                    $res = $st->get_result();
                    header('Content-type: application/json');
                    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);}
                }else{
                    print json_encode(['errormesg'=>"Players logged 2. No more can play"]);
                }
            
                }
        }

        function checkstatus(){
            global $mysqli;
            $sql = 'select * from game_status';
            $st = $mysqli->prepare($sql);
            $new_status=null;
            $new_turn=null;
            $st->execute();
            $res = $st->get_result();
            $status = $res->fetch_assoc();
            $sql2 = 'select p_turn from game_status';
            $st = $mysqli->prepare($sql2);
            $new_status=null;
            $new_turn=null;
            $st->execute();
            $res = $st->get_result();
            $player = $res->fetch_assoc()['p_turn'];
            if($status['status']=='not active') {
                echo 'Not started yet';
            }
            if($status['status']=='started') {
                echo "waiting for player $player to move";
            }



            /*
            $st3=$mysqli->prepare('select count(*) as aborted from players WHERE last_action< (NOW() - INTERVAL 5 MINUTE)');
            $st3->execute();
            $res3 = $st3->get_result();
            $aborted = $res3->fetch_assoc()['aborted'];
            if($aborted>0) {
                $sql = "UPDATE players SET username=NULL, token=NULL WHERE last_action< (NOW() - INTERVAL 5 MINUTE)";
                $st2 = $mysqli->prepare($sql);
                $st2->execute();
                if($status['status']=='started') {
                    $new_status='aborted';
                }
            }*/

        }
        
        function checkaborted(){
        global $mysqli;
        $sql = 'select * from game_status';
        $st = $mysqli->prepare($sql);
        $new_status=null;
        $new_turn=null;
        $st->execute();
        $res = $st->get_result();
        $status = $res->fetch_assoc();
        $st3=$mysqli->prepare('select count(*) as aborted from players WHERE last_action< (NOW() - INTERVAL 5 MINUTE)');
        $st3->execute();
        $res3 = $st3->get_result();
        $aborted = $res3->fetch_assoc()['aborted'];
        if($aborted>0) {
           
            $sql = "UPDATE players SET username=NULL, token=NULL,last_action=NULL WHERE last_action< (NOW() - INTERVAL 5 MINUTE)";
            $st2 = $mysqli->prepare($sql);
            $st2->execute();
            $sql4='select piece_color from players where token is not null';
            $st5=$mysqli->prepare($sql4);
            $st5->execute();
            $res = $st5->get_result();
            $winner = $res->fetch_assoc()['piece_color'];
            $sql2 = "UPDATE game_status SET status='aborted', p_turn=NULL, result='$winner', last_change=NULL";

            $st4 = $mysqli->prepare($sql2);
            $st4->execute();
            
        }
    }


        function show_status() {
	
            global $mysqli;
            $sql = 'select * from game_status';
            $st = $mysqli->prepare($sql);
        
            $st->execute();
            $res = $st->get_result();
        
            header('Content-type: application/json');
            print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
        
        }
        
        
        
        function update_game_status() {
            global $mysqli;
            
            $sql = 'select * from game_status';
            $st = $mysqli->prepare($sql);
        
            $st->execute();
            $res = $st->get_result();
            $status = $res->fetch_assoc();
            
            
            $new_status=null;
            $new_turn=null;
            
            $st3=$mysqli->prepare('select count(*) as aborted from players WHERE last_action< (NOW() - INTERVAL 5 MINUTE)');
            $st3->execute();
            $res3 = $st3->get_result();
            $aborted = $res3->fetch_assoc()['aborted'];
            if($aborted>0) {
                $sql = "UPDATE players SET username=NULL, token=NULL WHERE last_action< (NOW() - INTERVAL 5 MINUTE)";
                $st2 = $mysqli->prepare($sql);
                $st2->execute();
                if($status['status']=='started') {
                    $new_status='aborted';
                }
            }
        
            
            $sql = 'select count(*) as c from players where username is not null';
            $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            $active_players = $res->fetch_assoc()['c'];

            $sql1 = 'SELECT piece_color FROM players  WHERE token IS NOT null ORDER BY RAND() LIMIT 1';
            $st1 = $mysqli->prepare($sql1);
            $st1->execute();
            $rescolor = $st1->get_result();
            $playerturn = $rescolor->fetch_assoc()['piece_color'];
            
            switch($active_players) {
                case 0: $new_status='not active'; break;
                case 1: $new_status='initialized';
                break;
                case 2: $new_status='started'; 
                        if($status['p_turn']==null) {
                            $new_turn=$playerturn;
                        }
                        break;
            }
        
            $sql = 'update game_status set status=?, p_turn=?,result="D",last_change=NOW()';
            $st = $mysqli->prepare($sql);
            $st->bind_param('ss',$new_status,$new_turn);
            $st->execute();
            
            
            
        }

        
    
?>