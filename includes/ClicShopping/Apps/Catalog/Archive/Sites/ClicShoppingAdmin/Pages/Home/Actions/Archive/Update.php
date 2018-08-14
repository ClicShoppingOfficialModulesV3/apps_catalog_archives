<?php
/**
 * SetFlag.php
 * @copyright Copyright 2008 - http://www.innov-concept.com
 * @Brand : ClicShopping(Tm) at Inpi all right Reserved
 * @license GPL 2 License & MIT Licencse
 
 */


  namespace ClicShopping\Apps\Catalog\Archive\Sites\ClicShoppingAdmin\Pages\Home\Actions\Archive;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Cache;

  class Update extends \ClicShopping\OM\PagesActionsAbstract {
    public function execute() {
      $CLICSHOPPING_Archive = Registry::get('Archive');

      $products_id = HTML::sanitize($_GET['aID']);

      $Qupdate = $CLICSHOPPING_Archive->db->prepare('update :table_products
                                              set products_archive = :products_archive
                                              where products_id = :products_id
                                            ');
      $Qupdate->bindInt(':products_archive', 0 );
      $Qupdate->bindInt(':products_id', $products_id );
      $Qupdate->execute();

      Cache::clear('categories');
      Cache::clear('products-also_purchased');
      Cache::clear('products_related');
      Cache::clear('products_cross_sell');
      Cache::clear('upcoming');

      $CLICSHOPPING_Archive->redirect('Archive&' . (isset($_GET['page']) ? 'page=' . $_GET['page'] . '' : ''));
    }
  }