// --- ЗАВДАННЯ: АНІМАЦІЯ ---
let box = document.getElementById('animation-box');
let position = 0;

function moveRight() {
    position += 50;
    box.style.transform = `translateX(${position}px)`;
}

function resetPosition() {
    position = 0;
    box.style.transform = `translateX(0px)`;
    box.style.backgroundColor = '#3498db';
}

function changeColor() {
    const randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
    box.style.backgroundColor = randomColor;
}

// --- БОНУС: МІНІ-ГРА ---
let score = 0;
let gameActive = false;
let target = document.getElementById('target');
let scoreDisplay = document.getElementById('score');

function startGame() {
    if (gameActive) return;
    score = 0;
    scoreDisplay.innerText = score;
    gameActive = true;
    target.style.display = 'block';
    moveTarget();
    
    // Гра триває 10 секунд
    setTimeout(() => {
        gameActive = false;
        target.style.display = 'none';
        alert(`Гру закінчено! Ваш рахунок: ${score}`);
    }, 10000);
}

function moveTarget() {
    if (!gameActive) return;
    const gameArea = document.getElementById('game-area');
    const x = Math.random() * (gameArea.clientWidth - 40);
    const y = Math.random() * (gameArea.clientHeight - 40);
    
    target.style.left = x + 'px';
    target.style.top = y + 'px';
}

function hitTarget() {
    if (!gameActive) return;
    score++;
    scoreDisplay.innerText = score;
    moveTarget(); // Одразу перемістити після кліку
}