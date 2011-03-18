<?php

if (sfConfig::get('app_sf_guard_member_plugin_routes_register', true)) {
  
  $rcon = sfRouting::getInstance();
  $config = sfYaml::load(dirname(__FILE__) .'/plugin_routing.yml');
  $enabled_modules = sfConfig::get('sf_enabled_modules', array());
  
  foreach ($config['mapping'] as $module_name => $route_names) {
    if (in_array($module_name, $enabled_modules)) {
      $mapped_routes = _fetch_mapped_route_settings($route_names, $config['routes']);
      
      foreach ($mapped_routes as $name => $route) {
        $rcon->prependRoute($name, $route['url'], $route['param']);
      }
    }
  }
}


function _fetch_mapped_route_settings($names, $settings)
{
  $fetched = array();
  foreach($names as $name) {
    if (preg_match('/^(.+)\*$/', $name)) {
      // seems to be regex pattern
      foreach ($settings as $route_name => $route) {
        if (preg_match("/^{$name}/", $route_name)) {
          $fetched[$route_name] = $route;
        }
      }
    }
    else {
      // seems to be specified name
      if (in_array($name, $settings)) {
        $fetched[$name] = $settings[$name];
      }
    }
  }
  return $fetched;
}
