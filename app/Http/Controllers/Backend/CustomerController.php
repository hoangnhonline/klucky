<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        
        return view('backend.customer.create');
    }
    public function store(Request $request)
    {
        $dataArr = $request->all();        
        $this->validate($request,[                                    
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'date_from' => 'required',          
            'date_to' => 'required',            
        ],
        [   
            'username.required' => 'Bạn chưa nhập tên đăng nhập',                                 
            'email.required' => 'Bạn chưa nhập số điện thoại',                                 
            'phone.required' => 'Bạn chưa nhập email',                                 
            'type.required' => 'Bạn chưa chọn cách quy đổi',                                 
            'date_from.required' => 'Bạn chưa nhập từ ngày',                                  
            'date_to.required' => 'Bạn chưa nhập đến ngày',                                 
            
        ]);   
        $dataArr['date_from'] = date('Y-m-d H:i:s', strtotime($dataArr['date_from']));
        $dataArr['date_to'] = date('Y-m-d H:i:s', strtotime($dataArr['date_to']));   
        Customer::create($dataArr);
      
        Session::flash('message', 'Tạo mới thành công');

        return redirect()->route('customer.index');
    }
    public function update(Request $request)
    {
        $dataArr = $request->all();
        $this->validate($request,[                                    
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'date_from' => 'required',          
            'date_to' => 'required',            
        ],
        [   
            'username.required' => 'Bạn chưa nhập tên đăng nhập',                                 
            'email.required' => 'Bạn chưa nhập số điện thoại',                                 
            'phone.required' => 'Bạn chưa nhập email',                                 
            'type.required' => 'Bạn chưa chọn cách quy đổi',                                 
            'date_from.required' => 'Bạn chưa nhập từ ngày',                                  
            'date_to.required' => 'Bạn chưa nhập đến ngày',                                 
            
        ]);   
        $dataArr['date_from'] = date('Y-m-d H:i:s', strtotime($dataArr['date_from']));
        $dataArr['date_to'] = date('Y-m-d H:i:s', strtotime($dataArr['date_to'])); 
        
        $model = Customer::find($dataArr['id']);

        $model->update($dataArr);
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
        $tagSelected = [];

        $detail = Customer::find($id);

        return view('backend.customer.edit', compact('detail'));
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
