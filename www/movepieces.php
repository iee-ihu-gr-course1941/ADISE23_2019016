<?php



        function rollthedice(){
            $dice = mt_rand(1,6);
            echo($dice);
            if($dice==6){
                echo 'Move piece or insert one piece from the spawn';
                //move_piece();
                //set_status($b);
            }
           //global $mysqli;
            
        }
        ///function gia na allazei h na afhnei ton paikti na paiksei rollthedice
        function set_status($b){
            global $mysqli;
            $sql1 = "select piece_color from players where username='$b'";
            $st1 = $mysqli->prepare($sql1);
            $st1->execute();
            $res1 = $st1->get_result();
            $piece_color = $res1->fetch_assoc()['piece_color'];
            $sql = "UPDATE game_status SET p_turn='$piece_color',last_action=NOW()";
            print json_encode(['errormesg'=>"$b is playing again"]);
        }

        function exist($r){
            $sql1 = "select token from players where username='$r'";
            $st1 = $mysqli->prepare($sql1);
            $st1->execute();
            $res1 = $st1->get_result();
            $token = $res1->fetch_assoc()['token'];
            if($username==$r){
                print json_encode(['errormesg'=>"Please $username is not a valid username. Please give a valid username"]);
            }else{
                echo "Player $username is a valid username";
            }
        }

        function do_move1($method){
            if($method='PUT'){
            
            $path = $_SERVER['REQUEST_URI'];

            
            $pathSegments = explode('/', $path);
            
            
            $username=  isset($pathSegments[5]) ? $pathSegments[5] : null;
            $piece = isset($pathSegments[6]) ? $pathSegments[6] : null;
            $oldposition = isset($pathSegments[7]) ? $pathSegments[7] : null;
            $newposition = isset($pathSegments[8]) ? $pathSegments[8] : null;
            if ($oldposition >= 1 && $oldposition <=40){
                if ($newposition >= 1 && $newposition <=40){
                    //echo "Username: $username, Piece: $piece, Oldposition: $oldposition, Newposition: $newposition";
                    checkturn($username);
                        if($piece=='B1' || $piece=='Y1' || $piece=='R1' || $piece=='G1'){
                            //echo 'im inside';
                            global $mysqli;
                            $sql='call move_piece1(?,?,?)';
                            $st = $mysqli->prepare($sql);
                            $st->bind_param('sss',$piece,$oldposition,$newposition);
                            $st->execute();
                        }else if($piece=='B2' || $piece=='Y2' || $piece=='R2' || $piece=='G2'){ 
                            global $mysqli;
                            $sql='call move_piece2(?,?,?)';
                            $st = $mysqli->prepare($sql);
                            $st->bind_param('sss',$piece,$oldposition,$newposition);
                            $st->execute();
                        }else if($piece=='B3' || $piece=='Y3' || $piece=='R3' || $piece=='G3'){
                            global $mysqli;
                            $sql='call move_piece3(?,?,?)';
                            $st = $mysqli->prepare($sql);
                            $st->bind_param('sss',$piece,$oldposition,$newposition);
                            $st->execute();
                        }else if($piece=='B4' || $piece=='Y4' || $piece=='R4' || $piece=='G4'){
                            global $mysqli;
                            $sql='call move_piece4(?,?,?)';
                            $st = $mysqli->prepare($sql);
                            $st->bind_param('sss',$piece,$oldposition,$newposition);
                            $st->execute();
                        }
                            
                else{
                    echo 'Give valid positions';
                }
            
        }
        }}}

        function do_move2($method){
            if($method='PUT'){
                
                $path = $_SERVER['REQUEST_URI'];
    
                
                $pathSegments = explode('/', $path);
                
                
                $username=  isset($pathSegments[5]) ? $pathSegments[5] : null;
                $piece = isset($pathSegments[6]) ? $pathSegments[6] : null;
                $oldposition = isset($pathSegments[7]) ? $pathSegments[7] : null;
                $newposition = isset($pathSegments[8]) ? $pathSegments[8] : null;
                if ($oldposition >= 1 && $oldposition <=40){
                    if ($newposition >= 1 && $newposition <=40){
                        //echo "Username: $username, Piece: $piece, Oldposition: $oldposition, Newposition: $newposition";
                        checkturn($username);
                            if($piece=='B1' || $piece=='Y1' || $piece=='R1' || $piece=='G1'){
                                echo 'im inside';
                                global $mysqli;
                                $sql='call move2_piece1(?,?,?)';
                                $st = $mysqli->prepare($sql);
                                $st->bind_param('sss',$piece,$oldposition,$newposition);
                                $st->execute();
                            }else if($piece=='B2' || $piece=='Y2' || $piece=='R2' || $piece=='G2'){ 
                                global $mysqli;
                                $sql='call move2_piece2(?,?,?)';
                                $st = $mysqli->prepare($sql);
                                $st->bind_param('sss',$piece,$oldposition,$newposition);
                                $st->execute();
                            }else if($piece=='B3' || $piece=='Y3' || $piece=='R3' || $piece=='G3'){
                                global $mysqli;
                                $sql='call move2_piece3(?,?,?)';
                                $st = $mysqli->prepare($sql);
                                $st->bind_param('sss',$piece,$oldposition,$newposition);
                                $st->execute();
                            }else if($piece=='B4' || $piece=='Y4' || $piece=='R4' || $piece=='G4'){
                                global $mysqli;
                                $sql='call move2_piece4(?,?,?)';
                                $st = $mysqli->prepare($sql);
                                $st->bind_param('sss',$piece,$oldposition,$newposition);
                                $st->execute();}
                
        }}}}
        





        //elegxos an epitrepetai na paiksei o paiktis otan paei na kanei kinisi move
        
        function checkturn($username){
            global $mysqli;
            $sql = 'select p_turn from game_status';
            $st = $mysqli->prepare($sql);
            $st->execute();
            $res = $st->get_result();
            $turn = $res->fetch_assoc()['p_turn'];
            $sql1 = "select piece_color from players where username=?";
            $st1 = $mysqli->prepare($sql1);
	        $st1->bind_param('s',$username);
            $st1->execute();
            $res1 = $st1->get_result();
            $p_color = $res1->fetch_assoc()['piece_color'];
            /*
            $sql2 = "select username from players where piece_color=? ";
            $st2 = $mysqli->prepare($sql2);
            $st2->bind_param('i', $p_color);
            $st2->execute();
            $res2 = $st2->get_result();
            $fetchuser = $res2->fetch_assoc();
            $user = $fetchuser['username'];*/
            if($turn !== $p_color){
                print json_encode(['errormesg'=>"Please let player who choose $turn color to play"]);
                exit;
            }else{
                echo "Its $username turn and can play";
                
            }
        }
?>