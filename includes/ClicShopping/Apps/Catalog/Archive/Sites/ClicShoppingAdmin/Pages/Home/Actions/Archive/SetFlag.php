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

  class SetFlag extends \ClicShopping\OM\PagesActionsAbstract {
    public function execute() {
      $CLICSHOPPING_Archive = Registry::get('Archive');

      $products_id = HTML::sanitize($_GET['aID']);

      static::getProductArchiveStatus($_GET['aID'], $_GET['flag']);

      Cache::clear('categories');
      Cache::clear('products-also_purchased');
      Cache::clear('products_related');
      Cache::clear('products_cross_sell');
      Cache::clear('upcoming');

      $CLICSHOPPING_Archive->redirect('Archive&', (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'aID=' . $products_id);
    }


/**
 * Status products archive - Sets the archive of a productts
 *
 * @param string products_id, archive
 * @return string status on or off
 * @access public
 *
 */
    Private static function getProductArchiveStatus($products_id, $archive) {
      $CLICSHOPPING_Archive = Registry::get('Archive');

      if ($archive == 1) {

        return $CLICSHOPPING_Archive->db->save('products', ['products_status' => 1,
                                                    'products_last_modified' => 'now()'
                                                    ],
                                                    ['products_id' => (int)$products_id]
                                         );

      } elseif ($archive == 0) {

        return $CLICSHOPPING_Archive->db->save('products', ['products_status' => 0,
                                                    'products_last_modified' => 'now()'
                                                    ],
                                                    ['products_id' => (int)$products_id]
                                        );
      } else {
        return -1;
      }
    }
  }