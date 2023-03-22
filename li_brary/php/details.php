
<?php
session_start();
require_once 'dbconfig.php';
$id_ouverage= $_GET['id'];
$sqlState = $conn->prepare("SELECT * FROM ouvrage WHERE id_ouvrage=?");
$sqlState->execute([$id_ouverage]);
$row = $sqlState->fetch(PDO::FETCH_ASSOC);

?>

<?php
    $id = $_SESSION["id"];
    $statement = $conn->prepare("SELECT * FROM `adhérents` WHERE `id` = '$id'");
    $statement->execute();
    $result = $statement->fetchAll();
    $profile_pic = $result[0]["profile_pic"];
    $name = $result[0]["name"];



    function RandomCodeReservation($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomCode = '';
      
        for ($i = 0; $i < $length; $i++) {
          $randomCode .= $characters[rand(0, $charLength - 1)];
        }
      
        return $randomCode;
      }
      



    if (isset($_POST['reserver'])) {
        $id = $_SESSION["id"];
        $id_ouvrage  = $row['id_ouvrage'];


        $date_reserver = date('Y-m-d H:i:s');
        $code_reserver = RandomCodeReservation(10); 
        $stmt = $conn->prepare("INSERT INTO réservations (id_adhérent , id_ouvrage , date_emprunt, reservation_valid, reservation_code) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id, $id_ouvrage, $date_reserver, 0, $code_reserver]);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.min.css" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!--=============== Custom Css Link ===============-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />


</head>

<style>

/* <select> styles */
    select {
        margin: 1em;
        appearance: none;
        border: 0;
        outline: 0;
        font: inherit;
        width: 13em;
        height: 3em;
        padding: 0 4em 0 1em;
        background: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg)
            no-repeat right 0.8em center / 1.4em,
            linear-gradient(to left,rgba(255, 255, 255, 0.3) 3em, rgba(255, 255, 255, 0.2) 3em);
        color: white;
        border-radius: 0.25em;
        box-shadow: 0 0 1em 0 rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    a {
        cursor: pointer;
    }

    option {
        color: inherit;
        background-color: #c0dcfa;
    }
    option:focus {
        display: none;
    }
    option::-ms-expand {
        display: none;
    }
    /*=============== Google Fonts ===============*/
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');

/*=============== Css Universal Selector ===============*/
* 
{
    padding: 0;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    user-select: none;
    list-style: none;
    text-decoration: none;
}

html 
{
    font-size: 10px; /* Here 10px = 1rem; */ 
} 


/*=============== Css Variable ===============*/ 
:root
{
    /*=============== colors ===============*/  
    --body-color: linear-gradient(to right, #c0dcfa, #b6e2ef);
    --container-color: linear-gradient(to right bottom, rgba(255,255,255,.5), rgba(255,255,255,.4));
    --f1-color: #000;
    --f2-color: #808080;
    --f3-color: #fff;
    --f4-color: #009933;
    --f5-color: #ff66b3;
    --f6-color: #ff99cc;
    --f7-color: rgba(104,80,80,0.03);
    --f8-color: rgba(104,80,80,0.05);
    --f9-color: #bb99ff;
    --f10-color: #c2d6d6;

    /*=============== font sizes ===============*/ 
    --xxl-fs: 3.5rem;
    --xl-fs: 2.8rem;
    --l-fs: 2.5rem;
    --m-fs: 2.2rem;
    --s-fs: 2rem;
    --xs-fs: 1.8rem;
    --h1-fs: 1.6rem;
    --h2-fs: 1.4rem;
    --text1-fs: 1.2rem;
    --text2-fs: 1.1rem;
    --text3-fs: 1rem;
    --text4-fs: 2.4rem; 

    /*=============== font Weight ===============*/
    --normal-fw: 300;
    --medium-fw: 500;
    --bold-fw: 700;  

    /*=============== Padding ===============*/  
    --pd-0: 0;
    --pd-2-5: 2.5rem;
    --pd-2: 2rem;
    --pd-1-5: 1.5rem;
    --pd-1: 1rem;
    --pd-0-8: 0.8rem;
    --pd-0-6: 0.6rem;
    --pd-0-5: 0.5rem;

}

body
{
    display: flex;

    align-items: center;
    min-height: 100vh;
    background: var(--body-color);
}


/*============= Container Grid Css =============*/  
.container {
    width: 93%;
    height: 90vh;
    background: var(--container-color);
    display: grid;
    grid-template-columns: .2fr 1fr;
    grid-template-rows: 9fr;
    grid-template-areas: "sidebar main";
    gap: 1rem;
    padding: var(--pd-2-5);
    border-radius: 3rem;
    backdrop-filter: blur(2rem);
    box-shadow: 0 0 5px rgba(255,255,255,.5);
    margin-left: 2pc;
}
.sidebar
{
    grid-area: sidebar; 
}

.main
{
    grid-area: main;
    background: var(--f3-color);
}


/*============= Main Div Grid Css =============*/ 
.main
{
    display: grid;
    grid-template-columns: 2.3fr 2fr .8fr;
    grid-template-rows: 0.2fr 1fr;
    grid-template-areas:
        "header header header"
        "category category offer"
        "item item article";
    gap: 0.5rem;
    padding: var(--pd-2-5);
    padding-top: var(--pd-1);
    padding-bottom: var(--pd-1);
    border-radius: 3rem;
    overflow-y: scroll;
} 

.main::-webkit-scrollbar
{
    width: 0;
}

.main .header
{
    grid-area: header;  
}

.main .category
{
    grid-area: category; 
}

.main .offer
{
    grid-area: offer; 
}

.main .item
{
    grid-area: item; 
}

.main .article
{
    grid-area: article; 
}


/*============= Sidebar Css =============*/  
.sidebar
{
    position: fixed;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.sidebar .profile
{
    text-align: center;
}

.sidebar .profile img
{
    width: 5rem;
    height: 5rem;
    border-radius: 2rem;
    border: 3px solid #fff;
    filter: grayscale(100%);
}

.sidebar .profile h1
{
    text-transform: capitalize;
    font-weight: var(--bold-fw);
}

.sidebar ul li .ri
{
    font-size: var(--s-fs);
    background: #ffffff;
    padding: var(--pd-1-5);
    border-radius: 1.8rem;
}

.sidebar ul li
{
    position: relative;
    display: flex;
    align-items: center;
    margin: 2rem auto;
    width: 80%;
    border-radius: 2rem;
    transition: .3s;
}

.sidebar ul li a
{
    position: absolute;
    left: 6.5rem;
    text-transform: capitalize;
    color: #000000;
    font-weight: var(--bold-fw);
    font-size: var(--text1-fs);
}

.sidebar ul .activeLink .ri,
.sidebar ul li:hover .ri
{
    background: #ffffff;
    color: #000000;
    border-radius: 1.8rem;
    transition: .3s;
}

.sidebar ul .activeLink,
.sidebar ul li:hover
{
    background: #bb99ff;}

.sidebar ul .activeLink a,
.sidebar ul li:hover a
{
    color: var(--f3-color);
}

.sidebar .card
{
    position: absolute;
    bottom: 0;
    left: 1.5rem;
    width: 85%;
    height: 14.5rem;
    background: var(--f3-color);
    border-radius: 3rem;
}

.sidebar .card img
{
    position: absolute;
    top: -6rem;
    left: 2rem;
    width: 11rem;
    height: 11rem;
    transition: .3s;
}

.sidebar .card:hover img
{
    transition: .3s;
    transform: scale(1.1);
}

.sidebar ul .activeLink{
    background: #bb99ff;
}


.sidebar .card h1
{
    position: absolute;
    left: 2rem;
    top: 6rem;
    line-height: 2.5rem;
    text-transform: capitalize;
    font-size: var(--m-fs);
    font-weight: var(--medium-fw);
    font-family: 'Secular One', sans-serif;
}

.sidebar .card h2
{
    position: absolute;
    top: 11rem;
    left: 2rem;
    font-size: var(--h2-fs);
    text-transform: capitalize;
}

.sidebar .card .ri
{
    position: absolute;
    bottom: 1.8rem;
    right: 2.5rem;
}

/*============= Header Css =============*/ 
.header
{
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .greeting
{
    position: relative;
    margin-left: 2.5rem;
}

.header .greeting h1
{
    line-height: 3rem;
    font-size: var(--l-fs);
    letter-spacing: .2rem;
    font-family: 'Secular One',  sans-serif;
    font-weight: var(--medium-fw);
}

.header .greeting img
{
    border-radius: 50%;
    position: absolute;
    top: 3.3rem;
    left: 10.8rem;
    width: 2.2rem;
    height: 2.2rem;
}

.header .searchbox
{
    position: relative;
    background: var(--f8-color);
    border-radius: 1rem;
    padding: var(--pd-0-5);
}

.header .searchbox input
{
    width: 30rem;
    border: none;
    outline: none;
    padding: var(--pd-0-5);
    padding-left: var(--pd-1-5);
    background: transparent;
}

.header .searchbox .ri
{
    position: absolute;
    top: 1.05rem;
    right: 1rem;
    font-size: var(--xs-fs);
    color: var(--f2-color);
    cursor: pointer;
}

.header .cart
{
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 4rem;
    height: 4rem;
    margin-right: 2.5rem;
    background: #c0dcfa;
    border-radius: 1rem;
    transition: .3s;
}

.header .cart .ri
{
    font-size: var(--text4-fs);
    color: var(--f3-color);
}





/*============= Category Css =============*/  
.category
{
    display: flex;
    align-items: center;
    width: 100%;
    overflow-x: scroll;
    cursor: pointer;
}

.category .categoryItem
{
    display: flex;
    align-items: center;
    margin-left: 2.5rem;
}

.category .categoryItem .card
{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background: var(--f7-color);
    min-width: 7rem;
    height: 12rem;
    text-align: center;
    padding: var(--pd-0-5);
    margin: 1rem;
    border-radius: 4rem;
}

.category .categoryItem .card img
{
    width: 6rem;
    height: 6rem;
    border-radius: 50%;
    margin-bottom: .5rem;
}

.category .categoryItem .card h1
{
    text-transform: capitalize;
    font-size: var(--text1-fs);
    font-weight: var(--normal-fw);
}

.category::-webkit-scrollbar
{
    height: 2px;
    background: transparent; 
}

.category::-webkit-scrollbar-thumb
{
    background: transparent;
    border-radius: 3rem;
}

.category:hover::-webkit-scrollbar-thumb
{
    background: var(--body-color);
    border-radius: 3rem;
}


/*============= Offer Card Css =============*/ 
.offer
{
    display: flex;
    justify-content: center;
    align-items: center;
}

.offer .card
{
    position: relative;
    background: #c0dcfa;
    border-radius: 3rem;
    width: 90%;
    height: 90%;
}

.offer .card h1
{
    font-size: var(--xl-fs);
    position: absolute;
    top: 5rem;
    left: 3rem;
    color: var(--f3-color);
}

.offer .card h2
{
    position: absolute;
    top: 8.5rem;
    left: 3rem;
    font-size: var(--h2-fs);
    color: var(--f3-color);
    font-weight: normal;
}

.offer .card img
{
    width: 9rem;
    height: 9rem;
    position: absolute;
    top: -2rem;
    right: -2rem;
    transform: rotate(-30deg);
}


/*============= Item Css =============*/ 
.item
{
    padding: var(--pd-1); 
    overflow-y: scroll;
}

.item .itemHeader
{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--pd-1);
}

.item .itemHeader .tittle
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 1rem;
}

.item .itemHeader .tittle h1
{
    text-transform: capitalize;
    font-size: var(--h1-fs);
}

.item .itemHeader .tittle .ri
{
    font-size: var(--xs-fs);
    padding: var(--pd-0-8);
    margin-left: 1rem;
    border-radius: 1rem;
    background: var(--f7-color);
}

.item .itemHeader .viewAll
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 1rem;
}

.item .itemHeader .viewAll h1
{
    text-transform: capitalize;
    font-size: var(--text1-fs);
}

.item .itemHeader .viewAll .ri
{
    font-size: var(--xs-fs);
    padding: var(--pd-0-8);
    margin-left: 1rem;
    border-radius: 1rem;
    background: var(--f7-color);
}

.item .box
{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(17rem, 1fr));
    grid-auto-rows: minmax(20rem, max-content);
    grid-gap: 1rem;
    grid-row-gap: 4.5rem;
}

.item .box .itemCard
{
    position: relative;
    top: 4rem;
    background: var(--f7-color);
    border-radius: 3rem;
    transition: .3s;
} 

.item .box .itemCard:hover
{
    background: var(--f8-color);
}


.item .box .itemCard img {
    position: absolute;
    left: 5rem;
    top: -5rem;
    width: 9rem;
    height: 12rem;
    transition: .3s;
}
.item .box .itemCard:hover img
{
    transform: scale(1.1);
}

.item .box .itemCard h1
{
    position: absolute;
    top: 7rem;
    left: 2rem;
    text-transform: capitalize;
}

.item .box .itemCard p
{
    position: absolute;
    top: 9.8rem;
    left: 2rem;
    font-size: var(--text1-fs);
    width: 90%;
}

.item .box .itemCard .price
{
    position: absolute;
    bottom: 1.5rem;
    left: 2rem;
    font-size: var(--h1-fs);
    font-weight: var(--bold-fw);
    transition: .3s;
}

.item .box .itemCard:hover .price
{
    color: var(--f4-color);
}

.item .box .itemCard .ri-heart-fill
{
    position: absolute;
    bottom: 1.5rem;
    right: 2rem;
    font-size: var(--h2-fs);
    border: 1px solid #000;
    padding: var(--pd-0-8);
    border-radius: 50%;
    transition: .3s;
}

.item .box .itemCard:hover .ri-heart-fill
{
    background: var(--f1-color);
    color: var(--f3-color);
}

.item::-webkit-scrollbar
{
    background: transparent;
    width: .2rem;
}

.item::-webkit-scrollbar-thumb
{
    background: transparent;
    border-radius: 3rem;
}

.item:hover::-webkit-scrollbar-thumb
{
    background: var(--body-color);
}

/*============= Article Css =============*/
.article
{
    overflow-y: scroll;
}

.article::-webkit-scrollbar
{
    width: .2rem;
    background: transparent;
}

.article::-webkit-scrollbar-thumb
{
    background: transparent;
}

.article:hover::-webkit-scrollbar-thumb
{
    background: var(--body-color);
    border-radius: 3rem;
}

.article .articleHeader
{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--pd-1);
    width: 85%;
    margin: 0 auto;
}

.article .articleHeader h1
{
    text-transform: capitalize;
    font-size: var(--h1-fs);
}

.article .articleHeader .ri
{
    font-size: var(--xs-fs);
    padding: var(--pd-0-8);
    border-radius: 1rem;
    background: var(--f7-color);
}

.article .box
{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(22rem, 1fr));
}

