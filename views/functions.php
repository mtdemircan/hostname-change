<?php 
    function index(){
        return view('index');
    }

    function tab1(){     
         
        $b = extensionDb('newHostName');
        $a=runCommand("hostname");
        $c=runCommand("hostname --fqdn");
        $message=$a." ".$b." ".$c;
        
        return respond($message,200);
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
    function changeHost(){
        $newHostname = request("new");

        $currentHostname=runCommand("hostname");
        runCommand(sudo()."hostnamectl set-hostname $newHostname");
        runCommand(sudo()."hostname $newHostname");
        runCommand(sudo()."sed -i 's/$currentHostname/$newHostname/g' /etc/hosts");
        return respond("ok",200);
        
    }
?>