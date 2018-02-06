<?php Response::addCssAsset('/css/codemirror/lib/codemirror.css') ?>
<?php Response::addJsAsset('/js/codemirror/lib/codemirror.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/xml/xml.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/javascript/javascript.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/css/css.js') ?>
<?php Response::addJsAsset('/js/codemirror/mode/htmlmixed/htmlmixed.js') ?>
<?php Response::addJsAsset('/js/codemirror/addon/edit/matchbrackets.js') ?>
<?php Response::setMetaDescription('Be up and running with the LBRY API in just a few minutes.') ?>
<?php Response::setMetaTitle('LBRY Get Started') ?>
<?php Response::addJsAsset('/js/editor.js') ?>

<main class="cover-stretch-wrap">

  <div class="cover cover-dark cover-dark-grad">
      <?php echo View::render('content/_lesson', ['lesson' => $stepLabels[$currentStep]]) ?>

  <?php if ($stepNum > 0) : ?>
    <?php echo View::render('developer/_lesson' . ucfirst($currentStep) ) ?>
    <a href="<?php echo $allSteps[$stepNum-1]; ?>"><button>Previous</button></a>
  <?php else : ?>
    <?php echo View::render('developer/_lesson') ?>
    <a><button disabled>Previous</button></a>
  <?php endif; ?>
    <a href="<?php echo $allSteps[$stepNum+1]; ?>"><button>Next</button></a>

  </div>

</main>
