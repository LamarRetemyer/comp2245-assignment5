document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lookup').addEventListener('click', function() {
        // Get the value from the input field
        var countryName = document.getElementById('country').value;

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure it: GET-request for the world.php with the country parameter
        xhr.open('GET', 'world.php?country=' + countryName, true);

        // Define the onload function, which will be called when the request is successful
        xhr.onload = function() {
            // Check if the request was successful (status code 200)
            if (xhr.status === 200) {
                // Display the result in the 'result' div
                document.getElementById('result').innerHTML = xhr.responseText;
            } else {
                // Display an error message if the request was not successful
                console.error('Request failed. Status: ' + xhr.status);
            }
        };

        // Send the request
        xhr.send();
    });
});
