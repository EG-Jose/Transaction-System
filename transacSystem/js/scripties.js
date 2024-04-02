// Toggle Container
function toggleContainer(event) {
    var button = event.currentTarget;
    var targetId = button.dataset.target;
    var togDocMore = document.getElementById(targetId);
    var buttonText = button.querySelector(".buttonText");
    var icon1 = button.querySelector(".icon1");
    var icon2 = button.querySelector(".icon2");

    togDocMore.classList.toggle("expanded");
    buttonText.textContent = togDocMore.classList.contains("expanded") ? "Show Less" : "Show More";
    if (icon1) icon1.className = togDocMore.classList.contains("expanded") ? "fa fa-angles-up icon1" : "fa fa-angles-down icon1";
    if (icon2) icon2.className = togDocMore.classList.contains("expanded") ? "fa fa-angles-up icon2" : "fa fa-angles-down icon2";
    togDocMore.style.maxHeight = togDocMore.classList.contains("expanded") ? togDocMore.scrollHeight + "px" : "45vh";
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".toggleButton").forEach(button => {
        button.addEventListener("click", toggleContainer);
    });
});

// Slider
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.slider');
    let counter = 0;

    function slide() {
        slider.style.transition = 'transform 0.5s ease-in-out';
        slider.style.transform = `translateX(${-counter * 100}%)`;
    }

    function nextSlide() {
        counter = (counter + 1) % slider.children.length;
        slide();
    }

    setInterval(nextSlide, 10000);
});

// Validation
function validateSignupForm() {
    var isValid = true;
    var username = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation").value;

    if (username.trim() === '') {
        alert("Name is required");
        isValid = false;
    }

    if (!email.includes("@")) {
        alert("A valid email is required");
        isValid = false;
    }

    if (password.length < 8 || !/[a-z]/i.test(password) || !/[0-9]/.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one letter and one number");
        isValid = false;
    }

    if (password !== confirmPassword) {
        alert("Passwords must match");
        isValid = false;
    }

    return isValid;
}

document.getElementById("signup").addEventListener("submit", function (event) {
    if (!validateSignupForm()) {
        event.preventDefault();
    }
});

// Signup/Login Panel
function showModal() {
    var modal = document.getElementById('logsignModal');
    modal.style.display = 'block';
    setTimeout(function () {
        modal.style.opacity = 1;
    }, 10);
}

function closeModal() {
    var modal = document.getElementById('logsignModal');
    modal.style.opacity = 0;
    setTimeout(function () {
        modal.style.display = 'none';
    }, 500);
}
