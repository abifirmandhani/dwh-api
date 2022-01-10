<?php

namespace App\Models;


class ResponseListOrderDetail
{
    /**
     * @var int
     */
    public $current_page;

    /**
     * @var int
     */
    public $next_page;

    /**
     * @var App\Models\OrderDetailRoSave[]
     */
    public $data;


    /**
     * Product constructor.
     *
     * @param int $current_page
     * @param int $next_page
     * @param App\Models\OrderDetailRoSave[] $data
     */
    public function __construct($current_page, $next_page, $data)
    {
        $this->current_page = $current_page;
        $this->next_page = $next_page;
        $this->data = $data;
    }

}
