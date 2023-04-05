<!doctype html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Verify email address</title>
    <meta name="description" content="Reset Password Email Template.">
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <img src="cid:logo.png" style="width: 200px">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1
                                            style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                                            Notify account infomation</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            Thank you for choosing this boarding house to rent. This is an account so
                                            you can access the system to view your information.
                                        </p>

                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            Your account information is as follows:
                                        </p>

                                        <div style="border: 1px solid; margin-top: 20px">
                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                <b>Email:</b> {{ $email }}
                                            </p>

                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                <b>Password:</b> {{ $password }}
                                            </p>

                                            <div style="background: #9c9c9c;height: 1px"></div>
                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                <b>OR</b>
                                            </p>
                                            <div style="background: #9c9c9c;height: 1px"></div>

                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                <b>Phone number:</b> {{ $phone }}
                                            </p>

                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                <b>Password:</b> {{ $password }}
                                            </p>

                                        </div>

                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            Please change your password after logging in.
                                        </p>

                                        <a href="{{ $url }}" target="_blank"
                                            style="background:#00FF00; text-decoration:none !important; font-weight:bold; margin-top:20px; color:#000;font-size:18́px;padding:10px 24px;display:inline-block;border-radius:50px;">
                                            Access to the system
                                        </a>

                                        <p style="color:#455056; font-size:15px;line-height:24px; margin-top: 30px;">
                                            If you're having trouble clicking the "Access to the system" button, copy
                                            and
                                            paste the URL below into your web browser: <a href="{{ $url }}"
                                                target="_blank">{{ $url }}</a>
                                        </p>

                                    </td>


                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <strong>boarding-house-management-system</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
