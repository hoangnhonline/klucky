<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\ArticlesCate;
use App\Models\Settings;
use App\Models\Gift;
use App\Models\GiftCode;
use App\Models\Customer;

use Response;
use Helper, File, Session, Auth, Hash, Mail;

class HomeController extends Controller
{
    
  

    public function __construct(){        
       
    }
    public function view()
    {
        $file = public_path().'/test.pdf';
        
        if (File::isFile($file))
        {
            $file = File::get($file);

            $response = Response::make($file, 200);
            $content_types = [
                'application/octet-stream', // txt etc
                'application/msword', // doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/vnd.ms-excel', // xls
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                'application/pdf', // pdf
            ];
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', $content_types);

            return $response;
        }
    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */    
    public function index(Request $request)
    {             
        $productArr = [];
       
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $seo = $settingArr;
        $seo['title'] = $settingArr['site_title'];
        $seo['description'] = $settingArr['site_description'];        
               
        return view('frontend.home.index', compact(
                                'seo'
                                ));
    }

    public function coCauGiai(){
        
        $giftList = Gift::where('id', '<>', 999)->orderBy('id', 'asc')->get();
        $countCode = [];
        foreach($giftList as $gift){
            $countCode[$gift->id] = GiftCode::where('status', 1)->where('gift_id', $gift->id)->count();
        }
        $seo['title'] = $seo['description'] = 'Cơ cấu giải';
        return view('frontend.co-cau-giai', compact(
                                'seo',
                                'giftList',
                                'countCode'
                                ));
    }
    public function theLe(){
        
        $seo['title'] = $seo['description'] = 'Thể lệ';
        $contentList = Articles::where('cate_id', 1)->orderBy('display_order', 'asc')->get();
        return view('frontend.the-le', compact(
                                'seo',
                                'contentList'
                                ));
    }
    public function huongDan(){
        
        $seo['title'] = $seo['description'] = 'Hướng dẫn';
        $contentList = Articles::where('cate_id', 2)->orderBy('display_order', 'asc')->get();
        return view('frontend.huong-dan', compact(
                                'seo',
                                'contentList'
                                ));
    }    
    public function contact(Request $request){        

        $seo['title'] = 'Liên hệ';
        $seo['description'] = 'Liên hệ';        
        return view('frontend.lien-he', compact('seo', 'socialImage'));
    }

    public function getContent(Request $request){        
        $id = $request->id ? $request->id : null;
        if($id){
            $content = Articles::find($id)->toArray();
            $content['title'] = strip_tags($content['title']);
            return json_encode($content);
        }
        
    }

    public function checkNo(Request $request){
        $code = $request->code ? $request->code : null;
        
        $rs = GiftCode::where('code', $code)->whereIn('gift_code.status', [1, 2])
                ->join('gift', 'gift.id', '=', 'gift_code.gift_id')
                ->select('popup_image_url', 'name', 'code', 'gift_id')
                ->first();
         
        if(!$rs){
            return json_encode(['success' => 0]);
        }else{
            $arr = $rs->toArray();
            if($arr['gift_id'] == 999){ //lose
                $arr['success'] = 2;    
            }else{
                $arr['success'] = 1;    
            }            
            return json_encode($arr);
        }
        
    }
    public function sendContact(Request $request){
        $dataArr = $request->all();   
        if($dataArr['date_from'] && $dataArr['date_to']){    
            $dataArr['date_from'] = date('Y-m-d H:i:s', strtotime($dataArr['date_from']));
            $dataArr['date_to'] = date('Y-m-d H:i:s', strtotime($dataArr['date_to']));        
        }else{
            $dataArr['date_from'] = $dataArr['date_to'] = null;
        }
        Customer::create($dataArr);   
        return json_encode(['success' => 1]);     
    }

}
