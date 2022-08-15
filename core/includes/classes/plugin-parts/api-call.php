<?php
function get_countries_data(){
  $api = wp_remote_get('https://restcountries.com/v3.1/all');
  $api_body = json_decode(wp_remote_retrieve_body( $api ));
  $transient = set_transient( 'api_results', $api_body, DAY_IN_SECONDS );
  $countries_data = [];
  if($transient){
    foreach(get_transient( 'api_results' ) as $key => $item){
      $countries_data[$key]['country'] = $item->name->common;
      $countries_data[$key]['code'] = $item->idd->root.$item->idd->suffixes[0];
    }
  }else{
    $transient = set_transient( 'api_results', $api_body, DAY_IN_SECONDS );
    foreach(get_transient( 'api_results' ) as $key => $item){
      $countries_data[$key]['country'] = $item->name->common;
      $countries_data[$key]['code'] = $item->idd->root.$item->idd->suffixes[0];
    }
  }
  return $countries_data;
}