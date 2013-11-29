<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<?php if (variable_get('wikicompare_test_platform', 0)): ?>
  <p id="alert-test-platform">This is a test platform, it can be destroyed at ANY moment when we will upgrade our files to test a new version of the system.</p>
<?php endif; ?>

<div id="page">

  <header class="header" id="header" role="banner">

    <div>
    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
    <?php endif; ?>

    <div id="header-links" class="skip-wikicompare-theme">

      <?php
        $block = module_invoke('lang_dropdown', 'block_view', 'language');
        print render($block['content']);
      ?>


      <?php if (user_is_anonymous() == True): ?>
        <div id="block-persona-sign-in" class="block block-persona first last odd">
          <a href="http://www.wikicompare.info/user" target="_blank" class="persona-sign-in">Login / Register</a>
        </div>
      <?php else: ?>
        <?php if ($secondary_menu): ?>
          <nav class="header__secondary-menu" id="secondary-menu" role="navigation">
            <?php print theme('links__system_secondary_menu', array(
              'links' => $secondary_menu,
              'attributes' => array(
                'class' => array('links', 'inline', 'clearfix'),
              ),
              'heading' => array(
                'text' => $secondary_menu_heading,
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          </nav>
        <?php endif; ?>
      <?php endif; ?>

    </div>
    </div>

    <div style="clear:both;"></div>

    <div class="header__div-site_name" id="div-site-name">
      <?php if ($site_name): ?>
        <h1 class="header__site-name" id="site-name">
          <?php print $site_name; ?>
        </h1>
      <?php endif; ?>
    </div>

  </header>

  <div id="main">
    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php if (!in_array(arg(0), array('home', 'compare'))): ?>
        <?php print $breadcrumb; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
      <?php endif; ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <div id="navigation">

      <?php print render($page['navigation']); ?>

    </div>

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>

  <?php print render($page['footer']); ?>

</div>

<div id="sticky-footer">
  <ul>
    <?php global $base_path; ?>
    <li id="menu-footer"><img src="<?php print $base_path . path_to_theme() . '/images/menu-icon.png' ?>" alt="Menu"/>
      <?php if ($main_menu): ?>
        <nav id="main-menu" role="navigation" tabindex="-1">
          <?php
          // This code snippet is hard to modify. We recommend turning off the
          // "Main menu" on your sub-theme's settings form, deleting this PHP
          // code block, and, instead, using the "Menu block" module.
          // @see https://drupal.org/project/menu_block
          print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'class' => array('links', 'clearfix'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>
    </li>
    <li id="compare-link-footer"<?php if (arg(0) =='home'): ?>><a class="compare-url" href="#"><?php else: ?> class="product-dialog"><?php endif; ?>
      <span id="nb-products-footer">3</span><span id="compare-text-footer">Compare products</span>
    <?php if (arg(0) =='home'): ?></a><?php endif; ?>
    </li>
    <li class="empty-footer"><a href="/wikicompare-make-cleaning-callback/nojs" id="toogle-fastaction-link" class="ajaxlink" action="toogle-fastaction" style="display:none;">F</a><a href="/wikicompare-make-cleaning-callback/nojs" id="make-cleaning-link" class="ajaxlink" action="make-cleaning" style="display:none;">C</a></li>
    <?php if (user_is_anonymous() != True): ?>
      <li id="fastaction-footer">Toogle Fastaction</li>
    <?php else: ?>
      <li class="empty-footer"></li>
    <?php endif; ?>
    <li><span id="state-display-footer">Display</span> <span id="state-draft-footer">Draft</span> | <span id="state-closed-footer">Closed</span></li>
  </ul>
</div>


<?php print render($page['bottom']); ?>
