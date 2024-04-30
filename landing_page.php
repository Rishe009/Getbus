<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- <link rel="stylesheet" href="landing page.css"> -->
    <style>
        h1 {
            background-color: black;
            opacity: 0.6;
            height: 105px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 100vw;
            color: wheat;
        }

        * {
            margin: 0%;
            padding: 0%;
        }

        .firstform {
            padding: 25px;
            width: max-content;
            margin: 100px auto;
            font-size: 20px;
            border: 1px solid red;
        }

        #src_id,
        #to_id,
        #date_id {
            padding: 10px;
            font-size: 16px;
            width: -webkit-fill-available;
            margin-bottom: 25px;
        }

        .submit,
        .lastbutton {
            padding: 10px;
            background-color: #666666;
            border: none;
            color: white;
            font-size: 17px;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type="submit"]:hover,
        .lastbutton:hover {
            background-color: black;
            color: wheat;
        }

        .secondform {
            padding: 25px;
            width: max-content;
            margin: auto;
            font-size: 20px;
            border: 1px solid red;
            margin-bottom: 25px;
            position: relative;
            top: -58px;
        }

        th,
        td {
            padding: 5px;
            border: none;
        }
    </style>
</head>

<body>
    <center>
        <h1><u>Ticket Reservations</u></h1>
    </center>

    <form action="" method="post" class="firstform">
        <label for="src_id">From:</label>
        <select name="src_name" id="src_id">
            <option value="Durgapur">Durgapur</option>
            <option value="Burnpur">Burnpur</option>
            <option value="Bishnupur">Bishnupur</option>
            <option value="Dubrajpurpur">Dubrajpurpur</option>
            <option value="Kolkata">Kolkata</option>
        </select><br>
        <label for="to_id">To:</label>
        <select name="to_name" id="to_id">
            <option value="Durgapur">Durgapur</option>
            <option value="Burnpur">Burnpur</option>
            <option value="Bishnupur">Bishnupur</option>
            <option value="Dubrajpurpur">Dubrajpurpur</option>
            <option value="Kolkata">Kolkata</option>
            <option value="Burdwan">Burdwan</option>
        </select><br><br>
        <label for="date_id">Date of journey:</label>
        <input type="date" name="date_name" id="date_id"><br><br>

        <input name="submit" type="submit" value="GET DETAILS" class="submit">
    </form>

    <br><br>
    <form action="passenger info.php" method="post" class="secondform">
        <?php
        session_start();

        if (isset($_POST['submit'])) {
            $frm = $_POST['src_name'];
            $to = $_POST['to_name'];

            $_SESSION["frm"] = $frm;
            $_SESSION["to"] = $to;
            $_SESSION["dt"] = $_POST['date_name'];

            // Establish database connection
            $db = mysqli_connect('localhost', 'root', '', 'online_bus');

            // Check connection
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT * FROM bus_details WHERE source='$frm' AND destination='$to'";
            $result = mysqli_query($db, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo '<table style="border: 2px solid blue;">
                            <tr>
                                <th>BUS NAME</th>
                                <th>FARE</th>
                                <th>VACANT SEATS</th>
                                <th>SELECT</th>
                            </tr>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>' . $row["bus_name"] . '</td>
                                <td align="center"><input type="hidden" value="' . $row["fare"] . '" name="fare_name">' . $row["fare"] . '</td>
                                <td align="center">' . $row["vacant_seats"] . '</td>
                                <td align="center"><input type="radio" name="radio_name" value="' . $row["bus_name"] . '"></td>
                            </tr>';
                    }

                    echo '</table>';
                } else {
                    echo "No buses available for the selected route.";
                }
            } else {
                echo "Error: " . mysqli_error($db);
            }

            mysqli_close($db);
        }
        ?>
        <br><br>
        <input type="submit" value="Submit" class="lastbutton">
    </form>
</body>

</html>
