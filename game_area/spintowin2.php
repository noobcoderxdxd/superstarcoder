<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spin to Win Wheel</title>
    <style>
        /* Your CSS styles here */
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            outline: none;
        }
        
        body {
            font-family: "Open Sans";
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background: rgb(60, 60, 242);
            background: linear-gradient(90deg, rgba(60, 60, 242, 1) 0%, rgba(98, 245, 230, 1) 52%, rgba(60, 60, 242, 1) 100%);
            background-size: cover;
        }
        
        .mainbox {
            position: relative;
            width: 500px;
            height: 500px;
        }
        
        .mainbox:after {
            position: absolute;
            content: '';
            width: 32px;
            height: 32px;
            background: url('arrow-left.png') no-repeat;
            background-size: 32px;
            right: -30px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .box {
            width: 100%;
            height: 100%;
            position: relative;
            font-weight: bold;
            border-radius: 50%;
            border: 10px solid #fff;
            overflow: hidden;
            transition: all ease 5s;
        }
        
        span {
            width: 50%;
            height: 50%;
            display: inline-block;
            position: absolute;
        }
        
        .span1 {
            clip-path: polygon(0 92%, 100% 50%, 0 8%);
            background-color: #fffb00;
            top: 120px;
            left: 0;
        }
        
        .span2 {
            clip-path: polygon(100% 92%, 0 50%, 100% 8%);
            background-color: #ff4fa1;
            top: 120px;
            right: 0;
        }
        
        .span3 {
            clip-path: polygon(50% 0%, 8% 100%, 92% 100%);
            background-color: #ffaa00;
            bottom: 0;
            left: 120px;
        }
        
        .span4 {
            clip-path: polygon(50% 100%, 92% 0, 8% 0);
            background-color: #22ff00;
            top: 0;
            left: 120px;
        }
        
        .box1 .span3 b {
            transform: translate(-50%, -50%) rotate(-270deg);
        }
        
        .box1 .span1 b,
        .box2 .span1 b {
            transform: translate(-50%, -50%) rotate(185deg);
        }
        
        .box2 .span3 b {
            transform: translate(-50%, -50%) rotate(90deg);
        }
        
        .box1 .span4 b,
        .box2 .span4 b {
            transform: translate(-50%, -50%) rotate(-85deg);
        }
        
        span b {
            font-size: 24px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .box2 {
            width: 100%;
            height: 100%;
            transform: rotate(-135deg);
        }
        
        .spin {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 4px solid #fff;
            background-color: #001aff;
            color: #fff;
            box-shadow: 0 5px 20px #000;
            font-weight: bold;
            font-size: 22px;
            cursor: pointer;
        }
        
        .spin:active {
            width: 70px;
            height: 70px;
            font-size: 20px;
        }
        
        .mainbox.animate:after {
            animation: animateArrow 0.7s ease infinite;
        }
        
        @keyframes animateArrow {
            50% {
                right: -40px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
</head>
<body>
    <div id="mainbox" class="mainbox">
        <div id="result" class="result-container result-bottom"></div>
        <div id="box" class="box">
            <div class="box1">
                <span class="span1"><b>Segment1</b></span>
                <span class="span2"><b>Segment2</b></span>
                <span class="span3"><b>Segment3</b></span>
                <span class="span4"><b>Segment4</b></span>
            </div>
            <div class="box2">
                <span class="span1"><b>Segment5</b></span>
                <span class="span2"><b>Segment6</b></span>
                <span class="span3"><b>Segment7</b></span>
                <span class="span4"><b>Segment8</b></span>
            </div>
        </div>
        <button id="claimButton" class="claim-button" style="display: none;" onclick="claimFreeShipping()">Claim Free Shipping</button>
        <button class="spin" onclick="rotateFunction()">SPIN</button>
    </div>

    <script>
        function rotateFunction() {
            var min = 1024;
            var max = 9999;
            var deg = Math.floor(Math.random() * (max - min)) + min;
            document.getElementById('box').style.transform = "rotate(" + deg + "deg)";
        }
        var element = document.getElementById('mainbox');
        element.classList.remove('animate');
        setTimeout(function () {
            element.classList.add('animate');
        }, 5000);

        const wheel = document.querySelector('.mainbox .box');
        const claimBtn = document.getElementById('claimButton');
        let deg = 0;

        function spinWheel() {
            const spinBtn = document.querySelector('.mainbox .spin');
            spinBtn.style.pointerEvents = 'none';
            deg = Math.floor(5000 + Math.random() * 5000);
            wheel.style.transition = 'all 10s ease-out';
            wheel.style.transform = `rotate(${deg}deg)`;
            wheel.classList.add('blur');
        }

        wheel.addEventListener('transitionend', () => {
    wheel.classList.remove('blur');
    const winningSegment = Math.floor((deg % 360) / 45) + 1;

    // Generate a random number between 1 and 10
    const randomNum = Math.floor(Math.random() * 10) + 1;

    // Adjust the winning chance
    if (randomNum <= 3) { // 30% chance of winning
        if (winningSegment === 1 || winningSegment === 8) {
            claimBtn.style.display = 'block';
            alert('Congratulations! You won Free Shipping. Click "Claim Prize" to get your reward!');
        } else {
            claimBtn.style.display = 'none';
            alert('Better luck next time!');
        }
    } else { // 70% chance of losing
        claimBtn.style.display = 'none';
        alert('Better luck next time!');
    }
});

        function claimFreeShipping() {
            const uniqueCode = generateUniqueCode();
            alert(`Your unique code for claiming the prize is: ${uniqueCode}`);
        }

        function generateUniqueCode() {
            return Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
        }
    </script>
</body>
</html>
