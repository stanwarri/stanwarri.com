<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: 1.57in 1.18in;
            margin: 0;
            padding: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #000;
            width: 1.57in;
            height: 1.18in;
        }

        .container {
            width: 1.57in;
            height: 1.18in;
            display: table;
        }

        .vertical-center {
            display: table-cell;
            vertical-align: middle;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse; /* keep it tight */
            table-layout: fixed;
            page-break-inside: avoid;
        }

        /* 1:3 ratio */
        .qr-cell {
            width: 25%;
            text-align: center;
            vertical-align: middle;
            padding: 2px 2px; /* minimal so the QR fits */
        }

        .text-cell {
            width: 75%;
            text-align: center;
            vertical-align: middle;
            padding: 2px 6px 2px 8px; /* left pad = spacing between QR and text */
        }

        .qr-wrapper {
            text-align: center;
        }

        .qr-frame {
            background: #000;
            border-radius: 6px;
            padding: 1px;              /* tiny frame so it doesn’t steal width */
            display: block;            /* take full line */
            width: 100%;               /* match cell content width */
            box-sizing: border-box;    /* include padding in width */
            margin: 0 auto 4px auto;   /* space below for SCAN */
        }

        .qr-code {
            display: block;
            width: 100%;   /* scale to available width; prevents clipping */
            height: auto;  /* preserve square aspect from source */
        }

        .scan-text {
            color: #000;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 1px;
            text-align: center;
            display: block;
            margin-top: 0;
        }

        .message {
            color: #000;
            font-size: 9px;
            line-height: 1.2;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .signature {
            color: #000;
            font-size: 11px;
            font-weight: bold;
            font-family: Georgia, serif;
            margin-bottom: 2px;
        }

        .date {
            color: #666;
            font-size: 5.3px;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="vertical-center">
        <table class="main-table">
            <tr>
                <td class="qr-cell">
                    <div class="qr-wrapper">
                        <div class="qr-frame">
                            <img src="{{ $printData['qr_image'] }}" alt="QR Code" class="qr-code">
                        </div>
                        <div class="scan-text">SCAN</div>
                    </div>
                </td>
                <td class="text-cell">
                    <div class="message">
                        {{ $inspirationalMessage }}
                    </div>
                    <div class="signature">
                        {{ $signature }}
                    </div>
                    <div class="date">
                        {{ $generatedDate }}
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
