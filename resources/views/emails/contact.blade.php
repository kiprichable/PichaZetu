 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
        <!-- NOTE: external links are for testing only -->
        <link href="//cdn.muicss.com/mui-0.1.2/email/mui-email-styletag.css" rel="stylesheet" />
        <link href="//cdn.muicss.com/mui-0.1.2/email/mui-email-inline.css" rel="stylesheet" />
    </head>
    <body>
    <table class="mui-body" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td  style="padding:50px;" class="mui-panel">
                <center>

                    <!--[if mso]><table><tr><td class="mui-container-fixed"><![endif]-->
                    <div style="text-align:center;" class="mui-container">
                        <!--

                        email goes here

                        -->
                        <div class="mui-divider-bottom">
                            <img style="width:300px" src="{{URL::Asset('images/feedback.jpeg')}}">
                            <h3 style="margin-top: -5px!important; margin-bottom: 16px!important; color:
                            grey!important;">{!! $title !!}</h3>
                            <div class="mui-divider-bottom"></div>

                            <p style="padding:20px; text-align:left;"><br><br>
                            {!! $content !!}
                            </p>
                            <a class="mui-btn mui-btn-primary mui-btn-lg">Review Message</a>
                            <br><br>
                        </div>

                    </div>
                    <!--[if mso]></td></tr></table><![endif]-->
                </center>
            </td>
        </tr>
    </table>
    </body>
    </html>
