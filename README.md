# ADISE23_2019016

# Κανόνες παιχνιδιού
Ο Γκρινιάρης είναι κλασικό επιτραπέζιο παιχνίδι στο οποίο συμμετέχουν 2 έως 4 παίκτες. Στην αρχή του παιχνιδιού ο κάθε παίκτης παίρνει 4 φιγούρες του ίδιου χρώματος απ' τις οποίες τις 3 τις τοποθετεί στη βάση του η οποία έχει το ίδιο χρώμα μ' αυτές και την 4η την τοποθετεί στην Αφετηρία. Στη συνέχεια ο κάθε παίκτης ρίχνει το ζάρι κι εκείνος ο οποίος φέρνει το μεγαλύτερο αριθμό ξεκινάει πρώτος. Ο κάθε παίκτης όταν έρχεται η σειρά του, ρίχνει το ζάρι και μετακινεί τη φιγούρα του τόσα τετραγωνάκια όσα δείχει ο αριθμός τον οποίο έφερε στο ζάρι. Ο παίκτης ο οποίος φέρνει εξάρα παίζει 2 φορές συνεχόμενες. Επίσης μπορεί αν θέλει να βγάλει μια νέα φιγούρα στο παιχνίδι, αλλά αυτό το αποφασίζει μόνο ο ίδιος ο παίκτης. Κάθε παίκτης αφού κάνει όλο το γύρο του πίνακα πάνω στα λευκά τετραγωνάκια, επιστρέφει στην Αφετηρία του και τοποθετεί τις φιγούρες του στα εσωτερικά τετραγωνάκια ασφαλείας του χρώματός του τα οποία είναι σημειωμένα με τα κεφαλαία Αγγλικά γράμματα A B C D. Εάν τώρα ένας παίκτης ρίξει το ζάρι και η κίνησή του αυτή καταλήξει σε τετραγωνάκι στο οποίο βρίσκεται φιγούρα άλλου παίκτη, αυτός υποχρεώνεται να την πάρει απο εκεί και να την ξανατοποθετήσει πίσω στη βάση του απ' όπου θα ξαναβγεί μόνον όταν ο κάτοχός της φέρει εξάρα. Και το πρώτο κουτάκι χρώματος που πέφτει ο παίκτης είναι επίσης ασφαλές για όλα τα πιόνια
###### Πηγή: https://el.wikipedia.org/wiki/%CE%93%CE%BA%CF%81%CE%B9%CE%BD%CE%B9%CE%AC%CF%81%CE%B7%CF%82


# Περιγραφή βάσης

##### Πίνακας Board
| Στήλες        | Περιγραφή      | Περιεχόμενο |
| :---          |     :---:      |          :--- |
| position      | Η θέση που παίρνει το πιόνι στον πίνακα    | Ακέραιος αριθμός. Τιμές που παίρνει 1-44    |
| p1_piece1     | Πιόνι 1 παίκτη 1       | B1,Y1,R1,G1      |
| p1_piece2     | Πιόνι 1 παίκτη 1       | B2,Y2,R2,G2      |
| p1_piece3     | Πιόνι 1 παίκτη 1       | B3,Y3,R3,G3      |
| p1_piece4     | Πιόνι 1 παίκτη 1       | B4,Y4,R4,G4      |
| p2_piece1     | Πιόνι 1 παίκτη 2       | B1,Y1,R1,G1     |
| p2_piece2     | Πιόνι 2 παίκτη 2       | B2,Y2,R2,G2     |
| p2_piece3     | Πιόνι 3 παίκτη 2       | B3,Y3,R3,G3      |
| p2_piece4     | Πιόνι 4 παίκτη 2       | B4,Y4,R4,G4     |

##### Πίνακας game_status

| Στήλες       | Περιγραφή      | Περιεχόμενο |
| :---         |     :---:      |          :--- |
| Status       | Κατάσταση παιχνιδιού     | 'not active','initializaed','started','ended'    |
| p_turn       | Ποιός παίκτης παίζει με βάση το χρώμα του πιονιού      | 'B','R','G','Y'     |
| result       | Αποτέλεσμα παιχνιδιού      | 'B','R','G','Y','D'     |
| last_change  | Η στιγμή που έγινε η τελευταία κίνηση που έγινε στη βάση( loogin, κίνηση πιονιού κλπ)      | Timestamp της τελευταίας κίνηση    |


##### Πίνακας players

| Στήλες       | Περιγραφή      | Περιεχόμενο |
| :---         |     :---:      |          :--- |
| username      | Όνομα χρήστη     | Ο,τιδήποτε δώσει ο χρήστης    |
| piece_color       | Το χρώμα του πιονιού που έχει επιλέξει ο χρήστης    | 'B','R','G','Y'     |
| spawn_pieces       | Αριθμός πιονιών που δεν έχουν μπεί ακόμα στο επιτραπέζιο      | Ακέραιος αριθμός. Αρχική τιμή 4    |
| token  | Ένας μοναδικός κωδικός για τον παίκτη που συνδέεται      | Timestamp της τελευταίας κίνηση    |
| last_change  | Η στιγμή που έγινε η τελευταία κίνηση στο παιχνίδι      | Timestamp της τελευταίας κίνηση    |

# Περιγραφή API
### GET
| Μέθοδος      | URL      | Περιγραφή |
| :---         |     :---:      |          :--- |
| GET       | ludo.php/board      | Επιστρέφει το περιεχόμενο του πίνακα board |
| GET       | ludo.php/players      | Επιστρέφει το περιεχόμενο του πίνακα players χωρις το token |
| GET       | ludo.php/players      | Επιστρέφει το περιεχόμενο του πίνακα players χωρις το token |
| GET       | ludo.php/login     | Επιστρέφει τους παικτες που εχουν συνδεθεί |
| GET       | ludo.php/login/{B,Y,R,G}     | Επιστρέφει τον παίκτη που έχει επιλέξει ένα απο τα χρώματα B,Y,R,G  |
| GET       | ludo.php/game_status     | Επιστρέφει την κατάσταση του παιχνιδιού, δηλαδη το περιεχόμενο του πίνακα game_status  |
| GET       | ludo.php/check    | Επιστρέφει το χρώμα του παίκτη που παίζει  |
| GET       | ludo.php/checkaborted    | Ελέγχει αν κάποιος παίκτης έχει να κάνει κίνηση σε διάστημα μεγαλύτερου των 5 λεπτών.  |

### POST
| Μέθοδος      | URL      | Περιγραφή |
| :---         |     :---:      |          :--- |
| POST       | ludo.php/login/{B,Y,R,G}/{username}      | Ο χρήστης επιλέγει το χρώμα και το όνομα που θέλει να έχει στο παιχνίδι και αποθηκεύεται στη βάση |
| POST     | ludo.php/board      | Αρχικοποιεί τη βάση |

### PUT
| Μέθοδος      | URL      | Περιγραφή |
| :---         |     :---:      |          :--- |
| PUT     | ludo.php/movepiece/{Player1,Player2}/{piece}/{oldpostion}/{newposition}      | Ο παίκτης επιλέγει ποιο πιόνι θέλει να κουνήσει, απο ποιά θέση και σε ποια θέση θέλει να μετακινήσει το πιόνι |
