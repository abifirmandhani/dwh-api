<?php

namespace App\Http\Controllers\DataWarehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $this->queryAccount = DB::connection("account");
        $this->queryCms = DB::connection("cms");
        $this->queryAtpf = DB::connection("atpf");
    }

    public function login(Request $request){
        $username = $request->get("username");
        $password = $request->get("password");

        $list_account = config("datawarehouse.ACCOUNT");

            if(!isset($list_account[$username])){
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found'
                ], 404); 
            }

            $account_key = $list_account[$username]["KEY"];

            $check = Hash::check($password, $account_key);
            if(!$check){
                return response()->json([
                    'status'  => false,
                    'message' => 'Wrong Password'
                ], 401); 
            }

        
            $user   = new User;
            $user->username = $username;
            $token  = auth()->fromUser($user);

            return response()->json([
                'status'  => true,
                'message' => 'Success',
                'data'    => [
                    "token" => $token,
                    "type"  => "Bearer"
                ] 
            ], 200); 
    }

    public function all(Request $request ){
        // Get page for pagination
        $page = $request->get("page") ?? 1;
        $skip = ($page - 1) * $this->total_perpage;

        // Get date query
        $date = $request->get("date");

        $data = $this->queryAccount->table("users")
            ->where(function($query) use($date){
                if(!empty($date)){
                    $query->whereDate("created_at", $date)
                    ->orWhereDate("updated_at", $date);
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
    }

    public function allCms(Request $request ){
        // Get page for pagination
        $page = $request->get("page") ?? 1;
        $skip = ($page - 1) * $this->total_perpage;

        // Get date query
        $date = $request->get("date");

        // Get data
        $startDate = $date;
        $endDate = $date;

        if($date){
            $startDate = $date." 00:00:00";
            $endDate = $date." 23:59:59";
        }
        
        $data = $this->queryCms->table("user")
            ->where(function($query) use($date, $startDate, $endDate){
                if(!empty($date)){
                    $query->where(function($query) use($date, $startDate, $endDate){
                        $query->whereRaw("created_at >= (select unix_timestamp('$startDate'))")
                        ->whereRaw("created_at <= (select unix_timestamp('$endDate'))");
                    })
                    ->orWhere(function($query) use($date, $startDate, $endDate){
                        $query->whereRaw("updated_at >= (select unix_timestamp('$startDate'))")
                        ->whereRaw("updated_at <= (select unix_timestamp('$endDate'))");
                    });
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
    }

    public function allAtpf(Request $request ){
        // Get page for pagination
        $page = $request->get("page") ?? 1;
        $skip = ($page - 1) * $this->total_perpage;

        // Get date query
        $created_at = $request->get("created_at");
        $updated_at = $request->get("updated_at");

        // Get data
        $data = $this->queryAtpf->table("user")
            ->where(function($query) use($created_at, $updated_at){
                if(!empty($created_at)){
                    $query->where("created_at", "LIKE" , "%$created_at%");
                }
                if(!empty($updated_at)){
                    $query->orWhere("updated_at", "LIKE", "%$updated_at%");
                }
            })  
            ->skip($skip)
            ->take($this->total_perpage)
            ->get([
                "user_id",
                "user_email",
                "user_role",
                "user_name",
                "created_at",
                "updated_at"
            ]);

        $newList = [];
        foreach ($data as $value) {
            if($value->updated_at == "0000-00-00 00:00:00"){
                $value->operation_id = "I";
                $value->updated_at = null;
            }else{
                $value->operation_id = "U";
            }
            $newList[] = $value;
        }

        // Generate response format
        $url = $request->fullUrlWithQuery([
            'created_at' => $created_at, 
            'updated_at' => $updated_at, 
            'page'=> $page + 1
        ]);
        $response["current_page"]   = (int) $page;
        $response["data"]           = $data;
        $response["next_page"]      = count($data) < $this->total_perpage ? null : $url;
        return $response;
    }

    public function atpfRealAccount(Request $request){

        // Get page for pagination
        $page = $request->get("page") ?? 1;
        $skip = ($page - 1) * $this->total_perpage;

        // Get data
        $data = $this->queryAtpf->table("realaccount")
            ->skip($skip)
            ->take($this->total_perpage)
            ->get([
                "user_id",
                "realaccount_ibcodesub",
                "realaccount_ibcode",
                "realaccount_alamat_tinggal_kel",
                "realaccount_alamat_tinggal_kec",
                "realaccount_alamat_tinggal_kota",
                "realaccount_alamat_tinggal_provinces",
                "realaccount_jeniskelamin",
                "realaccount_birthdate",
                "realaccount_nama",
                "realaccount_accno",
                "realaccount_namabank"
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
