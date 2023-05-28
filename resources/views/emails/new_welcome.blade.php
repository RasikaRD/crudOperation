<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Email</title>
</head>

<body style="
    background: #FFFFFF;">

    <div align="center"
        style="
        width: 840px; 
        height: 350px; 
        background: #232323;
        margin-left:100px;
        margin-right:100px">

    </div>
    <div
        style="
        width: 580px;
        height: 480px;
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #232323;
        margin-left:230px;
        margin-right:230px;
        margin-top:61px;
        ">
              <p> Dear {{ $user->name }},</p>
              <p>We are delighted to welcome you to and thank you for choosing us as your shopping destination.
                  Our team is committed to providing you with a wide range of high-quality products, including and exceptional customer service to ensure your shopping experience is
                  enjoyable and hassle-free.
              </p>
 
              <p> Thank you again for choosing. We look forward to serving you soon.
              </p>
              <p>
                  Best regards,<Br>
                  TODO App
              </p>
      
    </div>
    <div align="center"
        style="
        width: 840px;
        height: 120px;
        left: 300px;
        top: 904px;
        margin-left:100px;
        margin-right:100px;
        background: #232323;">
    </div>
</body>

</html>
