<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录验证码</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #4361ee;
            margin: 20px 0;
            padding: 10px 20px;
            background: #f5f7ff;
            display: inline-block;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>您的登录验证码</h2>
    <p>您好！</p>
    <p>您正在尝试登录，以下是您的验证码：</p>
    <div class="code">{{ $code }}</div>
    <p>该验证码15分钟内有效，请勿泄露给他人。</p>
    <p>如非本人操作，请忽略此邮件。</p>
    <div class="footer">
        <p>此邮件由系统自动发送，请勿直接回复。</p>
    </div>
</div>
</body>
</html>
