<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Booking;
use Alert;
use App\Room;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        /*$numberOfRoom = $request->input('roomNumber');*/
        $numberOfChildren = $request->input('children');
        $numberOfAdults = $request->input('adults');
        $rooms = DB::table('tbl_rooms')->where('display', 1)->get();

        return view('booking', compact('checkInDate', 'checkOutDate', 'numberOfChildren','numberOfAdults', 'rooms'));
    }

    public function directBook(Request $request)
    {
       if($request->isMethod('post')){
           $data = $request->all();
           echo "<pre>"; print_r($data); die;
       }
        $rooms = Room::where('display', 1)->get();
        return view('directbook')->with('rooms', $rooms);
    }


    public function bookinginfo(Request $request)
    {       
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $numberOfAdults = $request->input('numberOfAdults');
        /*$numberOfRoom = $request->input('roomNumber');*/
        $numberOfChildren = $request->input('numberOfChildren');
        $price = $request->input('price');
        
        $roomId = $request->input('roomId');
        $room = DB::table('tbl_rooms')->where('id', $roomId)->first();

        return view('infobook', compact('checkInDate', 'checkOutDate','numberOfAdults','numberOfChildren', 'price', 'room'));
    }

    public function bookinginfoDirect(Request $request)
    {
        $roomId = Crypt::decrypt($request->input('roomId'));
        $room = DB::table('tbl_rooms')->where('id', $roomId)->first();

        return view('infobook', compact('room'));
    }


    public function confirmBook(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        /*$numberOfRoom = $request->input('roomNumber');*/
        $numberOfAdults = $request->input('numberOfAdults');
        //$numberOfAdults = $request->input('numberOfAdults');
        $numberOfChildren = $request->input('numberOfChildren');

        $roomId = $request->input('roomId');
        $room = DB::table('tbl_rooms')->where('id', $roomId)->first();

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $name = $firstName . " " . $lastName;
        $email = $request->input('email');
        $contact = $request->input('contact');
        $city = $request->input('city');
        $price = $request->input('price');
        $country = $request->input('country');
        $dateOfFlight = $request->input('dateOfFlight');
        $flightNumber = $request->input('flightNumber');
        return view('confirm', compact('checkInDate', 'price', 'checkOutDate', 'room', 'name', 'email', 'contact', 'city', 'country','numberOfAdults','numberOfChildren', 'dateOfFlight', 'flightNumber'));
    }

    public function finalizeBook(Request $request){
     
            $data = $request->all();
            $book = new Booking;

            $book->room_id = $data['roomId'];

            $roomId = $data['roomId'];
            $room = DB::table('tbl_rooms')->where('id', $roomId)->first();

            $book->check_in_date = $data['checkInDate'];
            $book->check_out_date = $data['checkOutDate'];
            /*$book->no_of_room = $data['roomNumber'];*/
            $book->total_price = $data['totalPrice'];
            $book->customer_name= $data['customerName'];
            $book->email = $data['email'];
            $book->contact = $data['contact'];
            $book->city = $data['city'];
            $book->country = $data['country'];
            $book->card_name = 'Unavailable';
            $book->card_number = 'Unavailable';
            if(empty($data['dateOfFlight'])){
                $flightdate = 'Unavailable';
            }else{
                $flightdate = $data['dateOfFlight'];
            }
            if(empty($data['flightNumber'])){
                $flightno = 'Unavailable';
            }else{
                $flightno = $data['flightNumber'];
            }
            $book->status = 1;
            $book->flightdate = $flightdate;
            $book->flightnumber = $flightno;
            $book->save();

            $name = $data['customerName'];
            $check_in_date = $data['checkInDate'];
            $check_out_date = $data['checkOutDate'];
            $contact = $data['contact'];
            $city = $data['city'];
            $card_name = 'Unavailable';
            $card_number = 'Unavailable';
            $country = $data['country'];
            $email = $data['email'];
            $price = $data['totalPrice'];

            //return view('thankyou')->with('name', $name)->with('check_in_date', $check_in_date)->with('check_out_date', $check_out_date)->with('country', $country)->with('email', $email);
            //return redirect('/thankyou')->with('message_success', 'Booking Confirmed!');

            //Alert::success('Your Booking Has Been Confirmed', 'Success!');
            //return redirect('/thankyou');

                $siteData = DB::table('settings')->where('id', 1)->first();
                $to = $siteData->siteemail;
                $from = $email;
                $subject="Booking Information";
                $message=  
                '<table style="background:#e5e5e5;">
                <tr>
                    <td style="width:100px;">&nbsp;</td>
                    <td style="width:1000px;">
                        <table style="font-family: Verdana, Geneva, sans-serif; background:#fff; font-size:14px; width:920px;">
                            <tr>
                                <td colspan="2">
                                    <p style="background:#1b998b; color:#ffffff; font-size:40px; line-height:50px; padding:20px;">Room Booking </p>
        
                                    <p style="padding:0 20px; font-size:20px;"><b>Reservation Details</b></p>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b> '.$room->title.'</b></p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Rs. '.$price.'</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Check In Date</b> '.date("F j, Y", strtotime($check_in_date)).'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Check Out Date</b> '.date("F j, Y", strtotime($check_out_date)).'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="padding:0 20px; font-size:20px;"><b>Customer Details</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Name: </b>'.$name.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Email: </b>'.$email.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Contact: </b>'.$contact.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>City: </b>'.$city.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Country: </b>'.$country.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="padding:0 20px; font-size:20px;"><b>Flight Details</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Flight Date: </b>'. $flightdate.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Flight Number: </b>'. $flightno.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="padding:0 20px; font-size:20px;"><b>Card Details</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Card Name: </b>'.$card_name.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Card Number: </b>'.$card_number.'</p>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                    <small style="padding:0 20px;">PLEASE DO NOT REPLY TO THIS EMAIL</small><br><br>
                                    <small style="padding:0 20px;">This is an auto-generated email, replies to this email are not responded.</small><br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:100px;">&nbsp;</td>
                </tr>
            </table>';

            // echo $message;exit('test');
            $headers = "From: " . $from. " \r\n";
            $headers .= "Reply-To: noreply@hotelmadeninn.com\r\n";
            $headers .= "Return-Path: noreply@hotelmadeninn.com\r\n";
            $headers .= "CC:noreply@hotelmadeninn.com\r\n";
            $headers .= "BCC: noreply@hotelmadeninn.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $mailed=mail($to,$subject,$message,$headers);

            if($mailed){
                Alert::success('Your Booking Has Been Confirmed', 'Success!');
                return redirect('/thankyou');
            }else{
                return redirect('/');
            }
        
            //Alert::success('Your Booking Has Been Confirmed', 'Success!');
            //return redirect('/thankyou');
    }

    public function thanks(){

        return view('thankyou');
    }
}
