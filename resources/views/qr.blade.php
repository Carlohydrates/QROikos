<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>QR System</title>
</head>
<body>
    <main>
        <div class="background-container">
            <div class="right-content">
                <div class="circle">
                </div>
                <div class="circles"></div>
                <div class="circles2"></div>
                <div class="circles3"></div>
                <div class="circles4"></div>
                <i class="fa-regular fa-clock"></i>
                <i class="fas fa-pencil-alt"></i>
            </div>
        </div>
        <div class="greeting-container">
            <header>
                <div style="width:50px;height:50px;border-radius:50%;background-color:#123664"></div>
                <h2>School Name</h2>
            </header>
            <div id="reader" style="width:700px" ></div>
            <div class="user-content">
                <h1></h1>
                <h3></h3>
                <h4 style="margin-left:.5rem;margin-top:3rem;font-size:1rem"></h4>
            </div>
        </div>
    </main>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const csrf=document.querySelector("meta[name='csrf-token']");
        var hasScanned=false;
        function handleSubmission(textData){
            fetch(`/check-in/${textData}`,{
                method:"GET",
                header:{
                    'Content-Type':'application/json',
                    'X-CSRF-Token':csrf.content,
                },
            })
            .then(response=>response.json())
            .then(data=>{
                if(data.success){
                    console.log(data.message);
                    const reader=document.getElementById('reader');
                    const userInfo=data.content;
                    const userContent=document.querySelector('.user-content');
                    reader.hidden=true;
                    userContent.querySelector('h1').textContent="Welcome Home";
                    userContent.querySelector('h3').textContent=userInfo.fname.toUpperCase() +" "+userInfo.lname.toUpperCase();
                    userContent.querySelector('h4').textContent=data.message;
                    return;
                }
            })
            .catch(error=>{
                console.log("Error logging in user ",error);
            })
            hasScanned=true;
        }
        function onScanSuccess(decodedText,decodeResult){
            if(!hasScanned){
                handleSubmission(decodedText);
            }
            else{
                return;
            }
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 5, qrbox: 250 }
        );
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>