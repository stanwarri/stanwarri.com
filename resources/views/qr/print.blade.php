<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR Code - {{ $printData['book_title'] }}</title>
    <style>
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none; }
            .qr-container {
                width: 1.57in;
                height: 1.18in;
                border: none;
                padding: 0;
                margin: 0;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .qr-container {
            display: flex;
            align-items: center;
            border: 2px solid #333;
            padding: 8px;
            margin: 20px 0;
            background: white;
            width: 1.57in;
            height: 1.18in;
            box-sizing: border-box;
        }
        
        .qr-code {
            flex-shrink: 0;
            margin-right: 8px;
        }
        
        .qr-code img {
            width: 0.8in;
            height: 0.8in;
            display: block;
        }
        
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-size: 8px;
            line-height: 1.2;
        }
        
        .instructions {
            font-weight: bold;
            color: #333;
        }
        
        .book-info {
            margin: 20px 0;
            text-align: center;
        }
        
        .book-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .book-author {
            font-size: 18px;
            color: #666;
            margin: 10px 0;
        }
        
        .qr-code-text {
            font-family: monospace;
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
        
        .print-button {
            background: #007cba;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin: 20px 0;
        }
        
        .print-button:hover {
            background: #005a8a;
        }
        
        .preview-info {
            margin-bottom: 20px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <div class="preview-info">
            <strong>Print Preview:</strong> This will print at exactly 1.57" x 1.18" size
            <br><strong>Book:</strong> {{ $printData['book_title'] }} by {{ $printData['book_author'] }}
        </div>
        <button class="print-button" onclick="window.print()">🖨️ Print QR Code</button>
    </div>
    
    <div class="qr-container">
        <div class="qr-code">
            <img src="{{ $printData['qr_image'] }}" alt="QR Code">
        </div>
        
        <div class="content">
            <div class="instructions">
                Scan this QR code to join our community and share your thoughts about this book!
            </div>
        </div>
    </div>
    
    <div class="no-print">
        <p><strong>Instructions:</strong></p>
        <ol>
            <li>Click the print button above</li>
            <li>Cut out the QR code section</li>
            <li>Stick it inside or on the book</li>
            <li>Give the book to someone special!</li>
        </ol>
    </div>
</body>
</html>