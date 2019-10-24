<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;

class GeneralInfoController extends Controller
{
    public function generalInfo(Request $request)
    {
        $name = $request->input('name');
        $companyName = $request->input('companyName');
        $email = $request->input('email');
        $contact = $request->input('contact');
        $address = $request->input('address');
        $city = $request->input('city');
        $message = $request->input('message');

        $from=$email;
        $siteData = DB::table('settings')->where('id', 1)->first();
        $to = $siteData->siteemail;
        $subject="General Information Request";
        $message=  
            '<table style="background:#e5e5e5;">
                <tr>
                    <td style="width:100px;">&nbsp;</td>
                    <td style="width:1000px;">
                        <table style="font-family: Verdana, Geneva, sans-serif; background:#fff; font-size:14px; width:920px;">
                            <tr>
                                <td colspan="2">
                                    <p style="background:#1b998b; color:#ffffff; font-size:40px; line-height:50px; padding:20px;">Customer Information Request </p>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Message:</b><br>'.$message.'</p>
                                </td>
                            </tr>
                            <tr>
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
                                    <p style="padding:0 20px;"><b>Company Name: </b>'.$companyName.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Contact: </b>'.$contact.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Address: </b>'.$address.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>City: </b>'.$city.'</p>
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
            Alert::success('Your Request Has Been Submitted', 'Success!');
            return redirect('/request');
        }else{
            Alert::error('Something Went Wrong', 'Error!');
            return redirect('/request');
        }
    }
}