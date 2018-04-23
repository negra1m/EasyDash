<?php
function dbUpdate($sql, $cond) {
    // seting the database parameters...
    $servername = "10.155.130.229";
    $username = "easy";
    $password = "easy";
    $dbname = "EASY_HISTORIC";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if($conn->connect_error) {
        logUpdate($dbLogFile, die("Connection failed: " . $conn->connect_error));
    }
    if($cond == 1){ // condição 1 tem como objetivo retornar um array com os resultados, usado para o gráfico de barras.
    // execute query
        $run = mysqli_query($conn, $sql);
        if (!$run) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
}
        $return = mysqli_fetch_array($run, MYSQLI_ASSOC);
        return $return;

    // close connection
    $conn->close();

}
    else if($cond == 2){ //condição 2 conta o número de linhas retornados pela query, usado para mostrar o atual nos charts de tipo PIE/BAR.
         $run = mysqli_query($conn, $sql);
        if (!$run) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
}
        $return = mysqli_num_rows($run);
        return $return;

    //close connection 
    $conn->close();
    }
    else if($cond == 3){ //condição .
    $conn->set_charset("utf8");
    $run = mysqli_query($conn, $sql);
    if (!$run) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $rows = array();
    while($r = mysqli_fetch_assoc($run)) {
        $rows[] = $r;
    }
    return $rows;

    //close connection 
    $conn->close();
}
}
?>