<?php
    if(isset($_SESSION['user']))
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            if(isset($_GET['playlistID'])){
                $playlistID = $_GET['playlistID'];
                $userID = $_SESSION['user']['id'];

                $sqlShowDataPlaylist = "SELECT playlists.*,users.userName 
                    from playlists 
                    inner join users on users.id = playlists.userID 
                    where playlists.id = $playlistID and playlists.userID = $userID
                ";

                $stmShowDataPlaylist = $connect -> prepare($sqlShowDataPlaylist);

                $stmShowDataPlaylist -> execute();

                $resultShowDataPlaylist = $stmShowDataPlaylist -> fetch(PDO::FETCH_ASSOC);

                // echo '<pre>';
                // print_r($resultShowDataPlaylist);
                // echo '<pre>';
            }
        }
    }
?>