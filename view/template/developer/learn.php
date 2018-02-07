<?php Response::addCssAsset('/css/codemirror/lib/codemirror.css') ?>
<?php Response::addJsAsset('/js/codemirror/lib/codemirror.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/xml/xml.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/javascript/javascript.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/css/css.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/htmlmixed/htmlmixed.js') ?>
<?php Response::addJsAsset('/js/codemirror/addon/edit/matchbrackets.js') ?>
<?php Response::setMetaDescription('Be up and running with the LBRY API in just a few minutes.') ?>
<?php Response::setMetaTitle('LBRY Get Started') ?>
<?php Response::addJsAsset('/js/terminalEmulator.js') ?>
<?php Response::addJsAsset("/js/lesson/_lesson".ucfirst($currentStep).".js") ?>

<main class="cover-stretch-wrap">

  <div class="cover cover-dark cover-dark-grad">
    <?php echo View::render('content/_lesson', ['lesson' => $currentStep, 'stepNum' => $stepNum]) ?>

  <?php if ($stepNum > 0) : ?>
    <a href="<?php echo $stepLabels[$stepNum-1]; ?>"><button id="prevButton">Previous</button></a>
    <a href="<?php echo $stepLabels[$stepNum+1]; ?>"><button id="nextButton" disabled>Next</button></a>
  <?php else : ?>
    <?php echo View::render('developer/_lesson') ?>
    <a><button disabled>Previous</button></a>
    <a href="../learn/<?php echo $stepLabels[$stepNum+1]; ?>"><button id="nextButton">Next</button></a>
  <?php endif; ?>

  </div>

</main>