.article .box .list
{
    display: flex;
    align-items: center;
    width: 85%;
    margin: 1rem auto;
    cursor: pointer;
}

.article .box .list .icon img
{
    width: 3.5rem;
    height: 3.5rem;
    background: #99ddff;
    padding: var(--pd-0-6);
    border-radius: 1rem;
}

.article .box .list:nth-child(1) .icon img
{
    background: #99ddff;
}

.article .box .list:nth-child(2) .icon img
{
    background: #ffe6ff;
}

.article .box .list:nth-child(3) .icon img
{
    background: #e0ccff;
}

.article .box .list:nth-child(4) .icon img
{
    background: #ffffcc;
}

.article .box .list .content
{
    position: relative;
    margin-left: .8rem;
}

.article .box .list .content p
{
    font-size: var(--text2-fs);
    font-weight: var(--bold-fw);
    text-transform: capitalize;
}

.article .box .list .content p span
{
    font-size: var(--text1-fs);
}

.article .box .list .content .comment
{
    display: flex;
}

.article .box .list .content .comment img
{
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    border-left: 2px solid #fff;
}

.article .box .list .content .comment .likes
{
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ffffe6;
    border-radius: 3rem;
    padding: 0 var(--pd-0-5);
    border-left: 1px solid #fff;
}

