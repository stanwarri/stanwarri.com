<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR Code - {{ $printData['book_title'] }}</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .qr-container {
            text-align: center;
            border: 2px solid #333;
            padding: 30px;
            margin: 20px 0;
            background: white;
        }
        
        .qr-code {
            margin: 20px 0;
        }
        
        .book-info {
            margin: 20px 0;
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
        
        .instructions {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
            line-height: 1.5;
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
    </style>
</head>
<body>
    <div class="no-print">
        <button class="print-button" onclick="window.print()">🖨️ Print QR Code</button>
    </div>
    
    <div class="qr-container">
        <div class="book-info">
            <div class="book-title">{{ $printData['book_title'] }}</div>
            <div class="book-author">by {{ $printData['book_author'] }}</div>
        </div>
        
        <div class="qr-code">
            <img src="{{ $printData['qr_image'] }}" alt="QR Code" style="max-width: 200px; height: auto;">
        </div>
        
        <div class="instructions">
            Scan this QR code to join our community and share your thoughts about this book!
            <br><br>
            Or visit: <strong>{{ $printData['url'] }}</strong>
        </div>
        
        <div class="qr-code-text">
            Code: {{ $printData['qr_code'] }}
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