<?php

 //for local env testing
                    if(env('APP_ENV')=="local"){
                        $connexn_db_local =  mysqli_connect($dbhost, 'root', '');
                      
                      

                        $queries = array(
                            "CREATE DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci",
                            "CREATE USER '$dbuser'@'$dbhost' IDENTIFIED BY '$dbpsw'",
                            "GRANT USAGE ON * . * TO '$dbuser'@'$dbhost' IDENTIFIED BY '$dbpsw' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0",
                            "GRANT SELECT , INSERT , UPDATE, DELETE ON `$dbname` . * TO '$dbuser'@'$dbhost'",
                            "FLUSH PRIVILEGES"
                        );

                        foreach ($queries as $query) {
                            echo 'Executing query: "' . htmlentities($query) . '" ... ';
                            $rs = mysqli_query($connexn_db_local,$query);
                            echo ($rs ? 'OK' : 'FAIL') . '<br/><br/>';
                        }

                        $connexn_db_local->close();
                    }
