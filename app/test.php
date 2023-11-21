<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Alert</title>
    <style>
    /* Styles for the overlay */
    .overlay:target {
        display: flex;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    /* Styles for the popup box */
    .popup {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    /* Style for the close button */
    .close-btn {
        cursor: pointer;
        padding: 5px 10px;
        background: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
    }
    </style>
</head>

<body>

    <!-- Overlay with id "overlay" -->
    <div class="overlay" id="overlay">
        <!-- Popup Box -->
        <div class="popup">
            <p>Data Gagal ditambahkan!</p>
            <!-- Close button -->
            <a href="#" class="close-btn">Close</a>
        </div>
    </div>

    <!-- Button to trigger the popup -->
    <a href="#overlay">Show Popup</a>

</body>

</html>