<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - {{ $qrData['book_title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .qr-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        
        .book-info {
            margin-bottom: 30px;
        }
        
        .book-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .book-author {
            font-size: 20px;
            color: #666;
            margin-bottom: 20px;
        }
        
        .qr-code {
            margin: 30px 0;
        }
        
        .qr-code img {
            width: 300px;
            height: 300px;
            border: 3px solid #f0f0f0;
            border-radius: 15px;
            padding: 15px;
            background: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .instructions {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        
        .url-info {
            margin: 20px 0;
            font-size: 14px;
            color: #666;
        }
        
        .url {
            font-family: monospace;
            background: #f0f0f0;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            margin: 10px 0;
            word-break: break-all;
        }
        
        .qr-code-text {
            font-family: monospace;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            background: #667eea;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        
        .status-pending {
            background: #e9ecef;
            color: #6c757d;
        }
        
        .status-distributed {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-registered {
            background: #d1edff;
            color: #0c5460;
        }
        
        @media (max-width: 768px) {
            .qr-container {
                margin: 10px;
                padding: 20px;
            }
            
            .book-title {
                font-size: 24px;
            }
            
            .qr-code img {
                width: 250px;
                height: 250px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <div class="status-badge status-{{ $distribution->status }}">
            {{ ucfirst($distribution->status) }}
        </div>
        
        <div class="book-info">
            <div class="book-title">{{ $qrData['book_title'] }}</div>
            <div class="book-author">by {{ $qrData['book_author'] }}</div>
        </div>
        
        <div class="qr-code">
            <img src="{{ $qrData['qr_image'] }}" alt="QR Code for {{ $qrData['book_title'] }}">
        </div>
        
        <div class="instructions">
            <strong>📱 Scan this QR code to join our community and share your thoughts about this book!</strong>
        </div>
        
        <div class="url-info">
            Or visit directly:<br>
            <div class="url">{{ $qrData['url'] }}</div>
        </div>
        
        <div class="qr-code-text">
            QR Code: {{ $qrData['qr_code'] }}
        </div>
        
        <div class="actions">
            <a href="{{ route('qr.print', $distribution->qr_code) }}" class="btn" target="_blank">
                🖨️ Print QR Code
            </a>
            <a href="{{ route('community.join', $distribution->qr_code) }}" class="btn btn-secondary" target="_blank">
                🔗 Open Registration Page
            </a>
        </div>
    </div>
</body>
</html>