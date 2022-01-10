<?php

namespace App\Models;


class OrderRoSave
{
    /**
     * @var int
     */
    public $orders_id;
    /**
     * @var string
     */
    public $orders_username;
    /**
     * @var string
     */
    public $orders_nama;
    /**
     * @var string
     */
    public $orders_alamat;
    /**
     * @var string
     */
    public $orders_kota;
    /**
     * @var string
     */
    public $orders_propinsi;
    /**
     * @var string
     */
    public $orders_kodepos;
    /**
     * @var string
     */
    public $orders_telp;
    /**
     * @var int
     */
    public $orders_status;
    /**
     * @var string
     */
    public $orders_invoice;
    /**
     * @var double
     */
    public $orders_value;
    /**
     * @var double
     */
    public $orders_ongkir;
    /**
     * @var string
     */
    public $orders_date_create;
    /**
     * @var string
     */
    public $orders_date_process;
    /**
     * @var string
     */
    public $orders_keterangan;
    /**
     * @var int
     */
    public $orders_qty;
    /**
     * @var string
     */
    public $orders_kurir_info;
    /**
     * @var string
     */
    public $orders_process_by;
    /**
     * @var int
     */
    public $orders_payment_status;
    /**
     * @var int
     */
    public $orders_jenis_pin;
    /**
     * @var string
     */
    public $orders_kec;
    /**
     * @var int
     */
    public $orders_kec_code;
    /**
     * @var int
     */
    public $orders_kota_code;
    /**
     * @var string
     */
    public $orders_shipping_cost;
    /**
     * @var int
     */
    public $orders_shipping_cost_unik;
    /**
     * @var string
     */
    public $orders_kurir;
    /**
     * @var string
     */
    public $orders_track;
    /**
     * @var int
     */
    public $orders_reward;
    /**
     * @var double
     */
    public $orders_wallet;
    /**
     * @var double
     */
    public $orders_total_tagihan;
    /**
     * @var int
     */
    public $orders_canceled;
    /**
     * @var string
     */
    public $orders_date_input;
    /**
     * @var string
     */
    public $bukti_transfer;
    /**
     * @var int
     */
    public $orders_total_bv;
    /**
     * @var double
     */
    public $orders_currency;
    /**
     * @var double
     */
    public $orders_value_usd;
    /**
     * @var string
     */
    public $orders_crypto_address;
    /**
     * @var int
     */
    public $orders_crypto_status;
    /**
     * @var int
     */
    public $orders_via_crypto;
    /**
     * @var string
     */
    public $orders_expired_date;
    /**
     * @var string
     */
    public $orders_payment_method;
    /**
     * @var string
     */
    public $orders_bank;
    /**
     * @var string
     */
    public $orders_accname;
    /**
     * @var string
     */
    public $orders_accnum;
    /**
     * @var string
     */
    public $orders_bank_reff;
    /**
     * @var int
     */
    public $proses_lunas;
    /**
     * @var string
     */
    public $proses_tgl;
    /**
     * @var int
     */
    public $send_email_status;
    /**
     * @var int
     */
    public $id_pengiriman;
    /**
     * @var int
     */
    public $rekapbonus;
    /**
     * @var string
     */
    public $rekapbonus_date;
    /**
     * @var int
     */
    public $to_shipment;
    /**
     * @var string
     */
    public $to_shipment_date;
    /**
     * @var string
     */
    public $canceled_date;
    /**
     * @var int
     */
    public $orders_item;
    /**
     * @var string
     */
    public $orders_nama_pengirim;
    /**
     * @var string
     */
    public $orders_nomor_pengirim;
    /**
     * @var int
     */
    public $ultra_package;
    /**
     * @var string
     */
    public $orders_payment_provider;
    /**
     * @var int
     */
    public $rekap_vc_bniva;
    /**
     * @var string
     */
    public $rekap_vc_date;
    /**
     * @var int
     */
    public $vc_jenis;
    /**
     * @var int
     */
    public $rekapvc;


    /**
     * Product constructor.
     *
     * @param int $id_user
     * @param string $username
     * @param string $email
     */
    public function __construct()
    {
        // $this->id_user = $id_user;
        // $this->username = $username;
        // $this->email = $email;
        // $this->created_at = $created_at;
    }

}
