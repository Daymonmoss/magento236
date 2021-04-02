<?

if(isset($_POST)){
    ini_set('session.gc_maxlifetime', 120);
    $session = session_start();
    if (!isset($_SESSION['time'])) {
        $_SESSION['time'] = date("H:i:s");
        $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
    }
    /*
    if ($_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT']) {
        die('Wrong Session Cheater!');
    }
    */
    echo $_SESSION['time'];
    echo $_SESSION['ua'];

    $name=$_POST["name"];
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];

    echo $name."\n".$email."\n".$subject."\n". $message."\n";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($note[$name])) {
            $nameErr = "Name is required";
        } else {
            $name = htmlspecialchars($name);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($note[$email])) {
            $emailErr = "Email is required";
        } else {
            $email = htmlspecialchars($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($note[$subject])) {
            $subjectErr = "Subject is required";
        } else {
            $subject = htmlspecialchars($subject);
        }

        if (empty($note[$message])) {
            $messageErr = "Message is required";
        } else {
            $message = htmlspecialchars($message);
        }
    }



/*
    $name = urldecode(htmlspecialchars($_POST['name']));
    $email = trim(urldecode(htmlspecialchars($_POST['email'])));
    $subject = urldecode(htmlspecialchars($_POST['subject']));
    $message = htmlspecialchars($_POST['message']);
*/
    if (mail("daymonmoss@gmail.com", $subject, "Name: ".$name."\n"."E-mail: ".$email."\n"."Message: ".$message ,"From: $email \r\n"))
    {
        $file="log.txt";
        $note = "\r\nName: ".$name."; E-mail: ".$email."; Message: ".$message.";";
        if (file_exists($file)) {
            $rez = file_get_contents($file);
            file_put_contents($file, $note);
        } else {
            file_put_contents($file, $note);
        }


        echo "Success";
    } else {
        echo "Error";
    }

}
