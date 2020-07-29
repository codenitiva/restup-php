<?php

function insert_query_builder($table_name, $array_keys) {

  $query_columns = "INSERT INTO " . $table_name . " (";
  $query_values = "VALUES (";

  $end = end($array_keys);

  foreach ($array_keys as $key) {
    if ($key != $end) {
      $query_columns .= $key . ", ";
      $query_values .= "?,";
    }
    else {
      $query_columns .= $key . ") ";
      $query_values .= "?)";
    }
  }

  $query = $query_columns . $query_values;
  return $query;
}

function update_query_builder($table_name, $array_keys) {
  
  $query = "UPDATE " . $table_name . " SET ";
  $first = $array_keys[0];

  foreach ($array_keys as $key) {
    if ($key != 'id') {
      if ($key != $first) 
        $query .= ", " . $key . "=?";
      else 
        $query .= $key . "=?";
    }
  }

  $query .= " WHERE id=?";

  return $query;
}