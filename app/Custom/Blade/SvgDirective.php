<?php

namespace App\Custom\Blade;

class SvgDirective
{
  public static function add()
  {
    \Blade::directive('svg', function($arguments) {
      // Funky madness to accept multiple arguments into the directive
      list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
      $path = trim($path, "' ");
      $class = trim($class, "' ");
      
      if($path[0] == '$')
      {
          return "<?php
              \$svg = new \DOMDocument();
              \$svg->load(resource_path($path.'.svg'));
              \$svg->documentElement->setAttribute('class', '$class');
              \$output = \$svg->saveXML(\$svg->documentElement);
              echo \$output;
          ?>";
      }

      // Create the dom document as per the other answers
      $svg = new \DOMDocument();
      $svg->load(resource_path($path.'.svg'));
      $svg->documentElement->setAttribute("class", $class);
      $output = $svg->saveXML($svg->documentElement);

      return $output;
    });
  }
}