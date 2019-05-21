<style>
    #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
    }
    * {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    body {
        font-size: 16px;
        color: White;
        font-smoothing: antialiased;
        font-weight: 600;
    }

    a {
        color: #bbb;
    }

    .content:before {
        content: "";
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: -1;
        display: block;
        width: 100%;
        height: 100%;
        background-size: cover;
        -webkit-filter: blur(2px);
        -moz-filter: blur(2px);
        -o-filter: blur(2px);
        -ms-filter: blur(2px);
        filter: blur(2px);
    }

    .content {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 450px;
        height: 400px;
        background-color: rgba(10, 10, 10, 0.5);
        margin: auto auto;
        padding: 40px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        -moz-box-shadow: 0 0 10px black;
        -webkit-box-shadow: 0 0 10px black;
        box-shadow: 0 0 10px black;
    }
    .content .title {
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
        padding-bottom: 30px;
        color: #fff;
    }
    .content input {
        width: 100%;
        font-size: 1.2rem;
        margin: 10px 0px;
        padding: 10px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        background: #fff !important;
        border: 1px solid #c4c4c4;
        border-radius: 5px !important;
    }
    .content input[type="checkbox"] {
        display: none;
    }
    .content label {
        display: inline-block;
        width: 20px;
        height: 20px;
        cursor: pointer;
        position: relative;
        margin-left: 5px;
        margin-right: 10px;
        top: 5px;
    }
    .content label:before {
        content: "";
        display: inline-block;
        width: 20px;
        height: 20px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        position: absolute;
        left: 0;
        bottom: 1px;
        background-color: #aaa;
        -moz-box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, 0.3), 0px 1px 0px 0px rgba(255, 255, 255, 0.8);
        -webkit-box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, 0.3), 0px 1px 0px 0px rgba(255, 255, 255, 0.8);
        box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, 0.3), 0px 1px 0px 0px rgba(255, 255, 255, 0.8);
    }
    .content input[type="checkbox"]:checked + label:before {
        content: "\2713";
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        font-size: 20px;
        color: Black;
        text-align: center;
        line-height: 20px;
    }
    .content span {
        font-size: 0.9rem;
    }
    .content button {
        width: 100%;
        font-size: 1.1rem;
        padding: 10px;
        margin: 20px 0px;
        background-color: #66a756;
        color: White;
        border: none;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }
    .content .facebook, .content .google{
        width: 100%;
        font-size: 1.1rem;
        padding: 10px;
        margin: 20px 0px;
        background-color: #66a756;
        color: White;
        border: none;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }
    .content .social {
        width: 100%;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .content .social span {
        display: inline-block;
        vertical-align: baseline;
        padding: 0 20px;
    }
    .content .social span:before, .content .social span:after {
        content: "";
        display: block;
        width: 500px;
        position: absolute;
        top: 0.9em;
        border-top: 1px solid White;
    }
    .content .social span:before {
        right: 75%;
    }
    .content .social span:after {
        left: 75%;
    }
    .content .buttons {
        width: 100%;
        margin: 30px 0px;
    }
    .content .buttons a  {
        width: 45%;
        margin: 0px 1.5%;
    }
    .content .buttons i {
        padding-right: 7px;
    }
    .content .buttons .facebook {
        background-color: #4464b2;
    }
    .content .buttons .twitter {
        background-color: #28a9e0;
    }
    .content .buttons .google {
        background-color: #da4735;
    }
    .content .buttons:after {
        content: "";
        display: block;
        clear: both;
    }
    .content .already {
        text-align: center;
        font-size: 0.9rem;
    }

    .buttons {

        text-align: center;
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        transition: background-color 5000s ease-in-out 0s;
    }

</style>
<video autoplay muted loop id="myVideo">
    <source src="images/background.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
</video>

<div class="content">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php $this->widget('Flashes'); ?>
    <div class="title">Login to your account</div>       
    <div class="input-icon">
        Username:
        <?php echo CHtml::activeTextField($model, 'username', array('id' => 'txtUsername', 'placeholder' => 'Username', 'autocomplete' => 'off', 'class' => 'form-control')); ?>
    </div>
    <div class="input-icon">
        Password:
        <?php echo CHtml::activePasswordField($model, 'password', array('id' => 'txtPassword', 'placeholder' => 'Password', 'autocomplete' => 'off', 'class' => 'form-control')); ?>
    </div>
    <input type="checkbox" id="rememberMe" checked/>
    <label for="rememberMe"></label><span>Remember me</span>

    <button type="submit">Login</button>
    <?php $this->endWidget(); ?>
</div>