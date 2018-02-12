<div class="span4 instructions">
  <h4>
  <?php echo $title; ?>
  </h4>
  <p>
    <?php echo $instructionsHtml; ?>
  </p>
  <div class="goBack top-spacer1 spacer1 text-center">
    <?php if ($stepNum > 0) : ?>
      <a href="/courses/<?php echo $course; ?>/<?php echo $stepLabels[$stepNum-1]; ?>" class="btn-alt btn-large">Previous Lesson</a>
    <?php else : ?>
      <a href="/courses/<?php echo $course; ?>/<?php echo $stepLabels[$stepNum+1]; ?>" class="btn-alt btn-large">Continue</a>
    <?php endif; ?>

  </div>
  <div id="successMessage" class="successMessage text-center" style="display: none;">
    <p>
      <?php echo $successMessage; ?>
    </p>
    <div class="top-spacer1"><a href="<?php echo $stepLabels[$stepNum+1]; ?>" class="btn-alt btn-large">Continue</a></div>
  </div>

</div>
<div class="span8 editor">
  <link rel="stylesheet" href="/css/codemirror/lib/codemirror.css">
  <textarea id="editor">lbry-daemon$ </textarea>
</div>
