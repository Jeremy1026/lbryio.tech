<?php echo View::render('nav/_header', ['isDark' => false, 'isBordered' => false]) ?>
<main class="courses courses_copy">

  <div class="main-head cover content-light">
      <h1 class="text-center">Courses</h2>
      <p>Select a course from below to start learning how to develop for LBRY. Each course will take you through different steps to accomplish a new goal to better your understanding of working with the LBRY API.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper vulputate mauris, ut lobortis risus laoreet sit amet. Maecenas vel imperdiet dui, in viverra est. Proin metus mauris, venenatis quis congue eu, scelerisque at mauris. Etiam bibendum facilisis tortor, quis rhoncus orci accumsan quis. Maecenas et blandit arcu. Nunc quis metus ultricies, luctus enim ac, lobortis neque. Aliquam dictum vitae felis quis suscipit. Nunc tristique ligula nec ullamcorper maximus. Duis fermentum nulla pellentesque mi aliquet varius. Etiam urna lacus, venenatis sed leo ac, dignissim euismod dui. Pellentesque lorem massa, vestibulum at varius a, maximus ac magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed et convallis est. Fusce in magna laoreet justo scelerisque aliquam eu eget velit.</p>
  </div>

  <div class="column cover-dark cover-dark-grad spacer1">
    <?php foreach ($courseShortNames as $course) : ?>
      <?php echo View::render('content/_courses',  ['course' => $course]) ?>
    <?php endforeach; ?>
  </div>

  <div class="suggestions cover content-light">
      <h2 class="text-center">Suggestions</h2>
      <p>If you have any suggestions for courses or lessons, please add an issue on <a href="https://github.com/lbryio/lbry.tech/issues">GitHub</a>.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper vulputate mauris, ut lobortis risus laoreet sit amet. Maecenas vel imperdiet dui, in viverra est. Proin metus mauris, venenatis quis congue eu, scelerisque at mauris. Etiam bibendum facilisis tortor, quis rhoncus orci accumsan quis. Maecenas et blandit arcu. Nunc quis metus ultricies, luctus enim ac, lobortis neque. Aliquam dictum vitae felis quis suscipit. Nunc tristique ligula nec ullamcorper maximus. Duis fermentum nulla pellentesque mi aliquet varius. Etiam urna lacus, venenatis sed leo ac, dignissim euismod dui. Pellentesque lorem massa, vestibulum at varius a, maximus ac magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed et convallis est. Fusce in magna laoreet justo scelerisque aliquam eu eget velit.</p>
      <p>Nulla urna quam, volutpat at bibendum nec, blandit sed arcu. Fusce rhoncus urna non mi dignissim pellentesque. Proin ac pretium nulla, id cursus ligula. Duis finibus magna lacus, eu lacinia ante consequat id. Proin malesuada libero eu tortor lacinia, eget lacinia lorem luctus. Vestibulum eget lectus nec elit tincidunt scelerisque a vitae lacus. Suspendisse potenti. Etiam rutrum mauris non rhoncus faucibus. Nulla aliquam ipsum tortor, et elementum nulla facilisis quis. Maecenas finibus justo sem.</p>
  </div>

</main>
<?php echo View::render('nav/_footer', ['isDark' => false, 'isBordered' => true]) ?>
