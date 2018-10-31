<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\GiftCode;
use App\Models\CustomerCode;

use Helper, File, Session, Auth;
use Maatwebsite\Excel\Facades\Excel;
class CustomerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function updateStatus(Request $request)
    {               
        $model = Customer::find( $request->id );
        $model->status = 2;
        $model->save();
    }
    public function create(Request $request)    { 
        
        $codeList = GiftCode::where('status', 1)->get();
        return view('backend.customer.create', compact('codeList'));
    }
    public function store(Request $request)
    {
        $dataArr = $request->all();        
        $this->validate($request,[                                                
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',           
            'date_from' => 'required',          
            'date_to' => 'required',            
        ],
        [                        
            'date_from.required' => 'Bạn chưa nhập từ ngày',                                  
            'date_to.required' => 'Bạn chưa nhập đến ngày',                                 
            
        ]);   
        $dataArr['date_from'] = date('Y-m-d H:i:s', strtotime($dataArr['date_from']));
        $dataArr['date_to'] = date('Y-m-d H:i:s', strtotime($dataArr['date_to']));   
        $rs = Customer::create($dataArr);
        // xu ly tags
        if( !empty( $dataArr['so_may_man'] ) && $rs->id ){
            foreach ($dataArr['so_may_man'] as $code_id) {
                GiftCode::find($code_id)->update(['status' => 2]);
                $model = new CustomerCode;
                $model->customer_id = $rs->id;
                $model->code_id  = $code_id;
                $model->status = 1;
                $model->save();


            }
        }
        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('customer.index');
    }
    public function update(Request $request)
    {
        $dataArr = $request->all();
        $this->validate($request,[                                                
             'email' => 'required_without:phone',
            'phone' => 'required_without:email',              
            'date_from' => 'required',          
            'date_to' => 'required',            
        ],
        [                        
            'date_from.required' => 'Bạn chưa nhập từ ngày',                                  
            'date_to.required' => 'Bạn chưa nhập đến ngày',                                 
            
        ]);   
        $dataArr['date_from'] = date('Y-m-d H:i:s', strtotime($dataArr['date_from']));
        $dataArr['date_to'] = date('Y-m-d H:i:s', strtotime($dataArr['date_to'])); 
        
        $model = Customer::find($dataArr['id']);

        $model->update($dataArr);

        $selectedList = CustomerCode::where(['customer_id' => $dataArr['id']])->get();
        if($selectedList->count()> 0){
            foreach($selectedList as  $tmpa){
                GiftCode::find($tmpa->code_id)->update(['status'=>1]);
            }
        }
        CustomerCode::where(['customer_id' => $dataArr['id']])->delete();
        // xu ly tags
        if( !empty( $dataArr['so_may_man'] )){
            foreach ($dataArr['so_may_man'] as $code_id) {
                GiftCode::find($code_id)->update(['status' => 2]);
                $model = new CustomerCode;
                $model->customer_id = $dataArr['id'];
                $model->code_id  = $code_id;
                $model->status = 1;
                $model->save();
            }
        }
        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('customer.index');
    }
    public function index(Request $request)
    {
        $status = isset($request->status) ? $request->status : null;
        
        $email = isset($request->email) && $request->email != '' ? $request->email : '';
        $phone = isset($request->phone) && $request->phone != '' ? $request->phone : '';
        
        $query = Customer::whereRaw('1')->orderBy('id', 'DESC');

        if( $status > 0){
            $query->where('status', $status);
        }
        
        if( $email != ''){
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        if( $phone != ''){
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }
       
        $items = $query->orderBy('id', 'desc')->paginate(20);
        
        return view('backend.customer.index', compact( 'items', 'email', 'status', 'phone'));
    }    
    public function download()
    {
        $contents = [];
        $query = Customer::whereRaw('1')->orderBy('id', 'DESC')->get();
        $i = 0;
        foreach ($query as $data) {
            $i++;
            $contents[] = [
                'STT' => $i,
                'Email' => $data->email,
                'Ngày ĐK' => date('d-m-Y H:i', strtotime($data->created_at))
            ];
        }        
        
        Excel::create('customer_' . date('YmdHi'), function ($excel) use ($contents) {
            // Set sheets
            $excel->sheet('Email', function ($sheet) use ($contents) {
                $sheet->fromArray($contents, null, 'A1', false, false);
            });
        })->download('xls');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */    

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $codeSelected = [];

        $detail = Customer::find($id);
        $tmpArr = CustomerCode::where(['customer_id' => $id])->join('gift_code', 'gift_code.id', '=', 'customer_code.code_id')->join('gift', 'gift.id', '=', 'gift_code.gift_id')->get();
        if( $tmpArr->count() > 0 ){
            foreach ($tmpArr as $value) {
                $codeSelected[] = $value->code_id;
            }
        }

        $codeList = GiftCode::where('status', 1)->get();
        return view('backend.customer.edit', compact('detail', 'codeSelected', 'codeList', 'tmpArr'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
   

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Customer::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa customer thành công');
        return redirect()->route('customer.index');
    }
}
