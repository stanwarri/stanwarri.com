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
            background: #fff;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
        }

        .qr-cell {
            width: 0.72in;
            text-align: center;
            vertical-align: middle;
            padding: 4px;
        }

        .text-cell {
            width: 0.85in;
            vertical-align: middle;
            padding: 4px 6px;
        }

        .qr-wrapper {
            text-align: center;
        }

        .qr-frame {
            background: #000;
            border-radius: 8px;
            padding: 3px;
            display: inline-block;
            margin-bottom: 2px;
        }

        .qr-code {
            width: 0.6in;
            height: 0.6in;
            display: block;
        }

        .scan-text {
            color: #000;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 1px;
            text-align: center;
            margin-top: 2px;
        }

        .message {
            color: #000;
            font-size: 8.9375px;
            line-height: 1.1;
            font-weight: 500;
            text-align: center;
            word-wrap: break-word;
            margin-bottom: 6px;
        }

        .signature {
            color: #000;
            font-size: 10.725px;
            font-weight: bold;
            font-family: Georgia, serif;
            text-align: center;
            margin-bottom: 2px;
        }

        .date {
            color: #666;
            font-size: 5.3625px;
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
