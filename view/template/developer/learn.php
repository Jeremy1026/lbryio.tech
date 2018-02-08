<?php echo View::render('nav/_header', ['isDark' => false, 'isBordered' => false]) ?>
<?php Response::setMetaTitle('LBRY Get Started') ?>
<?php Response::setMetaDescription('Be up and running with the LBRY API in just a few minutes.') ?>
<?php Response::addCssAsset('/css/codemirror/lib/codemirror.css') ?>
<?php Response::addCssAsset('/css/jquery-ui.min.css') ?>
<?php Response::addJsAsset('/js/jquery-ui.min.js') ?>
<?php Response::addJsAsset('/js/codemirror/lib/codemirror.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/xml/xml.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/javascript/javascript.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/css/css.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/htmlmixed/htmlmixed.js') ?>
<?php Response::addJsAsset('/js/codemirror/addon/edit/matchbrackets.js') ?>
<?php Response::addJsAsset('/js/terminalEmulator/editor.js') ?>
<?php Response::addJsAsset('/js/terminalEmulator/methods.js') ?>
<?php if ($stepNum > 0) : ?>
<?php Response::addJsAsset("/js/lesson/_lesson".ucfirst($currentStep).".js") ?>
<?php endif; ?>

<main class="learn cover-dark cover-dark-grad">

  <div class="cover-dark cover-dark-grad">
    <?php echo View::render('content/_lesson', ['lesson' => $currentStep, 'steps' => ['stepNum' => $stepNum, 'stepLabels' => $stepLabels]]) ?>

  </div>

</main>
