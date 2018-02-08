<!-- <div class="column"> -->
  <div class="span4 instructions">
    <h4>
	  <?php echo $title; ?>
    </h4>
    <p>
      <?php echo $instructionsHtml; ?>
    </p>
    <div id="successMessage" class="span8" style="display:none;">
      <p>
        <?php echo $successMessage; ?>
      </p>
    </div>
    <?php if ($stepNum > 0) : ?>
      <a href="<?php echo $stepLabels[$stepNum-1]; ?>"><button id="prevButton">Previous</button></a>
      <a href="<?php echo $stepLabels[$stepNum+1]; ?>"><button id="nextButton" disabled>Next</button></a>
    <?php else : ?>
      <a><button disabled>Previous</button></a>
      <a href="../learn/<?php echo $stepLabels[$stepNum+1]; ?>"><button id="nextButton">Next</button></a>
    <?php endif; ?>

  </div>
  <div class="span8 editor">
    <link rel="stylesheet" href="/css/codemirror/lib/codemirror.css">
    <textarea id="editor">lbry-daemon$ </textarea>
  </div>
<!-- </div> -->
