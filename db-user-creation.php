<?php

 //for local env testing
 $app_environment = env('APP_ENV');
                    if($app_environment=="local"){
                    
                        //echo '$app_environment'. $app_environment;
                        if($app_environment == "local"){
                            DB::statement("CREATE DATABASE `$dbname`");
                            DB::statement("CREATE USER '$dbuser'@'localhost' IDENTIFIED BY '$dbpsw' ");
                            DB::statement("GRANT ALL PRIVILEGES ON *.* TO '$dbuser'@'localhost'");
                            DB::statement("FLUSH PRIVILEGES");
                            
                        }
                                           
                      

                        $conn = mysqli_connect($dbhost, $dbuser, $dbpsw, $dbname);
                            $query = '';
                            $sqlScript = file(base_path() . '/dms/fileeazy_dms.sql');
                            foreach ($sqlScript as $line) {

                                $startWith = substr(trim($line), 0, 2);
                                $endWith = substr(trim($line), -1, 1);

                                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                                    continue;
                                }

                                $query = $query . $line;
                                if ($endWith == ';') {
                                    mysqli_query($conn, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
                                    $query = '';
                                }
                            }
                            echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
                    }
