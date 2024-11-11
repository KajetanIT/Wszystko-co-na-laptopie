<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Puzzle na Urodziny</title>
<style>
  body {
    margin: 0;
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  .piece {
    width: 100px; /* Szerokość obrazka / 10 */
    height: 60px; /* Wysokość obrazka / 10 */
    background-size: 1000px 600px;
    position: absolute;
    cursor: pointer;
  }
  #message {
    text-align: center;
    display: none;
    font-size: 24px;
    color: green;
    position: absolute;
    top: 20px;
  }
</style>
</head>
<body>

<div id="message">Wszystkiego najlepszego!</div>

<script>
const imgSrc = 'fota.jpg'; // Zmień na ścieżkę obrazu
const rows = 6;
const cols = 10;
let pieces = [];

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}

function init() {
  const containerRect = document.body.getBoundingClientRect();
  const positions = [];
  
  for (let i = 0; i < rows * cols; i++) {
    const piece = document.createElement('div');
    piece.className = 'piece';
    piece.style.backgroundImage = `url('${imgSrc}')`;
    const x = (100 * (i % cols));
    const y = (60 * Math.floor(i / cols));
    piece.style.backgroundPosition = `-${x}px -${y}px`;

    positions.push({left: x, top: y});
    
    document.body.appendChild(piece);
    pieces.push(piece);
  }

  // Rozmieszczenie kawałków w losowych miejscach
  shuffleArray(positions);
  pieces.forEach((piece, index) => {
    piece.style.left = `${positions[index].left + containerRect.width / 2 - 500}px`;
    piece.style.top = `${positions[index].top + containerRect.height / 2 - 300}px`;
  });

  // Tymczasowo usunięte logiki sprawdzania ukończenia puzzli
}

window.onload = init;
</script>
</body>
</html>
