<?php

namespace App\Models;


class OrderDetailRoSave
{
    /**
     * @var int
     */
    public $details_id;
    /**
     * @var string
     */
    public $details_username;
    /**
     * @var string
     */
    public $details_invoice;
    /**
     * @var string
     */
    public $details_item;
    /**
     * @var double
     */
    public $details_harga;
    /**
     * @var int
     */
    public $details_qty;
    /**
     * @var double
     */
    public $details_total;
    /**
     * @var string
     */
    public $details_warna;
    /**
     * @var string
     */
    public $details_ukuran;
    /**
     * @var string
     */
    public $details_kode;
    /**
     * @var int
     */
    public $details_weight;
    /**
     * @var int
     */
    public $details_total_weight;
    /**
     * @var int
     */
    public $details_bv;


    /**
     * Product constructor.
     *
     * @param int $id_user
     * @param string $username
     * @param string $email
     */
    public function __construct()
    {
    }

}
