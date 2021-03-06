<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddDoDtl;
use DB;

class AddDoDtlController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $appkey;
    public function __construct()
    {
        $value = env('APP_KEY', true);
        $this->appkey = str_replace('base64:', '', $value);
    }

    public function index(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                	return $response;
    			}

    			// $data = DB::table('do_dtl')
                // ->select(
                // 	'do_dtl.do_no',
                // 	'do_dtl.sso_no',
                //     'do_dtl.descript',
                //     'do_dtl.unit',
                //     'do_dtl.quantity',
                //     'do_dtl.price',
                //     'do_dtl.cost',
                //     'do_dtl.itemcode',
                //     'do_dtl.part_no'
                // )
                // ->where(function ( $query) use ($request)
                // {
                //     $query->where('do_dtl.do_no', $request->input('do_no'))
                //             ->orWhere('do_dtl.do_no', $request->input('do_no2'))
                //             ->orWhere('do_dtl.do_no', $request->input('do_no3'))
                //             ->orWhere('do_dtl.do_no', $request->input('do_no4'))
                //             ->orWhere('do_dtl.do_no', $request->input('do_no5'))
                //             ;
                // })
                // ->limit(106)
                // ->get();

                $data = DB::table('entry_do_tbl')
                ->leftJoin('item','item.ITEMCODE','=','entry_do_tbl.item_code')
                ->select(
                	'entry_do_tbl.do_no',
                	'entry_do_tbl.sso_no',
                    'item.DESCRIPT',
                    'entry_do_tbl.unit',
                    'entry_do_tbl.quantity',
                    'item.PRICE',
                    'item.COST',
                    'entry_do_tbl.item_code',
                    'item.PART_NO'
                )
                ->where(function ( $query) use ($request)
                {
                    $query->where('entry_do_tbl.do_no', $request->input('do_no'))
                            ->orWhere('entry_do_tbl.do_no', $request->input('do_no2'))
                            ->orWhere('entry_do_tbl.do_no', $request->input('do_no3'))
                            ->orWhere('entry_do_tbl.do_no', $request->input('do_no4'))
                            ->orWhere('entry_do_tbl.do_no', $request->input('do_no5'))
                            ;
                })
                ->limit(106)
                ->get();

                $response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }
}