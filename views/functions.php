<?php 
    function index(){
        return view('index');
    }

    function tab1(){
        $configPath = extensionDb('newHostName');
        return respond($configPath,200);
    }

    function tab2(){
        return respond(runCommand("cat /etc/hosts"),200);

    }
    function tab3(){
        return respond(runCommand("hostname"),200);
    }
    function tab4(){
        $currentHostname=runCommand("hostname");
        runCommand(sudo()."hostnamectl set-hostname test");
        runCommand(sudo()."hostname test");
        runCommand(sudo()."sed -i 's/$currentHostname/test/g' /etc/hosts");
        return respond("ok",200);
        
    }
?>