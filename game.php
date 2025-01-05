<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Matching Game</title>
    <style>
       body {
            font-family: 'Arial', sans-serif;
            background-color: #ffeb3b; /* Bright background color */
            color: #333;
            text-align: center;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #4caf50;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow to the heading */
        }

        #game {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            max-width: 800px;
            margin: auto;
            padding: 10px;
            border: 2px solid #4caf50;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); /* Enhanced shadow for depth */
            transition: transform 0.3s; /* Smooth scaling on hover */
        }

        #game:hover {
            transform: scale(1.02); /* Slightly enlarge game area on hover */
        }

        .card {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #81c784, #66bb6a); /* Gradient background for cards */
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 3px solid #4caf50; /* Added border to the cards */
            border-radius: 10px;
            transition: transform 0.3s, background 0.3s; /* Transition for hover effects */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px); /* Lift card slightly on hover */
            background: linear-gradient(135deg, #66bb6a, #43a047); /* Change color on hover */
        }

        .flipped {
            background: #4caf50; /* Darker green when flipped */
            color: white;
            transform: scale(1.1); /* Slightly enlarge when flipped */
            transition: transform 0.3s; /* Smooth transition */
        }

        .matched {
            background: #ffc107; /* Yellow background for matched cards */
            color: white;
            animation: pulse 0.6s infinite; /* Add pulse animation */
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s;
            border-radius: 10px;
        }

        .flipped img {
            opacity: 1;
            transform: scale(1.1); /* Slightly enlarge image when flipped */
            transition: opacity 0.5s, transform 0.3s; /* Smooth transition */
        }

        #result {
            margin-top: 20px;
            font-size: 24px;
            color: #4caf50;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Adds shadow to result text */
        }

        /* Background smiling emoji for each card */
        .card::before {
            content: '😊'; /* Smiling emoji */
            font-size: 80px; /* Size of the emoji */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.3; /* Make the emoji slightly transparent */
            pointer-events: none; /* Make sure it doesn't block clicks */
        }

        /* Animation for matched cards */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 600px) {
            #game {
                grid-template-columns: repeat(2, 1fr);
            }
            .card {
                width: 100px;
                height: 100px;
            }
        }

    </style>
</head>
<body>
    <h2>Match Two Identical Recipe Images!</h2>
    <div id="game"></div>
    <div id="result"></div>

    <script>
        const items = [
            { image: "panipuri.jpg" },
            { image: "image.png" },
            { image: "dosa.png" },
            { image: "dosa.png" },
            { image: "panipuri.jpg" },
            { image: "samosa.png" },
            { image: "samosa.png" },
            { image: "image.png" }
        ];

        let firstCard = null;
        let secondCard = null;
        let matchedPairs = 0;
        const totalPairs = items.length / 2;

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function createCards() {
            const gameContainer = document.getElementById("game");
            shuffle(items);
            items.forEach(item => {
                const card = document.createElement("div");
                card.classList.add("card");
                card.innerHTML = `<img src="${item.image}" alt="Recipe Image">`;
                card.onclick = flipCard;
                gameContainer.appendChild(card);
            });
        }

        function flipCard() {
            if (this.classList.contains("flipped") || secondCard) return;

            this.classList.add("flipped");
            if (!firstCard) {
                firstCard = this;
            } else {
                secondCard = this;
                checkForMatch();
            }
        }

        function checkForMatch() {
            const firstCardImage = firstCard.querySelector("img").src;
            const secondCardImage = secondCard.querySelector("img").src;

            if (firstCardImage === secondCardImage) {
                firstCard.classList.add("matched");
                secondCard.classList.add("matched");
                matchedPairs++;
                if (matchedPairs === totalPairs) {
                    document.getElementById("result").innerText = "Congratulations! You've matched all pairs! Enjoy a discount!";
                }
                resetCards();
            } else {
                setTimeout(() => {
                    firstCard.classList.remove("flipped");
                    secondCard.classList.remove("flipped");
                    resetCards();
                }, 1000);
            }
        }

        function resetCards() {
            firstCard = null;
            secondCard = null;
        }

        // Start the game
        createCards();
    </script>
</body>
</html>
