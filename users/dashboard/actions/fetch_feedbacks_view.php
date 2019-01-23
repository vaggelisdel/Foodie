<?php

require_once '../../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {

    if ($_POST["action"] == "Select") {
        $feedbackid = $_POST["feedbackid"];

        $query = $connect->query("SELECT users.*, recipes.*, feedback.* FROM users, recipes, feedback WHERE users.UserID = feedback.UserID AND recipes.RecipeID = feedback.RecipeID AND feedback.FeedBackID = '$feedbackid'");
        $feedback = $query->fetch_assoc();

        $values = array('FeedBackID' => $feedback["FeedBackID"], 'OwnerID' => $feedback["OwnerID"], 'RecipeID' => $feedback["RecipeID"], 'Score' => $feedback["Score"], 'Difficulty' => $feedback["Difficulty"], 'Review' => $feedback["Review"], 'Date' => $feedback["Date"], 'Recipe' => $feedback["Title"], 'User' => $feedback["Name"], 'Surname' => $feedback["Surname"]);
        echo json_encode($values);


    } else if ($_POST["action"] == "Answers") {

        $feedbackid = $_POST['feedbackid'];

        $query = $connect->query("SELECT * FROM answers WHERE `FeedBackID` ='$feedbackid'");

        if ($query->num_rows == 0) {

        } else {
            echo "<div class='answers_panel'>";
            while ($row = $query->fetch_assoc()) {

                $userid = $row['UserID'];

                $result_data = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
                $user_data = $result_data->fetch_assoc();

                echo "<div class='answer_item'>
                                        <i class='fa fa-commenting-o'><b> " . $user_data['Name'] . " " . $user_data['Surname'] . "</b></i>

                                        <p class='message'>
                                            <small class='text-muted pull-right'><i
                                                        class='fa fa-clock-o'></i> 2019-01-04 13:45:02
                                            </small>
                                            
<br>
                                            " . $row['AnswerText'] . "
                                        </p>
                                </div>";

            }
            echo "</div>";
        }


    } else if ($_POST["action"] == "AddAnswer") {

        $feedbackid = $_POST['feedbackid'];
        $userid = $_POST['userid'];
        $textanswer = $_POST['textanswer'];

        $query = "INSERT INTO answers (FeedBackID, UserID, AnswerText) VALUES ('$feedbackid', '$userid', '$textanswer')";

        $output = mysqli_query($connect, $query);

    } else {
        header("Location: ../index.php");
    }
}
?>