<?php 

    $from=$email;
    $to='';
    $subject="Room Booking";
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
                                <p style="padding:0 20px;"><b>Rs. '.$room->price.'</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding:0 20px;"><b>Check In Date</b> '.date("F j, Y", strtotime($checkInDate)).'</p>
                            </td>
                            <td>
                                <p style="padding:0 20px;"><b>'.$numberOfRoom.' Rooms</b></p>
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
                                <p style="padding:0 20px;"><b>Name: </b>'.$customerName.'</p>
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
                                <p style="padding:0 20px; font-size:20px;"><b>Card Details</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding:0 20px;"><b>Card Name: </b>'.$cardName.'</p>
                            </td>
                            <td>
                                <p style="padding:0 20px;"><b>Card Number: </b>'.$cardNumber.'</p>
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

        echo $message;exit('test');
        $headers = "From: " . $from. " \r\n";
        $headers .= "Reply-To: noreply@hotelmadeninn.com\r\n";
        $headers .= "Return-Path: noreply@hotelmadeninn.com\r\n";
        $headers .= "CC:noreply@hotelmadeninn.com\r\n";
        $headers .= "BCC: noreply@hotelmadeninn.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // echo $message;exit('test');
        $mailed=mail($to,$subject,$message,$headers);

    // header('Location: '.route('rooms'));
    // return redirect('/');
    if($mailed){
    }

?>