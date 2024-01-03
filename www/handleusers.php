<?php


        function handle_users($method, $b, $input){
            if($method == 'GET'){
                show_user($b);
            }
            else if($method =='PUT'){
                set_user($b,$input);
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

        
        function handle_login($method, $b, $input){
            
                if($method=='GET'){
                    show_logged_info($b);
                }
                else if($method=='PUT'){
                    global $mysqli;
	                $sql = 'select token from players where piece_color=?';
	                $st = $mysqli->prepare($sql);
	                $st->bind_param('s',$b);
	                $st->execute();
	                $res = $st->get_result();
	                
                    if ($res->num_rows > 0) {
                        echo 'choose other';
                    } else {
                        echo 'You can choose this piece';
                    
}
                    
                }
            
        }

    
?>