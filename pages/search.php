<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Search Page</title>
    <style>
        .search-model {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .search-model-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 400px;
        }

        .search-model-form input {
            background: white;
            border-radius: 10px;
            width: 100%;
            font-size: 15px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        .recent-searches {
            width: 100%;
            padding: 10px;
            border-top: 1px solid #ccc;
        }

        .recent-search-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }

        .recent-search-item:hover {
            background-color: #f5f5f5;
        }

        .remove-btn {
            font-size: 16px;
            color: red;
            cursor: pointer;
        }

        #clear-all {
            display: block;
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #888;
            cursor: pointer;
        }

        #clear-all:hover {
            text-decoration: underline;
        }


    </style>
</head>
<body>

<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center flex-column">
        <div class="search-close-switch">+</div>
        <form class="search-model-form" action="shop.php" method="POST" onsubmit="handleFormSubmit(event)">
            <input type="text" id="search-input" name="txtSearch" placeholder="Search here.....">
            <button type="submit" name="search-info" style="display:none;"></button>
        </form>
        <div id="recent-searches-container" class="recent-searches">
            <h5>Recent Searches</h5>
        </div>
        <a href="#" id="clear-all" onclick="clearAllSearches()">Clear All</a>
    </div>
</div>

<!-- Container for displaying search results -->
<div class="search-results" id="search-results-container"></div>

<script>
    // Store recent searches in local storage
    const storeSearch = (query) => {
        const recentSearches = getRecentSearches();

        if (!recentSearches.includes(query)) {
            if (recentSearches.length >= 5) recentSearches.pop();
            recentSearches.unshift(query);
        }

        localStorage.setItem("recentSearches", JSON.stringify(recentSearches));
    };

    // Retrieve recent searches
    const getRecentSearches = () => JSON.parse(localStorage.getItem("recentSearches")) || [];

    // Display recent searches
    const displayRecentSearches = () => {
        const recentSearches = getRecentSearches();
        const container = document.getElementById("recent-searches-container");
        container.innerHTML = recentSearches.length ? '' : "<p>No recent searches</p>";

        recentSearches.forEach(search => {
            const searchItem = createSearchItem(search);
            container.appendChild(searchItem);
        });
    };

    // Create a recent search item
    const createSearchItem = (search) => {
        const searchItem = document.createElement("div");
        searchItem.classList.add("recent-search-item");
        searchItem.textContent = search;

        // When clicked, populate input and fetch related results
        searchItem.onclick = () => {
            populateSearchInput(search);
            fetchSearchResults(search);
        };

        const removeBtn = document.createElement("span");
        removeBtn.classList.add("remove-btn");
        removeBtn.textContent = "Remove";
        removeBtn.onclick = (e) => {
            e.stopPropagation();
            removeSearch(search);
        };

        searchItem.appendChild(removeBtn);
        return searchItem;
    };

    // Populate input field with a recent search
    const populateSearchInput = (search) => {
        document.getElementById("search-input").value = search;
    };

    // Fetch search results dynamically
    const fetchSearchResults = (query) => {
        fetch("shop.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `txtSearch=${encodeURIComponent(query)}&search-info=true`
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("search-results-container").innerHTML = data;
        })
        .catch(error => console.error("Error fetching search results:", error));
    };

    // Remove a specific search
    const removeSearch = (search) => {
        const updatedSearches = getRecentSearches().filter(item => item !== search);
        localStorage.setItem("recentSearches", JSON.stringify(updatedSearches));
        displayRecentSearches();
    };

    // Clear all searches
    const clearAllSearches = () => {
        localStorage.removeItem("recentSearches");
        displayRecentSearches();
    };

    // Handle form submission
    const handleFormSubmit = (event) => {
        event.preventDefault(); // Prevent actual form submission
        const query = document.getElementById("search-input").value.trim();
        if (query) {
            storeSearch(query);
            fetchSearchResults(query); // Fetch search results after storing the query
        }
        displayRecentSearches();
    };

    // Close the modal
    document.querySelector('.search-close-switch').addEventListener('click', () => {
        document.querySelector('.search-model').style.display = 'none';
        window.history.back();
    });

    // Initialize recent searches display
    window.onload = displayRecentSearches;
</script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
