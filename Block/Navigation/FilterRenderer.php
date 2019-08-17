<?php
/**
 * Catalog layer filter renderer
 *
 * Copyright © Dxvn, Inc. All rights reserved.
 * @author  Tran Ngoc Duc <caothu91@gmail.com>
 */

namespace Diepxuan\LayeredNavigationPriceSlider\Block\Navigation;

use Magento\Catalog\Model\Layer\Filter\FilterInterface;

/**
 * Class FilterRenderer
 * @package Diepxuan\LayeredNavigation\Block\Navigation
 */
class FilterRenderer extends \Magento\LayeredNavigation\Block\Navigation\FilterRenderer {

    /**
     * @param FilterInterface $filter
     *
     * @return string
     */
    public function render( FilterInterface $filter ) {
        $this->assign( 'filter', $filter );
        $this->assign( 'filterItems', $filter->getItems() );
        $this->assign( 'filterRange', $this->getPriceRange( $filter ) );
        $this->assign( 'filterUrl', $this->getFilterUrl( $filter ) );
        $html = $this->_toHtml();
        $this->assign( 'filterItems', [] );
        $this->assign( 'filterRange', null );
        $this->assign( 'filterUrl', null );

        return $html;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return array
     */
    public function getPriceRange( FilterInterface $filter ) {
        $Filterprice        = array( 'min' => 0, 'max' => 0 );
        $priceArr           = $filter->getResource()->loadPrices( 10000000000 );
        $Filterprice['min'] = reset( $priceArr );
        $Filterprice['max'] = end( $priceArr );

        return $Filterprice;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return string
     */
    public function getFilterUrl( FilterInterface $filter ) {
        $query = [ 'price' => '' ];

        return $this->getUrl( '*/*/*', [ '_current' => true, '_use_rewrite' => true, '_query' => $query ] );
    }
}
