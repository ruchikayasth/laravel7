<?php

namespace App\Http\Controllers;

use Validator;
use Response;
use Redirect;
use App\{Country, State, City};
use Illuminate\Http\Request;
use PDF;

class RegistrationControll extends Controller
{
    public function index()
    {
         $details = [
            'title' => 'Mail from Ruchi kayasth',
            'body' => 'You Logged In Successfully..!'
        ];
       
        \Mail::to('ruchikayasth143@gmail.com')
            ->send(new \App\Mail\MyTestMail($details));

        die('test');
        $data['countries'] = Country::get(["name", "id"]);
        return view('registration', $data);
    }
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function create(Request $request){

        
        
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:10',
            'gender' => 'required',
            'date' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile,
            'gender' => $request->gender,
            'registration_date' => $request->date,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
        ];
        $Add = \DB::table('register')->insert($data);       
        
        $countries = \DB::table('countries')->where('id',$request->country)->first();
        $countriesName = $countries->name;

        $city = \DB::table('cities')->where('id',$request->country)->first();
        $cityName = $city->name;

        $states = \DB::table('states')->where('id',$request->city)->first();
        $statesName = $states->name;

        
        $register = \DB::table('register')
        // ->leftjoin('countries', 'register.country', '=', 'countries.id')
        // ->leftjoin('cities', 'register.city', '=', 'cities.id')
        // ->leftjoin('states', 'register.state', '=', 'states.id')
        // ->select('register.*','cities.*')
        ->get();
        
        return view('showData',compact('register'));
        }
        
        public function delete($id){
            $del = \DB::table('register')->where('id', '=', $id)->delete();
            return redirect('/');
        }

        public function generatePDF()
        {
            $data = ['title' => 'Welcome to HDTuto.com'];
            $pdf = PDF::loadView('myPDF',$data);    
            return $pdf->download('test.pdf');
        }

        public function pdfview(Request $request)
        {
            $items = \DB::table("register")->get();
            view()->share('items',$items);
            if($request->has('download')){
                $pdf = PDF::loadView('pdfview');
                return $pdf->download('pdfview.pdf');
            }
            return view('pdfview');
        }
}
