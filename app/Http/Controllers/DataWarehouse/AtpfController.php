<?php

namespace App\Http\Controllers\DataWarehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AtpfController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $query;
    private $total_perpage = 10;

    public function __construct()
    {
        $this->queryAtpf = DB::connection("atpf");
        $this->queryArea = DB::connection("area");
        $this->queryAtpf->enableQueryLog();
    }

    public function mt4_trade(Request $request ){
        try {
            // Get page for pagination
            $page = $request->get("page") ?? 1;
            $skip = ($page - 1) * $this->total_perpage;
    
            // Get date query
            $date = $request->get("date");
            $startDate = $date;
            $endDate = $date;

            if($date){
                $startDate = $date." 00:00:00";
                $endDate = $date." 23:59:59";
            }
    
            // Get data
            $data = $this->queryAtpf->table("MT4_TRADES")
                ->where(function($query) use($date, $startDate, $endDate){
                    if(!empty($date)){
                        $query->whereDate("MODIFY_TIME", $date);
                    }
                })  
                ->skip($skip)
                ->take($this->total_perpage)
                ->get();
    
            // Generate response format
            $url = $request->fullUrlWithQuery([
                'date' => $date, 
                'page'=> $page + 1
            ]);
            $response["current_page"]   = (int) $page;
            $response["data"]           = $data;
            $response["next_page"]      = count($data) < $this->total_perpage ? null : $url;
            return $response;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }


    public function village_detail(Request $request){

        // Get page for pagination
        $page = $request->get("page") ?? 1;
        $skip = ($page - 1) * $this->total_perpage;

        // Get data
        $data = $this->queryArea->table("village_detail")
            ->skip($skip)
            ->take($this->total_perpage)
            ->get([
                "id_village",
                "id_province",
                "province",
                "id_city",
                "city",
                "id_sub_district",
                "sub_district",
                "village"
            ]);

        // Generate response format
        $url = $request->fullUrlWithQuery([
            'page'=> $page + 1
        ]);
        $response["current_page"]   = (int) $page;
        $response["data"]           = $data;
        $response["next_page"]      = count($data) < $this->total_perpage ? null : $url;
        return $response;

    }
}