.article .box .list .content .comment .likes img
{
    width: 1.2rem;
    height: 1.2rem;
}

.article .box .list .content .comment .likes span
{
    font-size: var(--text3-fs);
    margin-left: .5rem;
    font-weight: var(--bold-fw);
}

    h4 {
        text-transform: capitalize;
        font-size: 1.8rem;
        color: #ffff;
        font-family: 'Secular One', sans-serif; 
        margin-left: 2rem;
        margin-top: 1.2rem;    }
    .item .box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(17rem, 1fr));
        grid-auto-rows: minmax(20rem, max-content);
        grid-gap: 2rem;
        grid-row-gap: 12.5rem;
    }
        .item .box .itemCard {
        position: relative;
        top: 7rem;

    }
    .main {
        display: grid;
        grid-template-columns: 1fr 2fr .8fr;
    grid-template-rows: 0.2fr 0.5fr 1fr;
        grid-template-areas:
            "header header header"
            "category category offer"
            "item item article";
        gap: 0.5rem;
        padding: var(--pd-2-5);
        padding-top: var(--pd-1);
        padding-bottom: var(--pd-1);
        border-radius: 3rem;
        overflow-y: scroll;
    }
        .item .box .itemCard p {
        position: absolute;
        top: 10.8rem;
        left: 2rem;
        font-size: var(--text1-fs);
        width: 90%;
    }
        .item .box .itemCard h1 {
        position: absolute;
        top: 8rem;
        left: 2rem;
        text-transform: capitalize;
    }
    .offer .card {
        position: relative;
        background: #c0dcfa;
        border-radius: 1rem;
        width: 102%;
        height: 103%;
    }
    .btn-primary {
        color: #ffffff;
        margin-left: 3REM;
        background-color: #c0dcfa;
        border-color: #c0dcfa;
        padding: 0.2em 2em 0.2em 2em;
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        cursor: pointer;
        border: 1px solid transparent;
        font-size: 1.4rem;
        border-radius: 0.25rem;
    }

    .btn-p {
        color: #c0dcfa;
    margin-left: 2REM;
    background-color: #fff;
    border-color: #c0dcfa;
    padding: 0.5em 5em 0.5em 5em;
    display: inline-block;
    font-weight: 300;
    line-height: 1.5;
    cursor: pointer;
    border: 1px solid transparent;
    font-size: 1.3rem;
    border-radius: 0.25rem;
    margin-top: 14px;
    margin-bottom: 5px;
    }
    .main {
    display: grid;
    grid-template-columns: 2.3fr 2fr .8fr;
    grid-template-areas:
        "header header header"
        "category category offer"
        "item item article";
    gap: 2.5rem;
    padding: var(--pd-2-5);
    padding-top: var(--pd-1);
    padding-bottom: var(--pd-1);
    border-radius: 3rem;
    overflow-y: scroll;
}
.main .item {
    margin-top: -289px;
    grid-area: item;
}
.ri-shut-down-line {
    color: #f00;
    font-size: 22px;
    font-weight: 900;
}
.header .cart span
{
    position: absolute;
    top: -1rem;
    right: -1rem;
    width: 2.2rem;
    height: 2.2rem;
    border-radius: 50%;
    background: #c0dcfa!important;
    color: var(--f3-color);
    display: flex;
    justify-content: center;
}
.container {
    margin-top: 12px;
    width: 159%;
    height: 90vh;
    background: var(--container-color);
    display: grid;
    grid-template-columns: .2fr 1fr;
    grid-template-rows: 9fr;
    grid-template-areas: "sidebar main";
    gap: 1rem;
    padding: var(--pd-2-5);
    border-radius: 3rem;
    backdrop-filter: blur(2rem);
    box-shadow: 0 0 5px rgba(255,255,255,.5);
    margin-left: 1.5pc;
}
.main .header {
    visibility: hidden;
    grid-area: header;
}
.main {
    display: grid;
    grid-template-columns: 974.3fr 5fr 11.8fr;
    /* grid-template-areas:
        "header header header"
        "category category offer"
        "item item article"; */
    /* gap: 2.5rem; */
    /* padding: var(--pd-2-5); */
    /* padding-top: var(--pd-1); */
    /* padding-bottom: var(--pd-1); */
    /* border-radius: 3rem; */
    /* overflow-y: scroll; */
}
.max-w-sm {
    max-width: 125rem;}

