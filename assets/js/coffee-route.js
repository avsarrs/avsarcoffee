document.addEventListener('DOMContentLoaded', function () {
    // 1. Initialize Bootstrap Popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'hover'
        })
    });

    // 2. Quiz Logic
    const quizData = [
        {
            question: "Günün hangi saati?",
            options: [
                { text: "Sabah - Enerji lazım!", points: 10 },
                { text: "Öğle - Keyif yapıyorum", points: 5 },
                { text: "Akşam - Sakinlik arıyorum", points: 2 }
            ]
        },
        {
            question: "Süt tercih eder misin?",
            options: [
                { text: "Asla, kahve siyah olmalı", points: 10 },
                { text: "Biraz yumuşatsa iyi olur", points: 5 },
                { text: "Bol sütlü ve köpüklü olsun", points: 2 }
            ]
        },
        {
            question: "Aroma tercihin nedir?",
            options: [
                { text: "Yoğun ve meyvemsi", points: 10 },
                { text: "Karamel ve çikolata", points: 5 },
                { text: "Hafif ve çiçeksi", points: 2 }
            ]
        }
    ];

    let currentStep = 0;
    let totalScore = 0;

    const quizContent = document.getElementById('quiz-content');
    const quizResult = document.getElementById('quiz-result');

    function renderStep() {
        if (currentStep < quizData.length) {
            const data = quizData[currentStep];
            let html = `<h5>${data.question}</h5>`;
            data.options.forEach((opt, index) => {
                html += `<button class="quiz-option" onclick="selectOption(${opt.points})">${opt.text}</button>`;
            });
            quizContent.innerHTML = html;
        } else {
            showResult();
        }
    }

    window.selectOption = function(points) {
        totalScore += points;
        currentStep++;
        renderStep();
    };

    function showResult() {
        let coffee = "";
        if (totalScore >= 25) {
            coffee = "Espresso / Double Shot";
        } else if (totalScore >= 18) {
            coffee = "Flat White";
        } else if (totalScore >= 12) {
            coffee = "Caffe Latte";
        } else {
            coffee = "Cold Brew / Ethiopia";
        }

        quizContent.innerHTML = "";
        quizResult.style.display = "block";
        quizResult.innerHTML = `Senin kahven: <span class="text-white">${coffee}!</span>`;
    }

    renderStep();
});
