<?php

/* ****************************************************************** */
//
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool that stablish and communicate with Danfoss 
//  equipaments (AK-SC255 / AK-SC355 / AK-SM88x), 
//  using the controller web server API 
//  (See XML_Interface 1_0 (Deprecated) - Danfoss Manual).
//
//  Author: F
//
//  Company: GreenYellow do Brasil.
//
/* ****************************************************************** */

/* ****************************************************************** */
//
//  data base connection and query execution
//
/* ****************************************************************** */

function dbUpdate($sql) {

    // seting the database parameters...
    $servername = "10.155.131.16";
    $username = "easy";
    $password = "easy";
    $dbname = "EASY_HISTORIC";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if($conn->connect_error) {
        logUpdate($dbLogFile, die("Connection failed: " . $conn->connect_error));
    }

    // cxecute query
        $run = mysqli_query($conn, $sql);
        if (!$run) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
}
        $return = mysqli_fetch_array($run, MYSQLI_ASSOC);
        return $return;
        //logUpdate($dbLogFile, "Record updated successfully: " . $sql);

    // close connection
    $conn->close();

}

/* ****************************************************************** */

?>