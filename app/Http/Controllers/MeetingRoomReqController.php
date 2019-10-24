<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;

class MeetingRoomReqController extends Controller
{
    public function meetingRoomReq(Request $request)
    {
        $event = $request->input('event');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $guestExpected = $request->input('guestExpected');
        $address = $request->input('address');
        $numberOfRoom = $request->input('numberOfRoom');
        $cater = $request->input('cater');
        $audioVisual = '';
        if(@$request->input('audioVisuals')){
            $audioVisuals = $request->input('audioVisuals');
            foreach($audioVisuals as $data){
                $audioVisual .= $data . ', ';
            }
        }
        $message = $request->input('message');

        // $from=$email;

        $siteData = DB::table('settings')->where('id', 1)->first();
        $to = $siteData->siteemail;
        $subject="MeetingRoom Request";
        $message=  
            '<table style="background:#e5e5e5;">
                <tr>
                    <td style="width:100px;">&nbsp;</td>
                    <td style="width:1000px;">
                        <table style="font-family: Verdana, Geneva, sans-serif; background:#fff; font-size:14px; width:920px;">
                            <tr>
                                <td colspan="2">
                                    <p style="background:#1b998b; color:#ffffff; font-size:40px; line-height:50px; padding:20px;">Meeting Room Request </p>
                                    
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
                                    <p style="padding:0 20px; font-size:20px;"><b>Request Information</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Event Start Date: </b>'.$startDate.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Event End Date: </b>'.$endDate.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Type of Event: </b>'.$event.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;"><b>Expected No. of Guests: </b>'.$guestExpected.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;"><b>Rooms Required: </b>'.$numberOfRoom.'</p>
                                </td>
                                <td>
                                    <p style="padding:0 20px;">
                                        <b>Catering Required: </b>'.$cater.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding:0 20px;">
                                        <b>Audio/visuals: </b>'.$audioVisual.'</p>
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
            // $headers = "From: " . $from. " \r\n";
            $headers = "Reply-To: noreply@hotelmadeninn.com\r\n";
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
