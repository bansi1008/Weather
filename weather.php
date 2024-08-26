<?php

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Weather Results</title>';
echo '<!-- Bootstrap CSS -->';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '<!-- Animate.css -->';
echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">';
echo '<!-- Custom CSS for Dark Mode -->';
echo '<style>';
echo 'body.dark-mode { background-color: #121212; color: #ffffff; }';
echo 'body.dark-mode .card { background-color: #1e1e1e; color: #ffffff; }';
echo 'body.dark-mode .btn-primary { background-color: #bb86fc; border-color: #bb86fc; }';
echo 'body.dark-mode .btn-primary:hover { background-color: #9f66d7; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div class="container mt-5">';


echo '<div class="d-flex justify-content-end mb-4">';
echo '<div class="form-check form-switch">';
echo '<input class="form-check-input" type="checkbox" id="darkModeToggle">';
echo '<label class="form-check-label" for="darkModeToggle">Dark Mode</label>';
echo '</div>';
echo '</div>';

if (isset($_GET['city'])) {
    $city = urlencode($_GET['city']); // URL encode the city name to handle spaces and special characters

     
    $apiKey = "96a8344b71f84dfcb564d11eafd27033";

    
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    
    $response = file_get_contents($url);

    
    if ($response !== false) {
    
        $weatherData = json_decode($response, true);

        
        if ($weatherData['cod'] == 200) {
            
            $temperature = $weatherData['main']['temp'];
            $description = $weatherData['weather'][0]['description'];
            $humidity = $weatherData['main']['humidity'];
            $windSpeed = $weatherData['wind']['speed'];
            $cityName = $weatherData['name'];

            
            echo '<div class="card text-center animate__animated animate__fadeInUp">';
            echo '<div class="card-header">';
            echo "<h1>Weather in {$cityName}</h1>";
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h2 class="card-title">Current Conditions</h2>';
            echo "<p class='card-text'>Temperature: <strong>{$temperature}°C</strong></p>";
            echo "<p class='card-text'>Description: <strong>{$description}</strong></p>";
            echo "<p class='card-text'>Humidity: <strong>{$humidity}%</strong></p>";
            echo "<p class='card-text'>Wind Speed: <strong>{$windSpeed} m/s</strong></p>";
            echo '</div>';
            echo '<div class="card-footer text-muted">';
            echo '<form action="h4.html" method="get">';
            echo '<button type="submit" class="btn btn-primary">Search Again</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        } else {
            // Handle the case where the city is not found
            echo '<div class="alert alert-danger text-center animate__animated animate__fadeInUp">';
            echo '<h2>City not found</h2>';
            echo '</div>';
        }
    } else {
        
        echo '<div class="alert alert-danger text-center animate__animated animate__fadeInUp">';
        echo '<h2>Failed to fetch weather data.</h2>';
        echo '</div>';
    }
} else {
    echo '<div class="alert alert-warning text-center animate__animated animate__fadeInUp">';
    echo '<h2>Please enter a city name.</h2>';
    echo '</div>';
}


echo '</div>'; 
echo '<!-- Bootstrap JS -->';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
echo '<!-- JavaScript to handle Dark Mode Toggle -->';
echo '<script>';
echo 'const darkModeToggle = document.getElementById("darkModeToggle");';
echo 'const isDarkMode = localStorage.getItem("dark-mode") === "true";';
echo 'if (isDarkMode) { document.body.classList.add("dark-mode"); darkModeToggle.checked = true; }';
echo 'darkModeToggle.addEventListener("change", () => {';
echo 'document.body.classList.toggle("dark-mode");';
echo 'localStorage.setItem("dark-mode", darkModeToggle.checked);';
echo '});';
echo '</script>';
echo '</body>';
echo '</html>';
?>
