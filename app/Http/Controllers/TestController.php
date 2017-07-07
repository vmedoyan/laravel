<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // Export excel 
    // Git Bash  composer require maatwebsite/excel: "~2.1.0"
    //Upload Image
    //Git Bash   composer require intervention/image

    //enctype="multipart/form-data"

    $avatar = $request->file('image');
    $filename = time() . '.' . $avatar->getClientOriginalExtension();
    Image::make($avatar)->resize(300, 200)->save( public_path('image/uploads/' . $filename)); 


    foreach(Request::file('client_file') as $key => $value){
        $filename = time(). '_' . $key . '.' . Request::file('client_file')[$key]->getClientOriginalExtension();
        Request::file('client_file')[$key]->move(public_path('../storage/client/'), $filename);
        
        $file = new FileArchive;
            $file->customer_id = Request::input('id');
            $file->complex_id = Request::input('complex_id');
            $file->file_name = $filename;
        $file->save();
    }


    Excel::create('Clients', function($excel) use($customer) {
        
        $excel->setTitle('Clients');
                          
        $excel->sheet('Clients', function($sheet) use($customer) {
             
            $sheet->setCellValue('A' . 1, 'Բն. №');
            $sheet->setCellValue('B' . 1, 'Գնորդ');
            $sheet->setCellValue('C' . 1, 'Ամսեվճար');
            $sheet->setCellValue('D' . 1, 'Բնակարանի արժեք');
            $sheet->setCellValue('E' . 1, 'Կանխավճար');
            $sheet->setCellValue('F' . 1, 'Մնացորդ');
            $row = 2;
            foreach($customer as  $cst){
                $sheet->setCellValue('A' . $row, $cst->number);
                $sheet->setCellValue('B' . $row, $cst->name);
                $sheet->setCellValue('C' . $row, $cst->tenancy->month_fee);
                $sheet->setCellValue('D' . $row, $cst->value);
                $sheet->setCellValue('E' . $row, $cst->advance);
                $sheet->setCellValue('F' . $row, ($cst->value) - ($cst->advance));                      
                $row ++;
            }
            
        });

    })->export('xlsx');


    public function addCarPost()
    {
        $rules = array(
            'plate_number' => 'required',
            'hwid' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('car/add')
                ->withErrors($validator)->withInput();
        }
        $car = Car::create(Request::all());
        $car->save();
        return redirect('/cars')
            ->with('message', 'Մուտքագրումը հաջողությամբ ավարտված է');
    }


    public function editCarPut()
    {

        $rules = array(
            'plate_number' => 'required',
            'hwid' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('car/edit/'.Request::input('id'))
                ->withErrors($validator)->withInput();
        }
        Car::find(Request::input('id'))->update(Request::all());
        return redirect('/cars')
            ->with('message', 'Խմբագրումը հաջողությամբ ավարտված է');
    }


}
