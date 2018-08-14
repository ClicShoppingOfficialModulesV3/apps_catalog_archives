<?php
/*
 * Configure.php
 * @copyright Copyright 2008 - http://www.innov-concept.com
 * @Brand : ClicShopping(Tm) at Inpi all right Reserved
 * @license GPL 2 License & MIT Licencse
*/

  namespace ClicShopping\Apps\Catalog\Archive\Sites\ClicShoppingAdmin\Pages\Home\Actions;

  use ClicShopping\OM\Registry;

  class Archive extends \ClicShopping\OM\PagesActionsAbstract {
    public function execute() {
      $CLICSHOPPING_Archive = Registry::get('Archive');

      $this->page->setFile('archive.php');
      $this->page->data['action'] = 'Archive';

      $CLICSHOPPING_Archive->loadDefinitions('Sites/ClicShoppingAdmin/Archive');
    }
  }