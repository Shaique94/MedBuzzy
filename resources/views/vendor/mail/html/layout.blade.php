<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Medbuzzy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 20px 0;
        }
        .content {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .body {
            border: none !important;
            padding: 20px;
        }
        .inner-body {
            width: 100%;
            max-width: 560px;
            margin: 0 auto;
        }
        .content-cell {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
            color: #334155;
        }
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
                padding: 10px;
            }
        }
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {!! $header ?? '' !!}
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="content-cell">
                                        {!! Illuminate\Mail\Markdown::parse($slot) !!}
                                        {!! $subcopy ?? '' !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    {!! $footer ?? '' !!}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>