.rounded-t-lg {

    max-width: 14%;
    height: 100%;
}

.p-5 {
    margin-left: -44pc;
    padding: 1.25rem;
}

.max-w-sm {
    display: flex;
    align-items: center;
}

.sidebar .profile img {
    margin-left: 98px;
    width: 5rem;
    height: 5rem;
    border-radius: 2rem;
    border: 3px solid #fff;
    filter: grayscale(100%);
    margin-bottom: 20px;
}
.rounded-t-lg {
    max-width: 24%;
    height: 100%;
    margin-right: 45pc;
}

.titre {
    color: #162643;
    font-size: 2rem;
}

.btn-p {
    color: #fff;
    margin-left: 2REM;
    background-color: #010c27;
    border-color: #071735;
    padding: 0.5em 5em 0.5em 5em;
    display: inline-block;
    font-weight: 300;
    line-height: 1.5;
    cursor: pointer;
    border: 1px solid transparent;
    font-size: 1.3rem;
    border-radius: 0.25rem;
    margin-top: 14px;
    margin-bottom: 5px;
}
</style>
<body>



    <!--=============== Main Container ===============-->
    <div class="container" id="container">

        <!--=============== Sidebar ===============-->
        <div class="sidebar" id="sidebar">
            <div class="menuBar">
                <div class="profile">
                    <img src="../files/profil_img/<?= $profile_pic ?>" width="40px" height="40px" alt="">
                    <h1 class="name"><?= $name ?></h1>
                    <i class="fa-brands fa-facebook"></i>
                </div>

                <ul>
                    <li class="activeLink">
                        <i class="ri-home-line ri"></i>
                        <a href="http://localhost/labiral/">home</a>
                    </li>

                    <li>
                        <i class="ri-book-open-line ri"></i>
                        <a href="#">réservations</a>
                    </li>

                    <li>
                        <i class="ri-file-text-line ri"></i>
                        <a href="#">emprunt</a>
                    </li>

                    <li>
                        <i class="ri-settings-line ri"></i>
                        <a href="php\profil_adhérents.php">setting</a>
                    </li>
                </ul>


            </div>
        </div>

        <!--=============== Main ===============-->
        <div class="main" id="main">

            <!--=============== Header ===============-->
            <div class="header" id="header">
                <div class="greeting">
                    <h1>Welcome  <br> Library</h1>
                    <img src="logo.jpg" width="20px" height="20px" alt="">
                </div>

                <div class="searchbox">
                    <input type="text" placeholder="Search" name="search">
                    <i class="ri-search-line ri"></i>
                </div>

                <div class="cart">
                    <a type="button" href="php/logout.php" class="btn btn-danger"><i class="ri-shut-down-line"></i></a>
                </div>
            </div>
            <!--=============== Category ===============-->
            

            <!--=============== Offer ===============-->
            <div class="offer" id="offer">


            </div>
                

            <!--=============== Item ===============-->
           

            <!--=============== Article ===============-->

            <div class="box">
            <form method='POST'>                                
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div>
                        <a href="#">
                            <img class="rounded-t-lg" src="<?= $row["image_couverture"] ?>" alt="" />
                        </a>
                    </div>

                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold titre tracking-tight text-gray-900 dark:text-white"><?= $row["titre"] ?></h5>
                            <br>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Auteur :<?= $row["auteur"] ?></p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Etat :<?= $row["etat"] ?></p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">date :<?= $row["date_achat"] ?></p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Etat :<?= $row["description"] ?></p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Etat :<?= $row["id_ouvrage"] ?></p>

                        <button type='submit' name='reserver' class='btn-p  inline-flex items-center '> Réserve</button>

                    </div>
                </div>
            </form>
            <form action="php\adhérents_reservation.php" method="post">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 " name="id_ouvrage">Etat :<?= $row["id_ouvrage"] ?></p>
            </form>
            
            </div>

</body>

</html>
