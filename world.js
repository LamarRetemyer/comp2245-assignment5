document.addEventListener('DOMContentLoaded', function() {
    // Lookup Country
    document.getElementById('lookup').addEventListener('click', function() {
        fetchCountryData();
    });

    // Lookup Cities
    document.getElementById('lookupCities').addEventListener('click', function() {
        fetchCityData();
    });
});

function fetchCountryData() {
    var countryName = document.getElementById('country').value;
    fetchData('world.php?country=' + countryName);
}

function fetchCityData() {
    var countryName = document.getElementById('country').value;
    fetchData('world.php?country=' + countryName + '&lookup=cities');
}

function fetchData(url) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('result').innerHTML = xhr.responseText;
        } else {
            console.error('Request failed. Status: ' + xhr.status);
        }
    };

    xhr.send();
}
