<?php Response::setMetaTitle(__('title.home')) ?>
<?php Response::setMetaDescription(__('description.home')) ?>
<?php echo View::render('nav/_header', ['isDark' => false, 'isBordered' => false]) ?>
<main class="home">
  <div class="home__title cover-dark cover-dark-grad">
    <h1 class="cover-title cover-title-flat text-center ">Build With LBRY</h1>
    <div class="content-wide home__copy">
      <div class="spacer2">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut molestie ante ac fermentum venenatis. Donec malesuada efficitur augue, ut maximus sapien tempus non. Nam gravida sollicitudin erat. Fusce et libero dui. Nullam quis hendrerit odio, sed imperdiet diam. Etiam tempor dictum sollicitudin. Sed non felis sit amet nulla auctor lobortis id eget elit. Nunc ipsum enim, blandit sed leo non, egestas tincidunt risus.
      </div>
    </div>
  </div>
  <div class="cover content content-light content-wide home__copy">
    <div class="terminal spacer2">
      <div class="terminal-content">
        <div>lbry-daemon$ get_started</div>
        <div>{</div>
        <div class="tab">"about": "Learn how to interact with LBRY with an interative tutorial.",</div>
        <div class="tab">"command_help": "Use API commands in a real world environment and see first hand what happens behind the scenes."</div>
        <div class="tab">"command_list": "See the API Docs at <a href="https://lbry.io/api">https://lbry.io/api</a>"</div>
        <div>}</div>
        <div class="last-line">lbry-daemon$</div>
      </div>
    </div>
  </div>
  <div class="column-fluid cover-dark-grad cover-dark home__bottom">
    <div class="span12 text-center top-spacer2 spacer2">
        <a href="/learn" class="btn-alt btn-large">Get Started</a><BR>
    </div>
    <div class="span2"></div>
    <div class="span2">
      <div class="cover cover-light-alt cover-light-alt-grad">
          <div class="content content-light content-tile">
            <h3>For Developers</h3>
            <p>LBRY is 100% open source in the <a class="link-primary" href="https://en.wikipedia.org/wiki/The_Cathedral_and_the_Bazaar">Bazaar tradition</a>.</p>
            <?php echo View::render('content/_listDev') ?>
          </div>
        </div>
    </div>
    <div class="span1"></div>
    <div class="span2">
      <div class="cover cover-light-alt cover-light-alt-grad">
          <div class="content content-light content-tile">
            <h3>Why Build for LBRY?</h3>
            <p>LBRY is the first digital marketplace to be controlled by the market’s participants rather than a corporation or other 3rd-party. It is the most open, fair, and efficient marketplace for digital goods ever created, with an incentive design encouraging it to become the most complete.</p>
            <p>Be a part of building the future of digital media consumption.</p>
          </div>
      </div>
    </div>
    <div class="span2"></div>
  </div>
</main>
<?php echo View::render('nav/_footer', ['isDark' => false, 'isBordered' => true]) ?>
