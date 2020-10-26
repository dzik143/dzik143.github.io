<?php

  echo "<html>";
    echo '<head>';
      echo '<title>Sylwester Wysocki - home page</title>';

      echo '<style>';
      include 'style.css';
      echo '</style>';

    echo '</head>';
    echo '<body>';

    // Html body.
    echo '<h1>Sylwester Wysocki - home page</h1>';

    //
    // Projects.
    //

    echo '<hr>';
    echo '<h2>Selected projects</h2>';

    // Load projects db.
    $arrayOfProjects = json_decode(file_get_contents('projects.json'), true);

    // Sort projects by year descending.
    usort($arrayOfProjects, function($a, $b) {
      return $a['year'] < $b['year'];
    });

    // Render projects beginning from the newest one.
    $lastYear = null;

    echo '<ol>';

    foreach ($arrayOfProjects as $project)
    {
      if ($lastYear !== $project['year'])
      {
        echo '<h3>', $project['year'], '</h3>';
        $lastYear = $project['year'];
      }

      $titleHtml = (empty($project['url']))
                 ? ('<b>'.$project['title'].'</b>')
                 : ('<a href="'.$project['url'].'">'.$project['title'].'</a>');

      $descHtml = $project['desc'];

      // Postprocess description.
      $descHtml = str_replace('NoMachine'    , '<a href="https://www.nomachine.com/">NoMachine S.à r.l</a>', $descHtml);
      $descHtml = str_replace('KEMU STUDIO'  , '<a href="https://www.linkedin.com/company/kemu-studio-limited/">KEMU STUDIO Ltd</a>', $descHtml);
      $descHtml = str_replace('node.js'      , '<a href="https://nodejs.org/en/">node.js</a>', $descHtml);
      $descHtml = str_replace('calculla.com' , '<a href="https://calculla.com">calculla.com</a>', $descHtml);
      $descHtml = str_replace('VIA D700'     , '<a href="https://www.viatech.com/en/products/systems/mobile360-d700-drive-recorder/">VIA D700</a>', $descHtml);

      $len = strlen($descHtml);

      if ($descHtml[$len - 1] !== '.')
      {
        $descHtml .= '.';
      }

      // Render project.
      echo '<li>', $titleHtml, ', ', $descHtml, '</li>';
    }

    echo '</ol>';

    //
    // Links.
    //

    echo '<hr>';
    echo '<h2>Links</h2>';
    echo '<ul>';
      echo '<li><a href="https://github.com/dzik143">github.com profile</a></li>';
      echo '<li><a href="https://www.linkedin.com/in/sylwester-wysocki-57b54558/">linkedin profile</a></li>';
    echo '</ul>';

    // Common html foot.
    echo '</body>';
  echo '</html>';
