<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <title>Payment Declined</title>

</head>

<style>
    table tr:first-child>td>center {

        /*background: #ff0000;*/

    }

</style>

<body>



    <table style="background:#fff; border:#000000 1px solid;" width="622" cellspacing="0" cellpadding="0" border="0"
        align="center">

        <tbody>

            <tr class="first">

                <td>

                    <center>

                        <img src="{{asset('images/logo.png')}}" style="padding: 15px;">

                    </center>

                </td>

            </tr>

            <tr>

                <td height="1"></td>

            </tr>

            <tr>

                <td style="font-family:Arial, Helvetica, sans-serif;" bgcolor="#f5f9f6">

                    <table width="622" cellspacing="0" cellpadding="0" border="0" align="center">

                        <tbody>

                            <tr>

                                <td style="padding:8px 15px;">
                                    <p><strong>Dear {{$orders->fname}} {{$orders->lname}}</strong></p>
                                </td>

                            </tr>

                            <tr>

                                <td style="font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;">

                                
                                    <strong>
<h1>Payment Declined</h1>
<h3>Order # {{$orders->id}} </h3>

                                <p>Unfortunately, the payment for this order has failed.</p>

                                </strong>
                                       

                                </td>

                            </tr>

                        

                        



                            
                            




                            <tr>

                                <td
                                    style="font-size:16px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;">

                                    To make sure our emails reach your inbox, please add <a
                                        href="mailto:{{$config['EXTERNALEMAIL']}}">{{$config['EXTERNALEMAIL']}}</a> to
                                    your safe

                                    list or address book.<br>

                                    <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </td>

            </tr>

        </tbody>

    </table>

</body>

</html>
