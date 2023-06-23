<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="{{asset('AdminAssets/logo/logo.png')}}"/>
    <link href="{{asset('AdminAssets/assets/css/loader.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }
        .task-info {
            margin-bottom: 20px;
        }
        .task-info strong {
            font-weight: bold;
        }
        .status-label {
            display: inline-block;
            padding: 8px 16px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .phase-label {
            background-color: #6c757d;
            color: #ffffff;
        }
        .payment-status-label {
            background-color: teal;
            color: #ffffff;
        }
        .additional-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .progress-link-container {
            margin-bottom: 20px;
        }
        .progress-link {
            display: flex;
            align-items: center;
        }
        #progress-link {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        #copy-button {
            background-color: #1b2e4b;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        #copy-button:hover {
            background-color: #0056b3;
        }
    </style>
    <title>{{$task->title}} Details</title>
</head>
<body>
<div class="container">
    <h1>Order Details</h1>
    <div class="task-info">
        <p><strong>Order Name :</strong> {{$task->title}}</p>
        <p><strong>Client Name :</strong> {{$task->client->name}}</p>
        <p><strong>Client Phone :</strong> {{$task->client->phone}}</p>
        <div class="progress-link-container mb-3 d-flex align-items-center">
            <strong>Link to Track Progress :</strong>
            <div class="progress-link">
                <a href="{{ route('task.client.preview', $task->uuid) }}" target="_blank" id="progress-link"></a>
                <button id="copy-button" onclick="copyLink()">Copy</button>
            </div>
        </div>
    </div>
    <div class="status-label phase-label">
        <h2>Phase</h2>
        <p> {{$task->phase->name}}</p>
    </div>
    <div class="status-label payment-status-label">
        <h2>Payment Status</h2>
        <p> {{$task->payment_status}}</p>
    </div>
    <div class="additional-details">
        <h2>Additional Details</h2>
        <p>{{$task->description}}</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function copyLink() {
        var linkElement = document.getElementById('progress-link');
        var linkText = linkElement.href;

        var tempInput = document.createElement('input');
        tempInput.setAttribute('value', linkText);
        document.body.appendChild(tempInput);

        tempInput.select();
        tempInput.setSelectionRange(0, 99999);

        document.execCommand('copy');
        document.body.removeChild(tempInput);

        alert('Link copied to clipboard');
    }
</script>

</body>
</html>


