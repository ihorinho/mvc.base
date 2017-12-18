<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.12.2016
 * Time: 10:53
 */
namespace Library\Pagination;

/**
 * Class Pagination
 * @package Library\Pagination
 */
class Pagination
{
    /**
     * @var array
     */
    private $buttons = array();
    /**
     * @var Button
     */
    private $next;
    /**
     * @var Button
     */
    private $previous;

    /**
     * Pagination constructor.
     * @param $currentPage
     * @param $itemsCount
     * @param $itemsPerPage
     */
    public function __construct($currentPage, $itemsCount, $itemsPerPage)
    {
        $pagesCount = ceil($itemsCount/$itemsPerPage);
        $this->previous  = new Button(1, $currentPage > 1, "Previous" );
        for ($i = 1; $i <= $pagesCount; $i++) {
            $is_active = $i != $currentPage;
            $this->buttons[] = new Button($i, $is_active);
        }
        $this->next = new Button($pagesCount, $currentPage < $pagesCount, 'Next');
    }

    /**
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @return Button
     */
    public function getPrev(){
        return $this->previous;
    }

    /**
     * @return Button
     */
    public function getNext(){
        return $this->next;
    }
}