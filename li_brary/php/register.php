<?php
    include "dbconfig.php";
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "css_cdns.php"?>
    <link rel="stylesheet" href="../css/register.css">
    <title>Library</title>
</head>
<body>
<main>
    <div class="right">
        <div id="logo">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Library</span>
        </div>
        <form action="register.php" method="get">
        <?php
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
                $last_name = $_GET["last_name"];
                $email = $_GET["email"];
                $pwd = $_GET["pwd"];
                $phone_number = $_GET["tel"];
                $adresse = $_GET['adresse'];
                $cin = $_GET['cin'];
                $date_naissance = $_GET['date_naissance'];
                $type = $_GET['type'];
                //---------*get id of the row that has the entered email*--------
                $statement = $conn->prepare("SELECT `id` FROM `adhérents` WHERE `email` = '$email'");
                $statement ->execute();
                $result = $statement->fetchAll();

                //---------*get id of the row that has the entered email end*--------
                //---------*check if there is and row if yes the email is already taken if not the register process contitnues*--------
                if (count($result) == 0) {
                    $statement = $conn->prepare("INSERT INTO `adhérents` (`name`,`last_name`,`email`,`password`,`phone_number`,`adresse`,`cin`,`date_naissance`,`type`) VALUES ('$name','$last_name','$email','$pwd','$phone_number','$adresse','$cin','$date_naissance','$type')");
                    $statement->execute();
                    header('Location: login.php');
                    exit();
                }else {
                    echo "<p class='response'>Cette adresse e-mail est déjà prise</p>";
                }
                //---------*end of script php*--------
            }
            ?>
            <div class="input-group">
                <div class="input">
                    <div class="relative">
                        <input type="text" id="name"
                            name="name"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "/>
                        <label for="name"
                            class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 peer-focus:text-blue-600">Prenom</label>
                    </div>
                    <p class="error">le prénom ne peut pas contenir de chiffres ni de caractères spéciaux</p>
                </div>
                <div class="input">
                    <div class="relative">
                        <input type="text" id="last_name"
                            name="last_name"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "/>
                        <label for="last_name"
                            class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Nom</label>
                    </div>
                    <p class="error">le nom ne peut pas contenir de chiffres ni de caractères spéciaux</p>
                </div>
            </div>
            <div class="input">
                <div class="relative">
                    <input type="tel" id="tel"
                        name="tel"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "/>
                    <label for="tel"
                        class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Téléphone</label>
                </div>
                <p class="error">veuillez entrer un numéro valide (0/0212/+212)</p>
            </div>


            <div class="input">
                <div class="relative">
                    <input type="text" id="adresse"
                        name="adresse"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "/>
                    <label for="adresse"
                        class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">adresse</label>
                </div>
                <p class="error">veuillez entrer un adresse valide </p>
            </div>
            <div class="input">
                <div class="relative">
                    <input type="text" id="cin"
                           name="cin"
                           class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" "/>
                    <label for="cin"
                           class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 peer-focus:text-blue-600">cin</label>
                </div>
                <p class="error">le cin  ne peut pas contenir de chiffres ni de caractères spéciaux</p>
            </div>

            <div class="input-group">

            <div class="input">
                <div class="relative">
                    <select name="type" id="type" style="
    padding-bottom: 18PX;>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Employé">Employé</option>
                        <option value="Femme au foyer">Femme au foyer</option>

                    </select>
                    <label for="type"
                           class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 peer-focus:text-blue-600">type</label>
                </div>
                <p class="error">le type  ne peut pas contenir de chiffres ni de caractères spéciaux</p>
            </div>
            <div class="input">
                <div class="relative">
                    <input type="date" id="date_naissance"
                           name="date_naissance"
                           class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" "/>
                    <label for="date_naissance"
                           class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 peer-focus:text-blue-600">date_naissance</label>
                </div>
                <p class="error">le date_naissance  ne peut pas contenir de chiffres ni de caractères spéciaux</p>
            </div>
            </div>
            <div class="input">
                <div class="relative">
                    <input type="email" id="email"
                        name="email"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "/>
                    <label for="email"
                        class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Email</label>
                </div>
                <p class="error">veuillez entrer un email valide </p>
            </div>
            <div class="input-group">
                <div class="input">
                    <div class="relative">
                        <input type="password" id="password"
                        name="pwd"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "/>
                        <label for="password"
                        class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Mot
                            de pass</label>
                    </div>
                    <p class="error">veuillez entrer un mot de passe plus fort</p>
                </div>
                <div class="input">
                    <div class="relative">
                        <input type="password" id="confirmation"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "/>
                        <label for="confirmation"
                            class="absolute text-sm  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Confirmer</label>
                    </div>
                    <p class="error">les mots de pass ne correspondent pas</p>
                </div>
            </div>
            <input type="submit"  value="S'inscrire">
            <a href="login.php">Vous avez déjà un compte?</a>
        </form>
    </div>
    <div class="left">
        <img src="../pic\International trade-rafiki.png" alt="">
    </div>
</main>
<?php include "js_cdns.php"?>
<script src="../javascript/register.js"></script>
</body>
</html>