<?php 
include 'bd.php';
function fetchData(url, callback) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Data fetched from " + url, data); // Debugging line
                    callback(data);
                })
                .catch(error => console.error('Error:', error));
        }

        function searchArtwork() {
            const searchBar = document.getElementById('search-bar');
            const id = searchBar.value.trim();
            if (id) {
                fetchData(`Search.php?id=${id}`, data => {
                    if (data.error) {
                        console.error(data.error);
                        alert(data.error);
                    } else {
                        document.getElementById('temperature').innerText = data.Temperature || 'N/A';
                        document.getElementById('humidity').innerText = data.SignalM || 'N/A';
                        document.getElementById('brightness').innerText = data.SignalV || 'N/A';
                        document.getElementById('artId').innerText = data.idOeuvre || 'N/A';
                        document.getElementById('artName').innerText = data.NomO || 'N/A';
                    }
                });
            } else {
                alert('Please enter a valid ID');
            }
        }

        // Fetch initial environmental data
        fetchData('fetch_data.php?type=capteur', data => {
            if (data.error) {
                console.error(data.error);
            } else {
                document.getElementById('temperature').innerText = data.Temperature || 'N/A';
                document.getElementById('humidity').innerText = data.SignalM || 'N/A';
                document.getElementById('brightness').innerText = data.SignalV || 'N/A';
            }
        });
        ?>