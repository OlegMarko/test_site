<?php

    function db_connect() {
        /* Підключення до бази даних */
        
        // Настройки бази даних
        $host = "localhost";
        $user = "root";
        $pswd = "";
        $db = "test";
        
        $connection = new mysqli($host, $user, $pswd, $db);
        $connection->query(" SET NAMES 'utf8' ");
        
        if (!$connection || !mysqli_select_db($connection, $db)) {
            return FALSE;
        }
        return $connection;
    }
    
    function db_result_to_array($result) {
        /* Повернення вибірки з БД у вигляді масиву */
        
        $res_array = array();
        $count = 0;
        
        while ($row = mysqli_fetch_array($result)) {
            $res_array[$count] = $row;
            $count++;
        }
        
        return $res_array;
    }
    
    function add_distance($data) {
        /* Додавання до бази даних нового маршруту */
        
        $connection = db_connect();
        
        $query = " INSERT INTO dump (name, input, output, time, distance, price, transit) VALUES ($data) ";
        $query = mysqli_query($connection, $query);        
    }

    function select($select, $input, $output) {
        /* Вибірка з бази даних маршруту */
        
        $connection = db_connect();
        
        $query = " SELECT $select FROM dump WHERE `input` = $input AND `output` = $output ";
        $query = mysqli_query($connection, $query);
        
        $result = db_result_to_array($query);
        return $result;
    }
    
    function get_info_rout($where) {
        /* інформація про маршрут */
        
        $connection = db_connect();
        
        $query = " SELECT * FROM dump WHERE $where ";
        $query = mysqli_query($connection, $query);
        
        $result = db_result_to_array($query);
        return $result;
    }


    if (isset($_POST['add'])) {
        if (!empty($_POST['name']) && !empty($_POST['input']) && !empty($_POST['output']) && !empty($_POST['time']) && !empty($_POST['distance']) && !empty($_POST['price'])) {
            if ($_POST['input'] != $_POST['output']) {
                $data['name'] = "'" . $_POST['name'] . "'";
                $data['input'] = "'" . $_POST['input'] . "'";
                $data['output'] = "'" . $_POST['output'] . "'";
                $data['time'] = "'" . $_POST['time'] . "'";
                $data['distance'] = "'" . $_POST['distance'] . "'";
                $data['price'] = "'" . $_POST['price'] . "'";
                $data['p'] = "'" . $_POST['p'] . "'";
                $data = implode(',', $data);

                add_distance($data);
                header('Location: index.html');
            } else {
                header('Location: index.html');
                $info = "Початок та кінець маршруту не можуть бути в однім пункті";
            }
        } else {
            header('Location: index.html');
            $info = "Не всі поля заповнені!!!";
        }
    }
    
    if (isset($_POST['search'])) {
        if ($_POST['input'] != $_POST['output']) {
            $input = "'" . $_POST['input'] . "'";
            $output = "'" . $_POST['output'] . "'";
            $select = $_POST['select'];

            $result = select("*", $input, $output);
            if (isset($result)) {
                $res = array();
                $i = 0;
                
                //var_dump($result);
                
                foreach ($result as $item) {
                    $time[$i] = $item['time'];
                    $transit[$i] = $item['transit'];
                    $input[$i] = $item['input'];
                    $output[$i] = $item['output'];
                    $distance[$i] = $item['distance'];
                    $price[$i] = $item['price'];
                    $i++;
                }
                
                //var_dump($time);
                
                switch ($select) {
                    case "time":
                        if (count($time) != 1) {
                            for ($i = 1; $i < count($time); $i++) {
                                if ($time[$i-1] < $time[$i]) {
                                    $time[0] = $time[$i-1];
                                    $transit[0] = $transit[$i-1];
                                    $input[0] = $input[$i-1];
                                    $output[0] = $output[$i-1];
                                    $distance[0] = $distance[$i-1];
                                    $price[0] = $price[$i-1];
                                } else {
                                    $time[0] = $time[$i];
                                    $transit[0] = $transit[$i];
                                    $input[0] = $input[$i];
                                    $output[0] = $output[$i];
                                    $distance[0] = $distance[$i];
                                    $price[0] = $price[$i];
                                }
                            }
                        }
                    break;
                    
                    case "price":
                        if (count($time) != 1) {
                            for ($i = 1; $i < count($price); $i++) {
                                if ($price[$i-1] < $price[$i]) {
                                    $time[0] = $time[$i-1];
                                    $transit[0] = $transit[$i-1];
                                    $input[0] = $input[$i-1];
                                    $output[0] = $output[$i-1];
                                    $distance[0] = $distance[$i-1];
                                    $price[0] = $price[$i-1];
                                } else {
                                    $time[0] = $time[$i];
                                    $transit[0] = $transit[$i];
                                    $input[0] = $input[$i];
                                    $output[0] = $output[$i];
                                    $distance[0] = $distance[$i];
                                    $price[0] = $price[$i];
                                }
                            }
                        }
                    break;
                    
                    case "distance":
                        if (count($time) != 1) {
                            for ($i = 1; $i < count($distance); $i++) {
                                if ($distance[$i-1] < $distance[$i]) {
                                    $time[0] = $time[$i-1];
                                    $transit[0] = $transit[$i-1];
                                    $input[0] = $input[$i-1];
                                    $output[0] = $output[$i-1];
                                    $distance[0] = $distance[$i-1];
                                    $price[0] = $price[$i-1];
                                } else {
                                    $time[0] = $time[$i];
                                    $transit[0] = $transit[$i];
                                    $input[0] = $input[$i];
                                    $output[0] = $output[$i];
                                    $distance[0] = $distance[$i];
                                    $price[0] = $price[$i];
                                }
                            }
                        }
                    break;
                }
                
                

                echo '<!DOCTYPE html>';
                echo '<html>';
                echo '<head>';
                    echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
                    echo '<link rel="stylesheet" href="style.css" type="text/css" />';
                echo '</head>';
                echo '<body>';
                    echo '<div class="res">';
                        echo "Час маршруту->  ".$time[0]."хв";
                        echo '<br />';
                        echo "Відстань маршруту->  ".$distance[0]."км";
                        echo '<br />';
                        echo "Ціна маршруту->  ".$price[0]."грн";
                        echo '<br />';
                        if (!empty($transit[0])) {
                            echo "Маршрути з пересадками->  ".$transit[0];
                        } else {
                            echo "Прямий маршрут->  ".$input[0].$output[0];
                        }
                        echo '<br />';
                        echo '<br />';
                        echo '<a href="index.html">На головну--></a>';
                    echo '</div>';
                echo '</body>';
                echo '</html>';
            }
        } else {
            header('Location: index.html');
            $info = ",,,";
        }
    }
?>