<?php

namespace App\Models;

use App\Models\ReponseListOrderRoSave;
use App\Models\OrderRoSave;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use SoapFault;

/**
 * An example of a class that is used as a SOAP gateway to application functions.
 */
class SoapService
{

    /**
     * Returns an array of orders ro save by created date.
     *
     * @param string $created_at
     * @param int $page
     * @return \App\Models\ReponseListOrderRoSave
     * @throws SoapFault
     */
    public function get_order_ro_save($created_at = null, $page = 1)
    {
        $total_perpage = 10;
        $skip = ($page - 1) * $total_perpage;

        $data = DB::connection("pansakadb")->table("orders_ro_save")
            ->where(function($query) use($created_at){
                if(!empty($created_at)){
                    $query->whereDate("orders_date_create" ,$created_at);
                }
            })
            ->skip($skip)
            ->take($total_perpage)
            ->get();

        $current_page = (int) $page;
        $next_page = count($data) < $total_perpage ? null : $page + 1;

        $response = new ReponseListOrderRoSave($current_page, $next_page, $data);
        return $response;
    }

    /**
     * Returns an array of orders details ro save by created date.
     *
     * @param int $page
     * @return \App\Models\ResponseListOrderDetail
     * @throws SoapFault
     */
    public function get_details_ro_save($page = 1){
        $total_perpage = 10;
        $skip = ($page - 1) * $total_perpage;

        $data = DB::connection("pansakadb")->table("orders_detail_ro_save")
            ->skip($skip)
            ->take($total_perpage)
            ->get();

        $current_page = (int) $page;
        $next_page = count($data) < $total_perpage ? null : $page + 1;

        $response = new ResponseListOrderDetail($current_page, $next_page, $data);
        return $response;
    }

}
