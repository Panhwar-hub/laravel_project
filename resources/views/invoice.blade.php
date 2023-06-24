<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Payment Confirmation</title>
</head>
<style>
    table tr:first-child>td>center {
        /*background: #ff0000;*/
    }
</style>
<body>
    <table style="border:#000000 1px solid;" width="622" cellspacing="0" cellpadding="0" border="0"
        align="center">
        <tbody>
            <tr class="first">
                <td>
                    <center>
                        <img src="{{asset($logo->img_path)}}" style="padding: 15px;">
                    </center>
                </td>
            </tr>
            <tr>
                <td height="1"></td>
            </tr>
            <tr>
                <td style="font-family:Arial, Helvetica, sans-serif;">
                    <table width="622" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="padding:8px 15px;">
                                    <p><strong>Payment Successfuly </strong></p>
                                </td>
                            </tr>
                            <tr style="margin:20px 0; float:left;">
                                <td width="622">
                            
                           
                                    <table style="margin-top:20px;" width="580" cellspacing="0" cellpadding="0" border="0" align="center">
                                        <tbody style="font-size: 20px;">
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Name</td>
                                                    <td>{{$data['name']}}</td>
                                                </tr>
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Price</td>
                                                    <td>{{$data['amount']}}</td>
                                                </tr>
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Status</td>
                                                    <td>{{$data['status']}}</td>
                                                </tr>

                                            </tr>
                                        </tbody>
                                    </table>
                        
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