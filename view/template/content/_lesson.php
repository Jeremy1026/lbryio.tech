<div class="row">
  <div class="span8">
    <h4>
	  <?php echo $title; ?>
    </h4>
    <p>
      <?php echo $instructionsHtml; ?>
    </p>
  </div>
  <?php if ($stepNum !== 0) : ?>
  <div class="span12 editor">
    <?php echo View::render('developer/_lessonTerminal' ) ?>
  </div>
  <div id="successMessage" class="span8" style="display:none;">
    <p>
      <?php echo $successMessage; ?>
    </p>
  </div>
  <?php endif; ?>
</div>
